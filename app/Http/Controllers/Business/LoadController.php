<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Models\Introducer;
use App\Models\Invite;
use App\Models\TranxConfirm;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Eligibility;
use App\Models\Business;
use App\Models\Lender;
use App\Models\Reserve;

use App\Http\Helpers\Validate;

use App\Http\Controllers\Auth\LoadController as Registration;
use App\Http\Controllers\Eligibility\LoadController as Eli;

class LoadController extends Controller
{
    //
    private $lender;
    private $business;
    private $validate;
    private $eligibility;
    private $registration;
    private $eli;
    private $invite;
    private $introducer;
    private $reserve;
    private $api;
    private $tranx;

    public function __construct(Business $business, Validate $validate, Registration $registration, Lender $lender, Eligibility $eligibility, Eli $eli, Introducer $introducer, Invite $invite, Reserve $reserve, apiHelper $api, TranxConfirm $tranx) {
        $this->lender = $lender;
        $this->business = $business;
        $this->validate = $validate;
        $this->eligibility = $eligibility;
        $this->registration = $registration;
        $this->eli = $eli;
        $this->invite = $invite;
        $this->introducer = $introducer;
        $this->reserve = $reserve;
        $this->api = $api;
        $this->tranx = $tranx;
    }

    public function business(Request $request) {
        $body = $request->except('_token');

        //validate the input
        $validation = $this->validate->business($body, "create");

        if($validation->fails())
        {
            \Session::put('warning', true);
            //return validation error
            return back()->withErrors($validation->getMessageBag())->withInput();
        } else {
            //create the user's account
            $elidata = [
                'registrationStatus' => $body['registrationStatus'],
                'yearsOfRunning' => $body['yearsOfRunning'],
                'lastBusinessRevenue' => $body['lastBusinessRevenue'],
                'accountVerifiable' => $body['accountVerifiable']
            ];
            $this->eli->score($elidata);

            $register = $this->registration->createUser($request)->getData();

            if(!isset($register->data)) {
                \Session::put('warning', true);
                return back()->withErrors($register->message)->withInput();
            } else {
                $user = $register->data;

                if ($request->has('rCode')){
                    $referrer = $this->introducer->where('slug', $request->rCode)->first();

                    if($request->has('nomail')){
                        $params = [
                            "introducerId" => $referrer->id,
                            "businessName" => $body['o_name'],
                            "slug" => str_random(20),
                            "email" => $body["email"],
                            "hasSignUp" => true,
                        ];

                        $this->invite->create($params);
                    }
                    else{
                        $getInvite = $this->invite->where(['email' => $body["email"], 'introducerId' => $referrer->id]);

                        if ($getInvite->first() !== null){
                            $getInvite->update(['hasSignUp' => true]);
                        }
                    }
                }

                $body['slug'] = str_random(20);
                $body['userId'] = $user->id;

                $body['name'] = $body['o_name'];
                $businessId = $this->business->create($body)->id;

                $this->business->where("id", $businessId)->update(["rID" => "BUS/Rouzo/00".$businessId]);

                if(\Session::has('scoreQuery')) {
                    $scoreQuery = [];
                    parse_str(\Session::get('scoreQuery'), $scoreQuery);

                    $scoreQuery['businessId'] = $businessId;
                    $this->eligibility->create($scoreQuery);

//                    \Auth::loginUsingId($body['userId']);

                    \Session::forget('scoreQuery');

                    return redirect('login')->withErrors('Account successfully created, please check your mailbox for an activation link');
                } else {
                    return redirect('login')->withErrors('Account successfully created, please check your mailbox for an activation link');
                }
            }
        }
    }

    public function create_reserve(Request $request){
        try{
            $data = $request->except('_token');

            $body = [
                'amount' => $data["amount"] * 100,
                'email' => $data["email"]
            ];

            $response = $this->api->call('/transaction/initialize', 'POST', $body);

            $Tranxdata = [
                "email" => $data['email'],
                "amount" => $data['amount'],
                "type" => "reserve",
                "reference" => $response->data->reference,
            ];

            $this->tranx->create($Tranxdata);

            $now = Carbon::now();
            $now = Carbon::create($now->isoFormat('YYYY-MM-DD'));

            $expectedDay = Carbon::create(Carbon::now()->isoFormat('YYYY-MM-DD'))->addMonths(3);

            if($data["interval"] == 'daily'){
                $duration = $now->diffInDays($expectedDay);
            }
            elseif ($data["interval"] == 'weekly'){
                $duration = $now->diffInWeeks($expectedDay);
            }
            else{
                $duration = 3;
            }
            $reserveData = [
                'email' => $data['email'],
                'name' => $data["name"],
                'amount' => $data["amount"],
                'interval' => $data["interval"],
                'reference' => $response->data->reference,
                'duration' => $duration,
            ];
            $this->reserve->create($reserveData);
            return redirect($response->data->authorization_url);
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return redirect('dashboard')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

}
