<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Introducer;
use Illuminate\Http\Request;

use App\Http\Helpers\partials as Partials;
use Crypt;
use App\Models\Category;
use App\Models\LenderCategory;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class PageController extends Controller
{
    //
    private $partials;
    private $category;
    private $l_category;
    private $user;
    private $introducer;
    public function __construct(Partials $partials, Category $category, LenderCategory $l_category, User $user, Introducer $introducer)
    {
        $this->partials = $partials;
        $this->category = $category;
        $this->l_category = $l_category;
        $this->user = $user;
        $this->introducer = $introducer;
    }

    public function login(Request $request){
        $data = [
            'title' => 'Sign In',
        ];
//        dd("Hey");
        return view('auth.login', $data);
    }


    public function forgotPassword(Request $request){
        $data = [
            'title' => 'Forgot Password',
        ];
//        dd("Hey");
        return view('auth.forgot-password', $data);
    }

    public function resetPassword(Request $request, $token){
        try{

            $id = decrypt($token);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return redirect('login')->withErrors('An error has occurred: ');
        }


        $user = $this->user->where('id', $id)->first();

        if($user === null){
            \Session::put('danger', true);
            return redirect('login')->withErrors('An error has occurred');
        }


        $name = explode(" ", $user->name);

        $user->f_name = $name[0];
        $user->l_name = $name[1];

        $data = [
            'title' => 'Reset Password',
            'user' => $user,
            'token' => $token,
        ];

        return view('auth.reset-password', $data);
    }

    public function lender(Request $request){
        try{

            if($request->has('rN') && $request->has('rC')){
                $r_user['name'] = decrypt($request->rN);
                $r_user['code'] = decrypt($request->rC);
            }
            else{
                $r_user = null;
            }
            $l_category = $this->l_category->get();

            $sizes = $this->partials->sizes();
            $durations = $this->partials->durations();
            $interestRates = $this->partials->interestRates();
            $minimumYears = $this->partials->minimumYears();
            $loanBand = $this->partials->loanBand();

            $data = [
                'title' => 'Create an Account',
                'sizes' => $sizes,
                'durations' => $durations,
                'interestRates' => $interestRates,
                'minimumYears' => $minimumYears,
                'loanBand' => $loanBand,
                'l_category' => $l_category,
                'r_user' => $r_user
            ];


            return view('auth.lenders', $data);
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return redirect('login')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function eligibilityTest(Request $request) {
        try {
            $eligibilityOptions = $this->partials->eligibilityOptions();

            if($request->has('rN') && $request->has('rC') && $request->has('ml')){
                $r_user['name'] = decrypt($request->rN);
                $r_user['code'] = decrypt($request->rC);
                if($request->ml === 'nomail'){
                    $r_user['email'] = $request->ml;
                }
                else{
                    $r_user['email'] = decrypt($request->ml);
                }
            }
            else{
                $r_user = null;
            }

            $data = ['title' => 'Check Eligibility', 'eligibilityOptions' => $eligibilityOptions, 'r_user' => $r_user];

            return view('auth.business', $data);
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return redirect('/')->withErrors($e->getMessage());
        }
    }

    public function referral(Request $request, $referralSlug)
    {

        $r_user = $this->user->where('referralSlug', $referralSlug)->first();

        if($r_user === null){
            \Session::put('danger', true);
            return redirect('login')->withErrors('Incorrect URL');
        }

        $name = explode(" ", $r_user['name']);
        $r_user["f_name"] = $name[0];
        $r_user["l_name"] = $name[1];
        return redirect('lender?rC='.encrypt($referralSlug).'&rN='.encrypt($r_user["f_name"]));
    }

    public function businessInvite(Request $request, $slug, $email)
    {
        try {

            $r_user = $this->introducer->where('slug', $slug)->first();

            if ($r_user === null) {
                \Session::put('danger', true);
                return redirect('login')->withErrors('Incorrect URL');
            }
            return redirect('business?rC=' . encrypt($slug) . '&rN=' . encrypt($r_user->name) . '&ml=' . $email);
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return redirect('business')->withErrors('An Error Occurred');
        }
    }

    public function introducer(Request $request){
        $data = [
            'title' => 'Sign Up : Introducer',
        ];
        return view('auth.introducer', $data);
    }
}
