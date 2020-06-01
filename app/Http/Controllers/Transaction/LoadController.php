<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Models\Funds;
use App\Models\Transaction;
use App\Models\Stash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\Lender;
use App\Models\lenderAccount;
use App\Models\Bank;
use App\Models\Portfolio;
use App\Models\Investment;
use App\Models\TranxConfirm;
use App\Http\Helpers\Validate;

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

    public function __construct(apiHelper $api, Transaction $transaction, Stash $stash, Referral $referral, Lender $investor, Portfolio $portfolio, Investment $investment, TranxConfirm $tranx, Validate $validate, lenderAccount $account, Bank $bank, Funds $fund){
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

    public function confirm(Request $request) {
        try {
            $reference = $request->reference;

            $trnxData = $this->api->call('/transaction/verify/'.$reference, 'GET')->data;

            $amountPaid = $trnxData->amount / 100;

            $user = \Auth::user();
            $tranxDetail = $this->tranx->where(['reference' => $reference, 'isCompleted' => false, 'email' => $user->email]);
            $tranxDetails = $tranxDetail->first();
            if($tranxDetails == null){
                \Session::put('danger', true);
                return redirect('dashboard/i')->withErrors('Something went Wrong');
            }

            $trnxType = $tranxDetails->type;


            if($user->type == "business"){
                $params = [
                    'reference' => $trnxData->reference,
                    'status' => $trnxData->status,
                    'message' => $trnxData->message ?? $trnxData->gateway_response,
                    'amount' => $amountPaid,
                    'investorId' => $user->business()->id,
                    'userId' => $user->id,
                    'type' => $trnxType
                ];

                $trnXId = $this->transaction->create($params)->id;

                $getFund = $this->fund->where('userId', $user->id)->update(["progress" => "visitation", "transactionId" => $trnXId, "hasPaidReg" => true]);
                $tranxDetail->update([
                    "isCompleted" => true
                ]);
                \Session::put('success', true);
                return redirect('dashboard/funds')->withErrors('Payment successfully');
            } else {
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

                //credit the Investor's wallet
                if ($trnxType == 'credit') {
                    $stash = $this->stash->where('investorId', $user->investor()->id);

                    if ($stash->first() === null) {
                        $stashParams = [
                            'investorId' => $user->investor()->id,
                            'customerId' => $trnxData->customer->customer_code,
                            'totalAmount' => $amountPaid,
                            'availableAmount' => $amountPaid
                        ];
                        $stash->create($stashParams);
                    } else {
                        $stash->increment('totalAmount', $amountPaid);
                        $stash->increment('availableAmount', $amountPaid);
                    }

                    $gr = $this->referral->where(['userId' => $user->id, 'hasPayed' => false]);
                    $getRef = $gr->first();

                    if ($getRef !== null) {
                        $refId = $this->investor->where('userId', $getRef->refererId)->first();
                        $refStash = $this->stash->where('investorId', $refId->id);
                        $refStash->increment('totalAmount', 2000);
                        $refStash->increment('availableAmount', 2000);
                        $gr->update(['hasPayed' => true]);
                    }
                    $tranxDetail->update([
                        "isCompleted" => true
                    ]);
                    \Session::put('success', true);
                    return redirect('dashboard/i/stash')->withErrors('Stash credited successfully');
                } else {
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
                        ];


                        $roiInPer = $getP['returnInPer'] - $getP['managementFee'];
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
            return redirect('dashboard/i')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function transfer(Request $request){
        try{
            $data = $request->all();

            $validation = $this->validate->transaction($data, 'transfer');
            if($validation->fails())
            {
                return response()->json(["message" => $validation->getMessageBag(), "error" => true, "data" => []], 200);
            } else {
                $userAcc = $this->account->where('userId', $data["userId"])->first();
                $stash = $this->stash->where('investorId', $data["investorId"])->first();
                $userBank = $this->bank->where('id', $userAcc->bankId)->first();

                if ($stash->recipientId == null){
                    $body = [
                        "type" => 'nuban',
                        "name" => $data["name"],
                        "description" => "Payout From Rouzo",
                        "account_number" => $userAcc->accountNumber,
                        "bank_code" => $userBank->code,
                        "currency" => "NGN",
                    ];
                    $recRes = $this->api->call('/transferrecipient', 'POST', $body)->data;
                    $this->stash->where('investorId', $data["investorId"])->update([
                        "recipientId" => $recRes->recipient_code,
                    ]);

                    $recipient_code = $recRes->recipient_code;
                }
                else{
                    $recipient_code = $stash->recipientId;
                }

                if(($stash->availableAmount - $data["amount"]) < 1000){
                    return response()->json(["message" => "An Error Occurred: Insufficient funds", "error" => true, "data" => []], 200);
                }

                $params = [
                    "source" => "balance",
                    "reason" => "Payout From Rouzo",
                    "amount" => $data["amount"] * 100,
                    "recipient" => $recipient_code,
                ];

                $transferRes = $this->api->call('/transfer', 'POST', $params);

                $stash = $this->stash->where('investorId', $data["investorId"]);

                $stash->decrement('totalAmount', $data["amount"]);
                $stash->decrement('availableAmount', $data["amount"]);
            }
        }
        catch(\Exception $e){
            return response()->json(["message" => "An Error Occurred ".$e->getMessage(), "error" => true, "data" => []], 200);
        }
        return response()->json(["message" => "Transfer Successful", "error" => false, "data" => $transferRes], 200);
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
