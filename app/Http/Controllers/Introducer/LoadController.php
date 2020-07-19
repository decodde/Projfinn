<?php

namespace App\Http\Controllers\Introducer;

use App\Http\Controllers\Controller;
use App\Models\Introducer;
use App\Models\Invite;
use App\Models\User;
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
    public function __construct(sendMail $mail, Validate $validate, Registration $registration, Introducer $introducer, Invite $invite, User $user)
    {
        $this->mail = $mail;
        $this->validate = $validate;
        $this->registration = $registration;
        $this->introducer = $introducer;
        $this->invite = $invite;
        $this->user = $user;
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
                $user = $register->data;
                if(!isset($register->data)) {
                    \Session::put('warning', true);
                    return back()->withErrors($register->message)->withInput()->withInput();
                } else {

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
}
