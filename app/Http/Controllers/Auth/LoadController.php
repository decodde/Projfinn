<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\fundPayment;
use App\Models\Funds;
use App\Models\loanRates;
use App\Models\Reserve;
use App\Models\Safe;
use App\Models\Saving;
use App\Models\Stash;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Crypt;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\TranxConfirm;
use App\Models\Referral;
use App\Models\Lender;
use App\Models\Portfolio;
use App\Models\Investment;
use App\Models\Transaction;

use App\Http\Helpers\Validate;
use App\Http\Helpers\sendMail;
use App\Http\Helpers\partials as Partials;
use App\Http\Helpers\apiHelper;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Cookie;



class LoadController extends Controller
{
    //
    private $auth;
    private $user;
    private $validate;
    private $mail;
    private $reset;
    private $partials;
    private $trnx;
    private $api;
    private $stash;
    private $referral;
    private $investor;
    private $portfolio;
    private $investment;
    private $transaction;
    private $fund;
    private $saving;
    private $payment;
    private $rates;
    private $reserve;
    private $safe;
    
    public function __construct(Auth $auth, Validate $validate, User $user, sendMail $mail, ResetPassword $reset, Partials $partials, TranxConfirm $trnx, apiHelper $api, Stash $stash, Referral $referral, Lender $investor, Portfolio $portfolio, Investment $investment, Transaction $transaction, Funds $fund, Saving $saving, fundPayment $payment, loanRates $rates, Reserve $reserve, Safe $safe)
    {
        $this->auth = $auth;
        $this->user = $user;
        $this->mail = $mail;
        $this->validate = $validate;
        $this->reset = $reset;
        $this->partials = $partials;
        $this->trnx = $trnx;
        $this->api = $api;
        $this->stash = $stash;
        $this->portfolio = $portfolio;
        $this->referral = $referral;
        $this->investor = $investor;
        $this->investment = $investment;
        $this->transaction = $transaction;
        $this->fund = $fund;
        $this->saving = $saving;
        $this->payment = $payment;
        $this->rates = $rates;
        $this->reserve = $reserve;
        $this->safe = $safe;
    }

    public function sendCsrfToken (Request $request){

        $csrfToken = Cookie::get('XSRF-TOKEN');
        return response()->json(["msg" => "Retrieved", "csrf" => $csrfToken], 200);
    }
    public function login(Request $request){


        //get request body
        $data = $request->except('_token');

        //validate the input
        $validation = $this->validate->auth($data, "login");

        if($validation->fails())
        {
            \Session::put('warning', true);
            return back()->withErrors($validation->getMessageBag())->withInput();
        }
        
        try {

            if(!$this->auth::attempt($data)) {
                \Session::put('danger', true);
                return back()->withErrors("Incorrect login details");
            }

            if($this->auth::user()->verified == false) {
                Auth::logout();
                \Session::flush();

                \Session::put('warning', true);
                return back()->withErrors("Your account is not verified. Kindly check your email for a verification link");
            }
            if ($this->auth::user()->type !== "admin" && $this->auth::user()->type !== "introducer"){
                $this->checkTrnx($this->auth::user()->email, $this->auth::user()->type);
            }
            
            if ($this->auth::user()->type === 'investor') {

                return redirect()->intended('/dashboard/i');
            }
            else if ($this->auth::user()->type === 'business') {
                return redirect()->intended('/dashboard');
            }
            else if ($this->auth::user()->type === 'introducer') {
                return redirect()->intended('/dashboard/e');
            }
            else{
                return redirect()->intended('/admin/rouzz/overview');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage())->withInput();
        }
    }

    public function createUser(Request $request) {
        try {
            //get request body
            $body = $request->except('_token');

            //validate request body
            $validation = $this->validate->auth($body, null);

            if($validation->fails())
            {
                //format the error messages
                $errorMessages = $this->partials->formatErrors($validation->getMessageBag()->messages());

                //return validation error
                return response()->json(["message" => $errorMessages], 403);
            } else {
                //encrypt password string
                $body["password"] = bcrypt($body["password"]);

                $body["name"] = $body["f_name"]." ".$body["l_name"] ;

                $body["referralSlug"] = str_random(10);
                //store create the user info
                $userId = $this->user->create($body)->id;
                $body['id'] = $userId;

                //remove passwords from request body
                unset($body["password"]);
                unset($body["password_confirmation"]);

                $body['url'] = URL('activate-account/'.\Crypt::encrypt($userId));
                //You can decide to enable the send confirmation mail feature
                //by removing the comment below this line
                if ($body["type"] === 'investor'){
                    $this->mail->welcomeMessage($body);
                }
                elseif ($body['type'] === 'introducer'){
                    $this->mail->welcomeMessageInt($body);
                }
                else{
                    $this->mail->welcomeMessageBus($body);
                }

                //it's a beautiful day, don't you think
                return response()->json(["message" => "User successfully created", "data" => $body], 200);
            }
        } catch(\Exception $e) {
            return response()->json(["message" => $e->getMessage()."Error by Mail"], 500);
        }
    }

