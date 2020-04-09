<?php

namespace App\Http\Controllers\Lender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Lender;
use App\Models\User;
use App\Models\Credit;
use App\Models\Preference;

use App\Http\Helpers\Validate;
use App\Http\Helpers\sendMail;
use App\Http\Helpers\partials as Partials;

use App\Http\Controllers\Auth\LoadController as Registration;

use Cloudder as Cloudinary;

class LoadController extends Controller
{
    private $user;
    private $mail;
    private $lender;
    private $partials;
    private $credit;
    private $validate;
    private $cloudinary;
    private $registration;
    private $preference;

    public function __construct(User $user, Validate $validate, Cloudinary $cloudinary, sendMail $mail, Registration $registration, Partials $partials, Preference $preference, Lender $lender, Credit $credit) {
        $this->user = $user;
        $this->mail = $mail;
        $this->lender = $lender;
        $this->partials = $partials;
        $this->credit = $credit;
        $this->validate = $validate;
        $this->cloudinary = $cloudinary;
        $this->registration = $registration;
        $this->preference = $preference;
    }

    public function create(Request $request) {
        try {
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
//                    dd("Hey");
                    $user = $register->data;
                    $lenderData = $request->only('l_name', 'f_name', 'email', 'phone', 'address');

                    $lenderData['userId'] = $user->id;

                    $lenderData['name'] = $user->name;

                    $lenderId = $this->lender->create($lenderData)->id;

                    $preferenceData = $request->only('band', 'turnover', 'otherRequirements', 'categoryIds', 'year', 'duration', 'rate', 'lenderCategoryId');
                    $preferenceData['lenderId'] = $lenderId;
                    $preferenceData['categoryIds'] = implode(',', $request->categoryIds);

                    $this->preference->create($preferenceData);

                    //create match credit profile
                    $this->credit->create(['lenderId' => $lenderId]);

                    return redirect('login')->withErrors('Account successfully created, please check your mailbox for an activation link');
                }
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage())->withInput();
        }
    }

    public function save(Request $request, $lenderId) {
        try {
            $body = $request->except('_token');

            //validate the input
            $validation = $this->validate->lender($body, "edit");

            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                if($request->email) {
                    $this->user->where('id', $request->userId)->update(['email' => $request->email]);
                }

                $this->lender->where('id', $lenderId)->update($body);

                return back()->withErrors('Changes successfully saved');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage())->withInput();
        }
    }

    public function preference(Request $request, $lenderId) {
        try {
            $body = $request->except('_token');

            //validate the input
            $validation = $this->validate->lender($body, "preference");

            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                $preferenceQuery = $this->preference->where('lenderId', $lenderId);
                $body['categoryIds'] = implode(',', $request->categoryIds);

                if($preferenceQuery->count() > 0) {
                    $preferenceQuery->update($body);
                } else {
                    $this->preference->create($body);
                }

                return back()->withErrors('Changes successfully saved');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage())->withInput();
        }
    }

    public function logo(Request $request, $lenderId) {
        try {
            $logo = $request->file('logo')->getRealPath();
            $slug = 'logo_'.str_random(20);

            $this->cloudinary::upload($logo, $slug);
            $newLogo = $this->cloudinary::show($slug);

            $this->lender->where('id', \Crypt::decrypt($lenderId))->update(['logo' => $newLogo]);

            return back()->withErrors('Logo successfully changed');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occured: '.$e->getMessage())->withInput();
        }
    }

    public function delete(Request $request, $lenderId) {
        try {
            $lenderId = \Crypt::decrypt($lenderId);

            //initialize query
            $query = $this->lender->where('id', $lenderId);

            if($query->first()) {
                $lender = $query->first();

                $userId = $lender->userId;
                $lenderId = $lender->id;

                //delete all lender's account associations
                $lender->purge($lenderId);

                //delete the lender's owner profile
                $this->user->where('id', $userId)->delete();

                //finally delete the lender's from the system
                $query->delete();

                \Session::put('success', true);
                return redirect('office/lenders')->withErrors('Lender successfully deleted');
            } else {
                \Session::put('danger', true);
                return back()->withErrors('Unable to delete lender, incorrect lender parameter provided.');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occured: '.$e->getMessage())->withInput();
        }
    }
}
