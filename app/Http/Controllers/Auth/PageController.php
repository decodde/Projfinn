<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Helpers\partials as Partials;
use Crypt;
use App\Models\Category;
use App\Models\LenderCategory;

class PageController extends Controller
{
    //
    private $partials;
    private $category;
    private $l_category;
    public function __construct(Partials $partials, Category $category, LenderCategory $l_category)
    {
        $this->partials = $partials;
        $this->category = $category;
        $this->l_category = $l_category;
    }

    public function login(Request $request){
        $data = [
            'title' => 'Sign In',
        ];
//        dd("Hey");
        return view('auth.login', $data);
    }

    public function lender(Request $request){
        try{
            $categories = $this->category->select('id', 'name')->orderBy('name', 'ASC')->get();
            $l_category = $this->l_category->get();

            $sizes = $this->partials->sizes();
            $durations = $this->partials->durations();
            $interestRates = $this->partials->interestRates();
            $minimumYears = $this->partials->minimumYears();
            $loanBand = $this->partials->loanBand();

            $data = [
                'title' => 'Create an Account',
                'categories' => $categories,
                'sizes' => $sizes,
                'durations' => $durations,
                'interestRates' => $interestRates,
                'minimumYears' => $minimumYears,
                'loanBand' => $loanBand,
                'l_category' => $l_category,
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

            $data = ['title' => 'Check Eligibility', 'eligibilityOptions' => $eligibilityOptions];

            return view('auth.business', $data);
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors($e->getMessageBag());
        }
    }
}