    public function activateAccount(Request $request, $id) {
        try {
            //query
            $query = $this->user->where("id", decrypt($id));

            if($query->first() !== null) {
                $query->update(['verified' => true]);

                return redirect('login')->withErrors('Account successfully activated, you can now login to your dashboard');
            } else {
                \Session::put('danger', true);
                return redirect('login')->withErrors('Invalid activation key sent');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return redirect('login')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function forgotPassword(Request $request) {
        try {
            //get request body
            $body = $request->all();

            //validate the input
            $validation = $this->validate->auth($body, "recovery-link");

            if($validation->fails()) {
                \Session::put('warning', true);
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                //find the email address
                $findEmail = $this->user->where("email", $body["email"])->first();

                if($findEmail !== null)
                {
                    //create a recovery token from the user's ID
                    $token = encrypt($findEmail->id);

                    //prepare mail variables
                    $data = [
                        "email" => $findEmail->email,
                        "name" => $findEmail->name,
                        "url" => URL('reset-password').'/'.$token,
                    ];

                    //create expiry time for password recovery
                    $expiry = $this->partials->saveExpiryTime($token);

                    //store the value in the database
                    $this->reset->create($expiry);

//                    dd("Hey");
                    //send password recovery mail to user
                    $this->mail->sendPasswordRecoveryMail($data);

                    \Session::put('success', true);
                    return back()->withErrors("Password reset link was sent successfully");
                } else {
                    //email not found bro
                    \Session::put('warning', true);
                    return back()->withErrors("We couldn't find that email in our records, please create an account");
                }
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors($e->getMessage());
        }
    }

    public function resetPassword(Request $request) {
        try {
            //get request body
            $body = $request->all();

            //validate the user's input
            $validation = $this->validate->auth($body, "reset-password");

            if($validation->fails()) {
                \Session::put('warning', true);
                return back()->withErrors($validation->getMessageBag());
            } else {
                //find a match for the recovery token
                $findToken = $this->reset->where("token", $body['token'])->first();

                if($findToken !== null)
                {
                    $currentTime = strtotime(date("H:i"));

                    //check if token is expired or not
                    if(date("H:i", strtotime($findToken->time)) <= $currentTime)
                    {
                        //decrypt the token
                        $userId = Crypt::decrypt($findToken->token);

                        //encrypt the new password
                        $newPassword = bcrypt($body["password"]);

                        //save the new password
                        $this->user->where("id", $userId)->update(["password" => $newPassword, "verified" => true]);

                        //mark the token as used
                        $this->reset->where("token", $findToken->token)->update(["used" => true]);
                    } else {
                        //expired token
                        \Session::put('red', true);
                        return back()->withErrors("Password reset link expired");
                    }
                } else {
                    //wrong token bro.
                    \Session::put('red', true);
                    return back()->withErrors("Invalid token provided");
                }
            }
        } catch(\Exception $e) {
            \Session::put('red', true);
            return back()->withErrors($e->getMessage());
        }

        //don't be unsociable, connect with friends and family more often
        return redirect('login')->withErrors("Password successfully changed, you can now login to your dashboard");
    }

    public function checkTrnx($userEmail, $type)
    {
        $tranxDetail = $this->trnx->where(['email' => $userEmail, 'isCompleted' => false])->latest();

        $tranxDetails = $tranxDetail->first();
        $trnxData = $this->api->call('/transaction/verify/' . $tranxDetails->reference, 'GET')->data;

        $trnxType = $tranxDetails->type;

        $amountPaid = $trnxData->amount / 100;

        $user = $this->auth::user();

        if($tranxDetails !== null) {
             if ($type == "business" || $type == "introducer") {
                if ($trnxData->status == 'success') {
                    $params = [
                        'reference' => $trnxData->reference,
                        'status' => $trnxData->status,
                        'message' => $trnxData->message ?? $trnxData->gateway_response,
                        'amount' => $amountPaid,
                        'userId' => $user->id,
                        'type' => $trnxType
                    ];
                    
                     if ($type == "business"){
                        $params['businessId'] = $user->business()->id;
                    }
                    
                    $trnXId = $this->transaction->create($params)->id;
                    if ($trnxData->status !== 'success') {
                        $tranxDetail->update([
                            "isCompleted" => true
                        ]);
                        \Session::put('danger', true);
                        if ($type == "business"){
                            return redirect('dashboard/funds')->withErrors('Payment Failed');
                        }
                        else{
                            return redirect('dashboard/e/funds')->withErrors('Payment Failed');
                        }
                    }
                    if($trnxType == 'funding'){
                        $rePay = $this->payment->where(["fundId" => $tranxDetails->fundId, "isCompleted" => false]);
                        $rePayment = $rePay->first();

                        if ($rePayment->months_left <= 1) {
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
                        $tranxDetail->update([
                            "isCompleted" => true
                        ]);
                        \Session::put('success', true);
                        if ($type == "business"){
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
                        $preserve = $this->reserve->where(["reference" => $tranxDetails->reference, "isCompleted" => false]);
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
                        if ($type == "business"){
                            return redirect('dashboard/save')->withErrors('Transaction successful');
                        }
                        else{
                            return redirect('dashboard/e/save')->withErrors('Transaction successful');
                        }
                    }
                }
            } else {
                if ($trnxData->status == 'success') {

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
                    if ($trnxType == 'credit' || $trnxType == 'saving') {
                        $stash = $this->stash->where('investorId', $user->investor()->id);

                        if ($stash->first() === null) {
                            if ($trnxType == 'saving'){
                                $stashParams = [
                                    'investorId' => $user->investor()->id,
                                    'customerId' => $trnxData->customer->customer_code,
                                    'totalAmount' => $amountPaid + 1000,
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
                            $stash->increment('totalAmount', $amountPaid);
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
                                return redirect('/dashboard/i')->withErrors("An Error Occurred");
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
                    }
                    else {
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
                            if ($getP !== null) {

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
                            }
                        }
                    }

                }
            }
        }
    }

    public function logout() {
        try {
            Auth::logout();
            \Session::flush();

            return redirect('login')->withErrors('You\'re now logged out');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
