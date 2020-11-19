<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\partials;
use App\Http\Helpers\sendMail;
use App\Models\Admin;
use App\Models\fundPayment;
use App\Models\Funds;
use App\Models\Introducer;
use App\Models\Investment;
use App\Models\Lender;
use App\Models\loanRates;
use App\Models\Portfolio;
use App\Models\Referral;
use App\Models\Stash;
use App\Models\Transaction;
use App\Models\transferRequest;
use App\Models\TranxConfirm;
use App\Models\User;
use App\Models\Business;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Helpers\Validate;
use App\Http\Helpers\apiHelper;

class LoadController extends Controller
{
    //
    private $user;
    private $api;
    private $transaction;
    private $validate;
    private $stash;
    private $referral;
    private $investor;
    private $portfolio;
    private $investment;
    private $funds;
    private $mail;
    private $transferRequest;
    private $business;
    private $admin;
    private $introducer;
    private $partials;
    private $confirm;
    private $fundPayment;
    private $rates;
    public function __construct(User $user, apiHelper $api, Validate $validate, Transaction  $transaction, Stash $stash, Referral $referral, Lender $investor, Portfolio $portfolio, Investment $investment, Funds $funds, sendMail $mail, transferRequest $transferRequest, Business $business, Introducer $introducer, Admin $admin, partials $partials, TranxConfirm $confirm, fundPayment $fundPayment, loanRates $rates){
        $this->user = $user;
        $this->api = $api;
        $this->transaction = $transaction;
        $this->validate = $validate;
        $this->stash = $stash;
        $this->referral = $referral;
        $this->investor = $investor;
        $this->portfolio = $portfolio;
        $this->investment = $investment;
        $this->funds = $funds;
        $this->mail = $mail;
        $this->transferRequest = $transferRequest;
        $this->business = $business;
        $this->introducer = $introducer;
        $this->admin = $admin;
        $this->partials = $partials;
        $this->confirm = $confirm;
        $this->fundPayment = $fundPayment;
        $this->rates = $rates;
    }

