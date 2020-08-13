<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\partials;
use App\Http\Helpers\sendMail;
use App\Models\Admin;
use App\Models\Funds;
use App\Models\Introducer;
use App\Models\Investment;
use App\Models\Lender;
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
    public function __construct(User $user, apiHelper $api, Validate $validate, Transaction  $transaction, Stash $stash, Referral $referral, Lender $investor, Portfolio $portfolio, Investment $investment, Funds $funds, sendMail $mail, transferRequest $transferRequest, Business $business, Introducer $introducer, Admin $admin, partials $partials, TranxConfirm $confirm){
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


                $getPer = $this->partials->loanTypes(strtolower($getP["name"]));
                $roiInPer = $getPer[$data["period"]] - $getP['managementFee'];
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
            $this->funds->where('businessId', $data["businessId"])->update(['progress' => $data["progress"]]);

            if($data["progress"] === "payment") {
                $params = [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "url" => URL('/dashboard')
                ];
                $this->mail->sendMailForPayment($params);
            }

            if($data["progress"] === "approved") {
                $this->funds->where('businessId', $data["businessId"])->update(['amount' => $data["amount"], 'message' => $data["message"]]);
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
            $data = $request->except('_token');

            $params = [
                'transfer_code' => $data['transfer_code'],
                'otp' => $data['otp'],
            ];

            $transferVerify = $this->api->call('/transfer/finalize_transfer', 'POST', $params);

            if ($transferVerify->status == false){
                \Session::put('danger', true);
                return back()->withErrors('Invalid Otp');
            }

            $this->transferRequest->where(['transfer_code' => $data['transfer_code'], 'investorId' => $data['investorId']])->update(['otpConfirmed' => true, 'reference' => $transferVerify->data->reference]);
            $stash = $this->stash->where('investorId', $data["investorId"]);

            $stash->decrement('totalAmount', $transferVerify->data->amount / 100);
            $stash->decrement('availableAmount', $transferVerify->data->amount / 100);

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
}
