<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Crypt;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Helpers\Validate;
use App\Http\Helpers\sendMail;
use App\Http\Helpers\partials as Partials;
use App\Models\ResetPassword;



class LoadController extends Controller
{
    //
    private $auth;
    private $user;
    private $validate;
    private $mail;
    private $reset;
    private $partials;
    public function __construct(Auth $auth, Validate $validate, User $user, sendMail $mail, ResetPassword $reset, Partials $partials)
    {
        $this->auth = $auth;
        $this->user = $user;
        $this->mail = $mail;
        $this->validate = $validate;
        $this->reset = $reset;
        $this->partials = $partials;
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

            if(!$this->auth::attempt($data))
                {
                    \Session::put('danger', true);
                    return back()->withErrors("Incorrect login details");

                } elseif($this->auth::user()->type === 'investor') {

                    return redirect('/dashboard/i')->withErrors('Welcome back'.$this->auth::user()->fullName);
                } else {

                    return redirect('dashboard')->withErrors("Welcome back ".$this->auth::user()->fullName);
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
                //store create the user info
                $userId = $this->user->create($body)->id;
                $body['id'] = $userId;

                //remove passwords from request body
                unset($body["password"]);
                unset($body["password_confirmation"]);

                $body['url'] = URL('activate-account/'.\Crypt::encrypt($userId));
                //You can decide to enable the send confirmation mail feature
                //by removing the comment below this line
                $this->mail->welcomeMessage($body);

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
            $query = $this->user->where("id", \Crypt::decrypt($id));

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
                    $token = Crypt::encrypt($findEmail->id);

                    //prepare mail variables
                    $data = [
                        "email" => $findEmail->email,
                        "name" => $findEmail->fullName,
                        "url" => URL('reset-password').'/'.$token,
                    ];

                    //create expiry time for password recovery
                    $expiry = $this->partials->saveExpiryTime($token);

                    //store the value in the database
                    $this->reset->create($expiry);

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
                        $this->user->where("id", $userId)->update(["password" => $newPassword]);

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


    public function logout() {
        try {
            Auth::logout();
            \Session::flush();

            return redirect('login')->withErrors('You\'re now logged out');
        } catch(\Exception $e) {
            \Session::put('red', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