    public function adminConfirm(Request $request){
        try {
            $data = $request->except('_token');

            $validation = $this->validate->transaction($data, "admin");
            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            }

            $user = $this->user->where('email', $data["email"])->first();

            if ($user == null){
                \Session::put('danger', true);
                return back()->withErrors('Email does not exist');
            }

            if ($user->investor() == null){
                \Session::put('danger', true);
                return back()->withErrors('User is not an investor');
            }
            $ref = '9705'.str_random(10);

            $Cdata = [
                "email" => $data["email"],
                "amount" => $data["amount"],
                "type" => "credit",
                "reference" => $ref,
                "portfolioId" => $data['portfolioId'],
                "months" => $data["period"]
            ];
            $trnxConfirmId = $this->confirm->create($Cdata)->id;


            $params = [
                'reference' => $ref,
                'status' => "success",
                'message' => "Approved",
                'amount' => $data["amount"],
                'investorId' => $user->investor()->id,
                'userId' => $user->id,
                'type' => "credit"
            ];

            $trnXId = $this->transaction->create($params)->id;

            //credit the Investor's wallet
            $stash = $this->stash->where('investorId', $user->investor()->id);
            $customerRaw = $this->api->call('/customer/'.$user->email, 'GET');

            if ($customerRaw->status != false) {
                $customer = $customerRaw->data;
                if ($stash->first() === null) {
                    $stashParams = [
                        'investorId' => $user->investor()->id,
                        'customerId' => $customer->customer_code,
                        'totalAmount' => 0,
                        'availableAmount' => 0
                    ];
                    $stash->create($stashParams);
                }
                $gr = $this->referral->where(['userId' => $user->id, 'hasPayed' => false]);
                $getRef = $gr->first();

                if ($getRef !== null) {
                    $refId = $this->investor->where('userId', $getRef->refererId)->first();
                    $refStash = $this->stash->where('investorId', $refId->id);
                    $refStash->increment('totalAmount', 1000);
                    $refStash->increment('availableAmount', 1000);
                    $gr->update(['hasPayed' => true]);
                }
            }
            if ($data['portfolioId'] !== null) {
                $portfolioId = $data['portfolioId'];
                $getPortfolio = $this->portfolio->where("id", $portfolioId);

                $getP = $getPortfolio->first();
                if ($getP === null) {
                    \Session::put('danger', true);
                    return back()->withErrors('An error has occurred');
                }

                $units = $data["amount"] / $getP->amountPerUnit;

                $invData = [
                    'userId' => $user->id,
                    "investorId" => $user->investor()->id,
                    "portfolioId" => $portfolioId,
                    "transactionId" => $trnXId,
                    "unitsBought" => $units,
                    "amount" => $data["amount"],
                    "paymentMethod" => "bank",
                    "datePurchased" => Carbon::now(),
                    "period" => $data["period"],
                    "oldInv" => false,
                    "isCompleted" => true
                ];


                $getPer = $this->rates->where("id", $portfolioId)->first();

                if ($data["period"] == "3"){
                    $roiInPer = $getPer->three - $getP['managementFee'];
                }
                elseif ($data["period"] == "6"){
                    $roiInPer = $getPer->six - $getP['managementFee'];
                }
                elseif ($data["period"] == "9"){
                    $roiInPer = $getPer->nine - $getP['managementFee'];
                }
                else{
                    $roiInPer = $getPer->twelve - $getP['managementFee'];
                }

                $roi = (($roiInPer / 100) * $data["amount"]);

                $invData["roi"] = $roi;
                $getPortfolio->decrement('sizeRemaining', $data["amount"]);
                $this->investment->create($invData);
                $this->confirm->where('id', $trnxConfirmId)->update([
                    "isCompleted" => true
                ]);

                \Session::put('success', true);
                return back()->withErrors("User Investment in '" . $getP->name . "' Recorded Successfully");
            }

            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: ');
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function fundStatus(Request $request)
    {
        try{
            $data = $request->except('_token');

            if($data["progress"] === "payment") {
                $params = [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "url" => URL('/dashboard')
                ];
                $this->mail->sendMailForPayment($params);
            }

            if($data["progress"] === "approved") {
                $fund_r = $this->funds->where('businessId', $data["businessId"]);

                $funding = $fund_r->first();
                $nextPayment = Carbon::now()->addMonths(1);

                $amountPerMonth = ($data["amount"] + ($data["amount"] * 0.15))/$data["months"];
                $paymentData = [
                  "userId" => $funding->userId,
                  "businessId" => $funding->businessId,
                  "fundId" => $funding->id,
                  "total_amount" => $data["amount"],
                  "months" => $data["months"],
                  "months_left" => $data["months"],
                  "amountPerMonth" => $amountPerMonth,
                  "nextPayment" => $nextPayment,

                ];

                $this->fundPayment->create($paymentData);

                $fund_r->update(['amount' => $data["amount"], 'message' => $data["message"]]);
            }

            if($data["progress"] === "rejected") {
                $this->funds->where('businessId', $data["businessId"])->update(['message' => $data["message"]]);
            }

            if($data["progress"] === "payment") {
                $params = [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "url" => URL('/dashboard')
                ];
                $this->mail->sendMailForPayment($params);
            }

            $this->funds->where('businessId', $data["businessId"])->update(['progress' => $data["progress"]]);
            \Session::put('success', true);
            return back()->withErrors('Application Status Changed');
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function verifyTransfer(Request $request)
    {
        try{
            $investorId = $request->investorId;
            $transferId = decrypt($request->id);
            $transfer = $this->transferRequest->where(['id' => $transferId, 'investorId' => $investorId]);

            $stash = $this->stash->where('investorId', $investorId);

            $stash->decrement('totalAmount', $transfer->first()->amount);
            $stash->decrement('availableAmount', $transfer->first()->amount);

            $transfer->update(['otpConfirmed' => true]);
            \Session::put('success', true);
            return back()->withErrors('Transaction Verified');
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function deleteUser(Request $request){
        try{
            $userId = decrypt($request->id);

            #Get User Details
            $getUser = $this->user->where(['id' => $userId, 'isDeleted' => false]);

            $user = $getUser->first();

            if($user === null){
                \Session::put('danger', true);
                return back()->withErrors('An Error Occurred');
            }
            #Check if user is investor or business
            if ($user->type === "investor"){
                #investor goes here
                $response = $this->deleteInvestor($user);

            }
            elseif ($user->type === "admin"){
                $response = $this->deleteAdmin($user);
            }
            elseif ($user->type === "introducer"){
                $response = $this->deleteIntroducer($user);
            }
            else{
                #business goes here
                $response = $this->deleteBusiness($user);
            }
            #Check Response
            if(!$response){
                \Session::put('danger', true);
                return back()->withErrors('An Error Occurred');
            }

            #Delete User
            $getUser->delete();
            \Session::put('success', true);
            return back()->withErrors('User Deleted Successfully');
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function deleteInvestor($user){
        try {
            #Get investor details
            $investor = $this->investor->where("userId", $user->id);
            if ($investor->first() !== null) {
                $investor->delete();
            }
            return true;
        }
        catch (\Exception $e){
            return false;
        }
    }

    public function deleteBusiness($user){
        try{
            $business = $this->business->where("userId", $user->id);
            if ($business->first() !== null) {
                $business->delete();
            }
            return true;
        }
        catch (\Exception $e){
            return false;
        }
    }

    public function deleteIntroducer($user){
        try{
            $introducer = $this->introducer->where("userId", $user->id);
            if ($introducer->first() !== null) {
                $introducer->delete();
            }
            return true;
        }
        catch (\Exception $e){
            return false;
        }
    }

    public function deleteAdmin($user){
        try{
            $admin = $this->admin->where("userId", $user->id);
            if ($admin->first() !== null) {
                $admin->delete();
            }
            return true;
        }
        catch (\Exception $e){
            return false;
        }
    }

    public function openPortfolio(Request $request){
        try {
            $id = decrypt($request->id);

            $this->portfolio->where("id", $id)->update([
                "isOpen" => true,
            ]);
            \Session::put('success', true);
            return back()->withErrors('Portfolio Opened Successfully');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function closePortfolio(Request $request){
        try {
            $id = decrypt($request->id);

            $this->portfolio->where("id", $id)->update([
                "isOpen" => false,
            ]);
            \Session::put('success', true);
            return back()->withErrors('Portfolio Closed Successfully');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function topUpPortfolio(Request $request){
        try {
            $id = decrypt($request->id);

            $portfolio = $this->portfolio->where("id", $id);
            $result = $portfolio->first();
            $amount = $request->units * $result->amountPerUnit;
            $portfolio->increment("size", $amount);
            $portfolio->increment("sizeRemaining", $amount);

            \Session::put('success', true);
            return back()->withErrors('Portfolio Top Up Successfully');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function createPortfolio(Request $request){
        try {

            $data = $request->except("_token");

            $portfolio_data = [
                "name" => $data["name"],
                "description" => $data["description"],
                "returnInPer" => $data["twelve"],
                "trustee" => "ARM Trusteeship",
                "riskLevel" => $data["risk"],
                "size" => $data["size"] * $data["amountPerUnit"],
                "uniqueCode" => "port". str_random(20),
                "sizeRemaining" => $data["size"] * $data["amountPerUnit"],
                "amountPerUnit" => $data["amountPerUnit"],
                "managementFee" => 0.5,
                "isOpen" => true,
            ];

            $portfolioId = $this->portfolio->create($portfolio_data)->id;

            $rates_data = [
                "portfolioId" => $portfolioId,
                "three" => $data["three"],
                "six" => $data["six"],
                "nine" => $data["nine"],
                "twelve" => $data["twelve"],
            ];

            $this->rates->create($rates_data);

            \Session::put('success', true);
            return back()->withErrors('Portfolio Created Successfully');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function creditStash(Request $request){
        try {
            $data = $request->except('_token');

            $validation = $this->validate->transaction($data, "credit");
            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            }

            $user = $this->user->where('email', $data["email"])->first();

            if ($user == null){
                \Session::put('danger', true);
                return back()->withErrors('Email does not exist');
            }

            if ($user->investor() == null){
                \Session::put('danger', true);
                return back()->withErrors('User is not an investor');
            }
            $ref = '9285'.str_random(10);

            $Cdata = [
                "email" => $data["email"],
                "amount" => $data["amount"],
                "type" => "credit",
                "reference" => $ref,
            ];
            $trnxConfirmId = $this->confirm->create($Cdata)->id;


            $params = [
                'reference' => $ref,
                'status' => "success",
                'message' => "Approved",
                'amount' => $data["amount"],
                'investorId' => $user->investor()->id,
                'userId' => $user->id,
                'type' => "credit"
            ];

            $trnXId = $this->transaction->create($params)->id;

            //credit the Investor's wallet
            $stash = $this->stash->where('investorId', $user->investor()->id);
            $customerRaw = $this->api->call('/customer/'.$user->email, 'GET');

            if ($customerRaw->status != false) {
                $customer = $customerRaw->data;
                if ($stash->first() == null) {
                    $stashParams = [
                        'investorId' => $user->investor()->id,
                        'customerId' => $customer->customer_code,
                        'totalAmount' => $data['amount'] + 1000,
                        'availableAmount' => $data['amount'] + 1000
                    ];
                    $stash->create($stashParams);
                }
                else{
                    $stash->increment('totalAmount', $data['amount']);
                    $stash->increment('availableAmount', $data['amount']);
                }
                $gr = $this->referral->where(['userId' => $user->id, 'hasPayed' => false]);
                $getRef = $gr->first();

                if ($getRef !== null) {
                    $refId = $this->investor->where('userId', $getRef->refererId)->first();
                    $refStash = $this->stash->where('investorId', $refId->id);
                    $refStash->increment('totalAmount', 1000);
                    $refStash->increment('availableAmount', 1000);
                    $gr->update(['hasPayed' => true]);
                }
                $this->confirm->where('id', $trnxConfirmId)->update([
                    "isCompleted" => true
                ]);
            }else{
                \Session::put('danger', true);
                return back()->withErrors('An error has occurred: ');
            }
            \Session::put('success', true);
            return back()->withErrors("Stash of '" . $user->name . "' Recorded Successfully");
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function confirmFund(Request $request){
        try{
            $data = $request->except('_token');
            $fund = $this->funds->where('id', $request->id);
            $getFunds = $fund->first();
            $payment = $this->fundPayment->where(["fundId" => $request->id, "isCompleted" => false]);
            $getPayment = $payment->first();

            $ref = '9285'.str_random(10);

            $Cdata = [
                "email" => $request->email,
                "amount" => $getPayment->amountPerMonth,
                "type" => "funding",
                "reference" => $ref,
            ];
            $trnxConfirmId = $this->confirm->create($Cdata)->id;

            $tranxDetail = $this->confirm->where('id', $trnxConfirmId);
            $params = [
                'reference' => $ref,
                'status' => 'success',
                'message' => 'Approved',
                'amount' => $getPayment->amountPerMonth,
                'businessId' => $getPayment->businessId,
                'userId' => $getPayment->userId,
                'type' => 'funding'
            ];

            $trnXId = $this->transaction->create($params)->id;
            $rePay = $this->fundPayment->where(["fundId" => $request->id, "isCompleted" => false]);
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
            return back()->withErrors('Fund Repayment recorded successfully');
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function liquidate(Request $request)
    {
        try {
            $investments = $this->investment->where(["" => $request->id, "isOpen" => true])->get();

            $counter = 0;
            foreach ($investments as $investment) {
                $now = Carbon::now();

                $pdate = Carbon::create($investment->datePurchased);
                $projectedDay = Carbon::create($investment->datePurchased)->addMonths($investment->period);

                $investment->diff = $now->diffInMonths($investment->datePurchased);

                $stash = $this->stash->where("investorId", $investment->investorId);

                if($investment->diff >= $investment->period){
                    $daysS = $pdate->diffInDays($projectedDay);
                    if($investment->oldInv == true){
                        $amt = (($daysS / 365) * $investment->roi) + $investment->amount;
                    }
                    else{
                        $amt = ($investment->roi + $investment->amount);
                    }
                    $stash->increment('totalAmount', $amt);
                    $stash->increment('availableAmount', $amt);

                    $this->investment->where("id", $investment->id)->update(["isOpen" => "false"]);
                    $getUser = $this->user->where("id", $investment->userId)->first();
                    $getPortfolio = $this->portfolio->where("id", $investment->portfolioId)->first();
                    $data = [
                        "email" => $getUser->email,
                        "name" => $getUser->name,
                        "amount" => ''.$this->formatter->MoneyConvert($investment->amount, 'full'),
                        "portfolio" => $getPortfolio->name,
                        "url" => URL('/dashboard/i/stash')
                    ];
                    $this->mail->sendInvestmentMature($data);
                    $counter++;
                }
            }

            return response()->json(['message' => $counter . ' investment found today'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error has occurred: ' . $e->getMessage()], 500);
        }
    }
}
