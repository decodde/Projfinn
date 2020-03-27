<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Eligibility;
use App\Models\Business;
use App\Models\Lender;
use App\Models\User;

use App\Http\Helpers\Validate;
use App\Http\Helpers\sendMail;
use App\Http\Helpers\partials as Partials;


use App\Http\Controllers\Auth\LoadController as Registration;
use App\Http\Controllers\Eligibility\LoadController as Eli;

use Cloudder as Cloudinary;


class LoadController extends Controller
{
    //
    private $user;
    private $mail;
    private $lender;
    private $partials;
    private $business;
    private $validate;
    private $cloudinary;
    private $eligibility;
    private $registration;
    private $eli;

    public function __construct(Business $business, User $user, Validate $validate, Cloudinary $cloudinary, sendMail $mail, Registration $registration, Partials $partials, Lender $lender, Eligibility $eligibility, Eli $eli) {
        $this->user = $user;
        $this->mail = $mail;
        $this->lender = $lender;
        $this->partials = $partials;
        $this->business = $business;
        $this->validate = $validate;
        $this->cloudinary = $cloudinary;
        $this->eligibility = $eligibility;
        $this->registration = $registration;
        $this->eli = $eli;
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

                $body['slug'] = str_random(20);
                $body['userId'] = $user->id;

                $body['name'] = $body['o_name'];
                $businessId = $this->business->create($body)->id;

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

    private function lender($request) {
        $body = $request->except('_token');

        //validate the input
        $validation = $this->validate->lender($body, "create");

        if($validation->fails())
        {
            \Session::put('warning', true);
            //return validation error
            return back()->withErrors($validation->getMessageBag())->withInput();
        } else {
            //create the  user's account
            $register = $this->registration->createUser($request)->getData();

            if(!isset($register->data)) {
                \Session::put('warning', true);
                return back()->withErrors($register->message)->withInput()->withInput();
            } else {
                $user = $register->data;

                $lenderData = $request->except('_token', 'fullName', 'password', 'password_confirmation', 'type');
                $lenderData['userId'] = $user->id;

                $this->lender->create($lenderData);

                return redirect('login')->withErrors('Account successfully created, please check your mailbox for an activation link');
            }
        }
    }

    public function create(Request $request) {
        try {
            if($request->type == 'business') {
                return $this->business($request);
            } else {
                return $this->lender($request);
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occured: '.$e->getMessage())->withInput();
        }
    }

    public function changeLogo(Request $request, $businessId) {
        try {
            $logo = $this->cloudinary::upload($request->logo)->getResult()['url'];

            $this->business->where('id', \Crypt::decrypt($businessId))->update(['logo' => $logo]);

            return back()->withErrors('Logo successfully changed');
        } catch(\Exception $e) {
            \Session::put('red', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function save(Request $request) {
        try {
            $body = $request->except('_token');

            //validate the input
            $validation = $this->validate->business($body, "save");

            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                if($request->cac) {
                    $body['cac'] = $this->cloudinary::upload($request->cacDoc)->getResult()['url'];

                    $this->business->profilePercentage($request->id, 5);
                }

                $this->business->where('id', $request->id)->update($body);

                return back()->withErrors('Changes successfully saved');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage())->withInput();
        }
    }

    public function delete(Request $request, $slug) {
        try {
            //initialize query
            $query = $this->business->where('slug', $slug);

            if($query->first()) {
                $business = $query->first();

                $userId = $business->userId;
                $businessId = $business->id;

                //delete all business account associations
                $business->purge($businessId);

                //delete the business owner profile
                $this->user->where('id', $userId)->delete();

                //finally delete the business from the system
                $query->delete();

                \Session::put('success', true);
                return redirect('office/businesses')->withErrors('Business successfully deleted');
            } else {
                \Session::put('danger', true);
                return back()->withErrors('Unable to delete business, incorrect business parameter provided.');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function approve(Request $request, $slug) {
        try {
            //initialize query
            $query = $this->business->where('slug', $slug);

            if($query->first()) {
                $query->update(['approvedAt' => date('Y-m-d'), 'matching' => true]);

                //send an approval mail to the business
                $this->mail->approvedBusiness($query->first());

                return back()->withErrors('Business has been successfully approved');
            } else {
                \Session::put('danger', true);
                return back()->withErrors('Unable to approve business, incorrect business parameter provided.');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
