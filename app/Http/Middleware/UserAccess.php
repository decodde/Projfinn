<?php

namespace App\Http\Middleware;

use App\Http\Helpers\partials as Partials;
use Closure;
use Auth;
use Illuminate\Support\Facades\View;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private $partials;
    public function __construct(Partials $partials) {
        $this->partials = $partials;
    }

    private function completeProfile($business) {
        $point = 0;

        $business->state ? $point += 10 : null;
        $business->categoryId ? $point += 10 : null;
        $business->financialRaise ? $point += 10 : null;
        $business->startDate ? $point += 10 : null;
        $business->size ? $point += 10 : null;
        $business->turnoverPercent ? $point += 10 : null;

        if($point < 60) {
            return true;
        } else {
            return false;
        }
    }

    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $user = Auth::user();

            if($user->business()) {
                $business = $user->business();
                $result = $business->score($business->id);
                if($result) {

                    $difference = $this->partials->getDateDifference($result->created_at, date('Y-m-d H:m:s'));

                    if($difference->months >= 1 && $difference->days == 0 && $difference->years >= 0) {
                        $test = true;
                    } else {
                        $test = false;
                    }

                    $result->grade = $this->partials->gradeScore($result->score);
                } else {
                    $test = true;
                }

                $bvn = $business->bvn;
                $guarantors = $business->guarantors;
                $documents = $business->documents;


                $profileLevel = $this->partials->profilePercentage($bvn, $guarantors, $documents, $test);
                $completeProfile = $this->completeProfile($business);

                if($test == true) {
                    \Session::put('eligibilityTestPrompt', true);
                } elseif(($profileLevel >= 10 && $profileLevel <= 20) || ($profileLevel >= 20 && $profileLevel < 30) || $profileLevel == 0) {
                    \Session::put('creditAssessmentPrompt', true);
                } else {
                    \Session::forget('creditAssessmentPrompt');
                    \Session::forget('eligibilityTestPrompt');
                    \Session::forget('completeProfilePrompt', true);

                    if($business->approvedAt == null) {
                        \Session::put('profileCompletedPrompt', true);
                    }
                }

                $completeProfile == true ? \Session::put('completeProfilePrompt', true) : \Session::forget('completeProfilePrompt');
            }

            View::share(['user' => $user]);
            View::share(['test' => $test ?? null]);
            View::share(['result' => $result ?? null]);
        } else {
            \Session::put('red', true);
            return redirect('login')->withErrors('You must be logged in first');
        }
        return $next($request);
    }
}
