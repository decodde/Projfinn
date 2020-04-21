<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use App\Models\User;
use App\Models\Eligibility;
use App\Models\Stash;
use App\Models\Transaction;
use App\Http\Helpers\partials;

class PageController extends Controller
{
    //
    private $auth;
    private $user;
    private $eligible;
    private $partials;
    private $transaction;
    private $stash;
    private $formatter;

    public function __construct(Auth $auth, User $user, Eligibility $eligible, partials $partials, Transaction $transaction, Stash $stash, Formatter $formatter){
        $this->auth = $auth;
        $this->user = $user;
        $this->eligible = $eligible;
        $this->partials = $partials;
        $this->transaction = $transaction;
        $this->stash = $stash;
        $this->formatter = $formatter;
    }

    public function dashboard(Request $request) {
        try {
            $user = Auth::user();

            $data = ['title' => 'Dashboard', 'business' => $user->business()];

            if($user->type == 'business') {
                return view('dashboard.business.index', $data);
            } else {
                return view('dashboard.investor.index', $data);
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function score(Request $request){
        try {
            $user = Auth::user();

            $businessId = $user->business()->id;
            $score = $this->eligible->where('businessId', $businessId)->first();

//            dd($score);
            if($score) {
                $grade = $this->partials->gradeScore($score->score);
                $data = [
                    'result' => $score,
                    'title' => 'Eligibility score',
                    'grade' => $grade,
                ];

                return view('dashboard.business.score', $data);
            } else {
                \Session::put('info', true);
                return back()->withErrors('Eligibility score not found');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function documents(Request $request){
        try {
            $user = Auth::user();

            $business = $user->business();
            if($business) {
                $user = $this->auth::user();
                $data = [
                    'user' => $user,
                    'guarantors' => $business->guarantors,
                    'documents' => $business->documents,
                    'title' => 'Credit Assessments',
                    'business' => $business,
                    'relationships' => $this->partials->guarantorsRelationhip(),
                    'documentTypes' => $this->partials->documentTypes(),
                    'bvn' => $business->bvn,
                ];

                return view('dashboard.business.document', $data);
            } else {
                abort('404');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function i_dashboard(Request $request) {
        try {
            $user = Auth::user();

            $stash = $this->stash->where('investorId', $user->investor()->id);

            if($stash->first() === null){
                $availableBalance = 0;
            }
            else{
                $availableBalance = $stash->first()->availableAmount;
            }

            $data = [
                'title' => 'Dashboard',
                'investor' => $user->investor(),
                'balance' => $this->formatter->MoneyConvert($availableBalance, 'full')
                ];

            return view('dashboard.investor.index', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function i_dashboard_stash(Request $request) {
        try {
            $user = Auth::user();

            $stash = $this->stash->where('investorId', $user->investor()->id);

            if($stash->first() === null){
                $availableBalance = 0;
            }
            else{
                $availableBalance = $stash->first()->availableAmount;
            }


            $transactions = $this->transaction->where('investorId', $user->investor()->id)->get();

            $creditAmount = 0;
            $debitAmount = 0.00;
            foreach ($transactions as $transaction){
                if ($transaction->type === "credit"){
                    $creditAmount += $transaction->amount;
                } else {
                    $debitAmount += $transaction->amount;
                }
                $transaction->amount = $this->formatter->MoneyConvert($transaction->amount, "full");
                $transaction->date = $this->formatter->dataTime($transaction->created_at);
            }

            $data = [
                'title' => 'Dashboard',
                'investor' => $user->investor(),
                'balance' => $this->formatter->MoneyConvert($availableBalance, 'full'),
                'tranX' => [ "credit" => $this->formatter->MoneyConvert($creditAmount, "full"), "debit" => $this->formatter->MoneyConvert($debitAmount), "full"],
                'transactions' => $transactions
            ];

            return view('dashboard.investor.stash', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
