<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Http\Helpers\partials;
use App\Http\Helpers\sendMail;
use App\Models\fundPayment;
use App\Models\Funds;
use App\Models\loanRates;
use App\Models\Safe;
use App\Models\Saving;
use App\Models\Transaction;
use App\Models\Stash;
use App\Models\transferBRequest;
use App\Models\transferRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\Lender;
use App\Models\lenderAccount;
use App\Models\Bank;
use App\Models\Portfolio;
use App\Models\Investment;
use App\Models\TranxConfirm;
use App\Models\Reserve;
use App\Http\Helpers\Validate;
use Illuminate\Support\Facades\Auth;

class LoadController extends Controller
{

    private $api;
    private $transaction;
    private $stash;
    private $referral;
    private $investor;
    private $portfolio;
    private $investment;
    private $tranx;
    private $validate;
    private $account;
    private $bank;
    private $fund;
    private $transferRequest;
    private $partials;
    private $saving;
    private $payment;
    private $mail;
    private $rates;
    private $reserve;
    private $safe;
    private $transferBRequest;
    
    public function __construct(apiHelper $api, Transaction $transaction, Stash $stash, Referral $referral, Lender $investor, Portfolio $portfolio, Investment $investment, TranxConfirm $tranx, Validate $validate, lenderAccount $account, Bank $bank, Funds $fund, transferRequest $transferRequest, partials $partials, Saving $saving, fundPayment $payment, sendMail $mail, loanRates $rates, Reserve $reserve, Safe $safe, transferBRequest $transferBRequest){
        $this->api = $api;
        $this->transaction = $transaction;
        $this->stash = $stash;
        $this->portfolio = $portfolio;
        $this->referral = $referral;
        $this->investor = $investor;
        $this->investment = $investment;
        $this->tranx = $tranx;
        $this->validate = $validate;
        $this->account = $account;
        $this->bank = $bank;
        $this->fund = $fund;
        $this->transferRequest = $transferRequest;
        $this->partials = $partials;
        $this->saving = $saving;
        $this->payment = $payment;
        $this->mail = $mail;
        $this->rates = $rates;
        $this->reserve = $reserve;
        $this->safe = $safe;
        $this->transferBRequest = $transferBRequest;
    }

