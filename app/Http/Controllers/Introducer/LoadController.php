<?php

namespace App\Http\Controllers\Introducer;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Models\Introducer;
use App\Models\Invite;
use App\Models\Reserve;
use App\Models\TranxConfirm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoadController as Registration;

use App\Http\Helpers\sendMail;
use App\Http\Helpers\Validate;
use Illuminate\Support\Facades\Auth;

class LoadController extends Controller
{
    //
    private $mail;
    private $validate;
    private $registration;
    private $introducer;
    private $invite;
    private $user;
    private $reserve;
    private $api;
    private $tranx;

    public function __construct(sendMail $mail, Validate $validate, Registration $registration, Introducer $introducer, Invite $invite, User $user, Reserve $reserve, apiHelper $api, TranxConfirm $tranx)
    {
        $this->mail = $mail;
        $this->validate = $validate;
        $this->registration = $registration;
        $this->introducer = $introducer;
        $this->invite = $invite;
        $this->user = $user;
        $this->reserve = $reserve;
        $this->api = $api;
        $this->tranx = $tranx;
    }

    public function create(Request $request) {
        try {
            $body = $request->except('_token');
            $validation = $this->validate->introducer($body, "create");

            if($validation->fails())
            {
                \Session::put('warning', true);
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                $register = $this->registration->createUser($request)->getData();
                
                if(!isset($register->data)) {
                    \Session::put('warning', true);
                    return back()->withErrors($register->message)->withInput()->withInput();
                } else {
                    $user = $register->data;
                    $params = $request->only('l_name', 'f_name', 'email', 'phone', 'address');

                    $params['userId'] = $user->id;

                    $params['name'] = $request->o_name;

                    $params['slug'] = str_random(20);

                    $this->introducer->create($params)->id;

                    return redirect('login')->withErrors('Account successfully created, please check your mailbox for an activation link');
                }
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage())->withInput();
        }
    }

    public function createInvite(Request $request){
        try {
            $user = Auth::user();
            $user->introducer = $user->introducer();
            $body = $request->except('_token');
            $validation = $this->validate->invite($body, "create");

            if($validation->fails())
            {
                \Session::put('warning', true);
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {

                $getUser = $this->user->where("email", $body["email"])->first();
                if($getUser !== null){
                    if($getUser->type !== "business"){
                        \Session::put('danger', true);
                        return back()->withErrors('Account already exist or Business account Not Found')->withInput();
                    }
                }
                $params = [
                    "introducerId" => $body["introducerId"],
                    "businessName" => $body["businessName"],
                    "slug" => str_random(20),
                    "email" => $body["email"],
                ];

                $this->invite->create($params);

                $params['name'] =  $user->introducer->name;
                $params['url'] = URL('rTD/'.$user->introducer->slug.'/'.encrypt($body["email"]));

                $this->mail->InviteBusiness($params);
                \Session::put('success', true);
                return back()->withErrors('Invite Sent Successfully');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage())->withInput();
        }
    }

    public function deleteInvite(Request $request, $inviteId){
        try {
            $query = $this->invite->where('id', \Crypt::decrypt($inviteId));
            $query->delete();

            \Session::put('success', true);
            return back()->withErrors('Invite Revoked Successfully');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage())->withInput();
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
            return redirect('dashboard/e')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}