    public function buy(Request $request){
        try{
            $body = [
                'amount' => $request->amount * 100,
                'email' => $request->email
            ];

            $response = $this->api->call('/transaction/initialize', 'POST', $body);

            $data = [
                "email" => $request->email,
                "amount" => $request->amount,
                "type" => "credit",
                "reference" => $response->data->reference
            ];
            $this->tranx->create($data);
            return redirect($response->data->authorization_url);
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return redirect('dashboard/i')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function repayFund(Request $request){
        try{
            $body = [
                'amount' => $request->amount * 100,
                'email' => $request->email
            ];

            $response = $this->api->call('/transaction/initialize', 'POST', $body);

            $data = [
                "email" => $request->email,
                "amount" => $request->amount,
                "type" => "funding",
                "fundId" => $request->fundId,
                "reference" => $response->data->reference
            ];
            $this->tranx->create($data);
            return redirect($response->data->authorization_url);
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return redirect('dashboard')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function confirm(Request $request) {
        $user = \Auth::user();
        try {
            $reference = $request->reference;

            $trnxData = $this->api->call('/transaction/verify/'.$reference, 'GET')->data;

            $amountPaid = $trnxData->amount / 100;

            
            $tranxDetail = $this->tranx->where(['reference' => $reference, 'isCompleted' => false, 'email' => $user->email]);
            $tranxDetails = $tranxDetail->first();
            if($tranxDetails == null){
                \Session::put('danger', true);
                return redirect('dashboard/i')->withErrors('Something went Wrong');
            }

            $trnxType = $tranxDetails->type;


            if($user->type == "business" || $user->type == "introducer"){
                $params = [
                    'reference' => $trnxData->reference,
                    'status' => $trnxData->status,
                    'message' => $trnxData->message ?? $trnxData->gateway_response,
                    'amount' => $amountPaid,
                    'userId' => $user->id,
                    'type' => $trnxType
                ];

                if ($user->type == "business"){
                    $params['businessId'] = $user->business()->id;
                }

                $trnXId = $this->transaction->create($params)->id;

                if ($trnxData->status !== 'success'){
                    $tranxDetail->update([
                        "isCompleted" => true
                    ]);
                    \Session::put('danger', true);
                    if ($user->type == "business"){
                            return redirect('dashboard/funds')->withErrors('Payment Failed');
                    }
                    else{
                        return redirect('dashboard/e/funds')->withErrors('Payment Failed');
                    }
                }
                    if ($trnxType == 'funding'){
                        $rePay = $this->payment->where(["fundId" => $tranxDetails->fundId, "isCompleted" => false]);
                        $rePayment = $rePay->first();

                        if ($rePayment->months_left <= 1){
                            $rePay->update([
                                "isCompleted" => true,
                                "months_left" => 0
                            ]);
                        }

                        $rePay->decrement('months_left', 1);

                        $nextPayment = Carbon::now()->addMonths(1);

                        $rePay->update(["nextPayment" => $nextPayment]);
                        $tranxDetail->update([
                            "isCompleted" => true
                        ]);
                        \Session::put('success', true);
                        if ($user->type == "business"){
                            return redirect('dashboard/funds')->withErrors('Payment successfully');
                        }
                        else{
                            return redirect('dashboard/e/funds')->withErrors('Payment successfully');
                        }
                    }
                    else{
                        $stash = $this->safe->where('userId', $user->id);

                        if ($stash->first() === null) {
                            $stashParams = [
                                'userId' => $user->id,
                                'customerId' => $trnxData->customer->customer_code,
                                'totalAmount' =>  0,
                                'availableAmount' => 0
                            ];
                            $stash->create($stashParams);
                        }
                        $preserve = $this->reserve->where(["reference" => $reference, "isCompleted" => false]);
                        $getPreserve = $preserve->first();

                        if ($getPreserve->interval == "weekly"){
                            $nextP = Carbon::now()->addWeeks(1);
                        }
                        elseif ($getPreserve->interval == "monthly"){
                            $nextP = Carbon::now()->addMonths(1);
                        }
                        else{
                            $nextP = Carbon::now()->addDays(1);
                        }

                        $preserve->update(
                            ['nextPayment' => $nextP, "auth_code" => $trnxData->authorization->authorization_code, 'isStarted' => true]
                        );
                        $preserve->increment('durationPaid', 1);
                        $preserve->increment('durationPassed', 1);
                        $tranxDetail->update([
                            "isCompleted" => true
                        ]);
                        \Session::put('success', true);
                        if ($user->type == "business"){
                            return redirect('dashboard/save')->withErrors('Transaction successful');
                        }
                        else{
                            return redirect('dashboard/e/save')->withErrors('Transaction successful');
                        }
                    }
            }
            else {
                $params = [
                    'reference' => $trnxData->reference,
                    'status' => $trnxData->status,
                    'message' => $trnxData->message ?? $trnxData->gateway_response,
                    'amount' => $amountPaid,
                    'investorId' => $user->investor()->id,
                    'userId' => $user->id,
                    'type' => $trnxType
                ];

                $trnXId = $this->transaction->create($params)->id;

                if ($trnxData->status !== 'success'){
                    $tranxDetail->update([
                        "isCompleted" => true
                    ]);
                    \Session::put('danger', true);
                    return redirect('dashboard/i')->withErrors('Transaction Failed');
                }
                //credit the Investor's wallet
                if ($trnxType == 'credit' || $trnxType == 'saving') {
                    $stash = $this->stash->where('investorId', $user->investor()->id);

                    if ($stash->first() === null) {
                        if ($trnxType == 'saving'){
                            $stashParams = [
                                'investorId' => $user->investor()->id,
                                'customerId' => $trnxData->customer->customer_code,
                                'totalAmount' =>  1000,
                                'availableAmount' => 1000
                            ];
                        }
                        else{
                            $stashParams = [
                                'investorId' => $user->investor()->id,
                                'customerId' => $trnxData->customer->customer_code,
                                'totalAmount' => $amountPaid + 1000,
                                'availableAmount' => $amountPaid + 1000
                            ];
                        }
                        $stash->create($stashParams);
                    } else {
                        if ($trnxType != 'saving') {
                            $stash->increment('availableAmount', $amountPaid);
                        }
                    }
                    if ($trnxType == 'saving'){
                        $subData = [
                            "customer" => $user->email,
                            "plan" => $tranxDetails->plan_code
                        ];
                        $result = $this->api->call("/subscription", 'POST', $subData);
                        if ($result->status != true){
                            \Session::put('danger', true);
                            return back()->withErrors("An Error Occurred");
                        }
                        $sav = $this->saving->where('plan_code', $tranxDetails->plan_code);
                        $savD = $sav->first();
                        if ($savD->interval == "weekly"){
                            $nextP = Carbon::now()->addWeeks(1);
                        }
                        elseif ($savD->interval == "monthly"){
                            $nextP = Carbon::now()->addMonths(1);
                        }
                        else{
                            $nextP = Carbon::now()->addDays(1);
                        }
                        $sav->update(
                            ["sub_code" => $result->data->subscription_code, "email_token" => $result->data->email_token, 'nextPayment' => $nextP, 'isStarted' => true]
                        );
                        $sav->increment('monthsPaid', 1);
                    }

                    $tranxDetail->update([
                        "isCompleted" => true
                    ]);
                    \Session::put('success', true);
                    return redirect('dashboard/i/stash')->withErrors('Stash credited successfully');
                }else {
                    $stash = $this->stash->where('investorId', $user->investor()->id);

                    if ($stash->first() === null) {
                        $stashParams = [
                            'investorId' => $user->investor()->id,
                            'customerId' => $trnxData->customer->customer_code,
                            'totalAmount' => 1000,
                            'availableAmount' => 1000
                        ];
                        $stash->create($stashParams);
                    }
                    $gr = $this->referral->where(['userId' => $user->id, 'hasPayed' => false]);
                    $getRef = $gr->first();

                    if ($getRef !== null) {
                        $refId = $this->investor->where('userId', $getRef->refererId)->first();
                        $refStash = $this->stash->where('investorId', $refId->id);
                        $refStash->increment('totalAmount', 0);
                        $refStash->increment('availableAmount', 0);
                        $gr->update(['hasPayed' => true]);
                    }
                    if ($tranxDetails->portfolioId !== null) {
                        $portfolioId = $tranxDetails->portfolioId;
                        $getPortfolio = $this->portfolio->where("id", $portfolioId);

                        $getP = $getPortfolio->first();
                        if ($getP === null) {
                            \Session::put('danger', true);
                            return redirect('dashboard/i')->withErrors('An error has occurred');
                        }

                        $units = $amountPaid / $getP->amountPerUnit;

                        $invData = [
                            'userId' => $user->id,
                            "investorId" => $user->investor()->id,
                            "portfolioId" => $portfolioId,
                            "transactionId" => $trnXId,
                            "unitsBought" => $units,
                            "amount" => $amountPaid,
                            "paymentMethod" => "bank",
                            "datePurchased" => Carbon::now(),
                            "period" => $tranxDetails->months,
                            "oldInv" => false,
                            "isCompleted" => true
                        ];

                        $getPer = $this->rates->where("id", $portfolioId)->first();
                        if ($tranxDetails->months == "3"){
                            $roiInPer = $getPer->three - $getP['managementFee'];
                        }
                        elseif ($tranxDetails->months == "6"){
                            $roiInPer = $getPer->six - $getP['managementFee'];
                        }
                        elseif ($tranxDetails->months == "9"){
                            $roiInPer = $getPer->nine - $getP['managementFee'];
                        }
                        else{
                            $roiInPer = $getPer->twelve - $getP['managementFee'];
                        }
                        $roi = (($roiInPer / 100) * $amountPaid);

                        $invData["roi"] = $roi;
                        $getPortfolio->decrement('sizeRemaining', $amountPaid);
                        $this->investment->create($invData);
                        $tranxDetail->update([
                            "isCompleted" => true
                        ]);
                        \Session::put('success', true);
                        return redirect('dashboard/i/investments')->withErrors("You have successfully invested into '" . $getP->name . "'");
                    }

                    \Session::put('danger', true);
                    return redirect('dashboard/i')->withErrors('An error has occurred: ');
                }
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            if ($user->type == "business"){
                return redirect('dashboard/')->withErrors('An error has occurred: '.$e->getMessage());
            }
            elseif($user->type == "introducer"){
                return redirect('dashboard/e')->withErrors('An error has occurred: '.$e->getMessage());
            }
            else{
                return redirect('dashboard/i')->withErrors('An error has occurred: '.$e->getMessage());
            }
        }
    }

    public function transfer(Request $request){
        try{
            $data = $request->all();

            $user = Auth::user();

            $validation = $this->validate->transaction($data, 'transfer');
            if($validation->fails())
            {
                return response()->json(["message" => $validation->getMessageBag(), "error" => true, "data" => []], 200);
            } else {
                $stash = $this->stash->where('investorId', $data["investorId"])->first();

                if(($stash->availableAmount - $data["amount"]) < 1000){
                    return response()->json(["message" => "An Error Occurred: Insufficient funds", "error" => true, "data" => []], 200);
                }

                $transParams = [
                    'investorId' => $data["investorId"],
                    'amount' => $data["amount"],
                    'message' => "The Money will be disbursed soon",
                    'transfer_code' => "unknown",
                ];
                $this->mail->sendTransferReminder($user);
                $this->transferRequest->create($transParams);
            }
        }
        catch(\Exception $e){
            return response()->json(["message" => "An Error Occurred ".$e->getMessage(), "error" => true, "data" => []], 200);
        }
        return response()->json(["message" => "Transfer Initiated, The transaction will be validated in the next 24hours", "error" => false, "data" => $transParams], 200);
    }
    
    public function transferBusiness(Request $request){
        try{
            $data = $request->all();

            $user = Auth::user();

            $validation = $this->validate->transaction($data, 'transferBusiness');
            if($validation->fails())
            {
                \Session::put('danger', true);
                return back()->withErrors($validation->getMessageBag());
            } else {
                $wallet = $this->safe->where('userId', $data["userId"])->first();

                if($wallet == null){
                    \Session::put('danger', true);
                    return back()->withErrors("An Error Occurred: Insufficient funds");
                }
                if(($wallet->availableAmount - $data["amount"]) < 1000){
                    \Session::put('danger', true);
                    return back()->withErrors("An Error Occurred: Insufficient funds");
                }

                $transParams = [
                    'userId' => $data["userId"],
                    'amount' => $data["amount"],
                    'message' => "The Money will be disbursed soon",
                    'transfer_code' => "unknown",
                ];
                if ($data['type'] == 'introducer'){
                    $this->mail->sendTransferIReminder($user);
                }
                else{
                    $this->mail->sendTransferBReminder($user);
                }
                $this->transferBRequest->create($transParams);
            }
        }
        catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors("An Error Occurred ".$e->getMessage());
        }
        \Session::put('success', true);
        return back()->withErrors("Transfer Initiated, The transaction will be validated in the next 24hours");
    }


    public function commissionFee(Request $request){
        try{
            $body = [
                'amount' => $request->amount * 100,
                'email' => $request->email
            ];

            $response = $this->api->call('/transaction/initialize', 'POST', $body);
            $data = [
                "email" => $request->email,
                "amount" => $request->amount,
                "type" => "credit",
                "fundId" => $request->fundId,
                "reference" => $response->data->reference
            ];
            $this->tranx->create($data);
            return redirect($response->data->authorization_url);
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
