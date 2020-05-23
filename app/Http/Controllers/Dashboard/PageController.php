<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Bank;
use App\Models\Eligibility;
use App\Models\Stash;
use App\Models\Transaction;
use App\Models\Referral;
use App\Models\lenderAccount;
use App\Models\Portfolio;
use App\Models\Investment;

use App\Http\Helpers\partials;
use App\Http\Helpers\Formatter;

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
    private $referral;
    private $lenderAccount;
    private $bank;
    private $portfolio;
    private $investment;

    public function __construct(Auth $auth, User $user, Eligibility $eligible, partials $partials, Transaction $transaction, Stash $stash, Formatter $formatter, Referral $referral, lenderAccount $lenderAccount, Bank $bank, Portfolio $portfolio, Investment $investment){
        $this->auth = $auth;
        $this->user = $user;
        $this->eligible = $eligible;
        $this->partials = $partials;
        $this->transaction = $transaction;
        $this->stash = $stash;
        $this->formatter = $formatter;
        $this->referral = $referral;
        $this->lenderAccount = $lenderAccount;
        $this->bank = $bank;
        $this->portfolio = $portfolio;
        $this->investment = $investment;
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

//    Investors Dashboard View Functions
    public function i_dashboard(Request $request) {
        try {
            $user = Auth::user();

            $stash = $this->stash->where('investorId', $user->investor()->id);

            $investments = $this->investment->where('userId', $user->id)->get();

            $funds = 0;
            $roi = 0;
            foreach ($investments as $investment) {
                $funds += $investment->amount;
                $roi += $investment->roi;
            }
            if($stash->first() === null){
                $availableBalance = 0;
            }
            else{
                $availableBalance = $stash->first()->availableAmount;
            }
            if($funds == 0 && $availableBalance !== 0){
                $percents["funds"] = 0;
                $percents["stash"] = 100;
            }
            elseif($funds !== 0 && $availableBalance == 0){
                $percents["funds"] = 100;
                $percents["stash"] = 0;
            }
            elseif($funds == 0 && $availableBalance == 0){
                $percents["funds"] = 0;
                $percents["stash"] = 100;
            }
            else{
                $percents["stash"] = ($availableBalance / ($funds+$availableBalance)) * 100;
                $percents["funds"] = ($funds / ($funds+$availableBalance)) * 100;
            }
            $data = [
                'title' => 'Dashboard',
                'investor' => $user->investor(),
                'funds' => $this->formatter->MoneyConvert($funds, 'full'),
                'balance' => $this->formatter->MoneyConvert($availableBalance, 'full'),
                'percents' => $percents,
                'roi' => $this->formatter->MoneyConvert($roi, 'full'),
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

            $l_account = $this->lenderAccount->where('userId', $user->id)->first();

            if($l_account == null){
                \Session::put('warning', true);
                return redirect('/dashboard/i/settings')->withErrors('Your bank detail are needed to credit your wallet');
            }

            $stash = $this->stash->where('investorId', $user->investor()->id);

            if($stash->first() === null){
                $availableBalance = 0;
            }
            else{
                $availableBalance = $stash->first()->availableAmount;
            }


            $transactions = $this->transaction->where('investorId', $user->investor()->id)->paginate(10);

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
                'transactions' => $transactions,
            ];

            return view('dashboard.investor.stash', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function i_dashboard_referral(Request $request) {
        try {
            $user = Auth::user();

            $p = $this->stash->where('investorId', $user->investor()->id)->first();

            $i = $this->investment->where('investorId', $user->investor()->id)->first();

            if($p !== null || $i !== null){
                $payedIn = true;
            }
            else{
                $payedIn = false;
            }

            $referrals = $this->referral->where('refererId', $user->id)->get();

            $signUpReferrals = $referrals->reject(function ($referral){
               return $referral->hasSignUp == false;
            });

            $payedReferrals = $referrals->reject(function ($referral){
                return $referral->hasPayed == false;
            });

            foreach ($payedReferrals as $pf){
                $pf->user = $pf->user();
            }
//            dd($payedReferrals);
            $user->referralLink = env('APP_UR').'r/';
            $data = [
                'title' => 'Dashboard',
                'user' => $user,
                'referrals' => $referrals,
                'signReferral' => $signUpReferrals,
                'payedReferrals' => $payedReferrals,
                'payedIn' => $payedIn
            ];

            return view('dashboard.investor.referral', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function i_dashboard_settings(Request $request) {
        try {
            $user = Auth::user();

            $l_account = $this->lenderAccount->where('userId', $user->id)->first();

            $banks = $this->bank->get();

            $names = explode(" ", $user->name);

            $user->f_name = $names[0];
            $user->l_name = $names[1];

            $data = [
                'title' => 'Dashboard',
                'user' => $user,
                'banks' => $banks,
                'accountDetails' => $l_account,
            ];

            return view('dashboard.investor.settings', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function i_dashboard_investment(Request $request) {
        try {
            $user = Auth::user();
            $portfolios = $this->portfolio->get();

            $investments = $this->investment->where(['userId'=> $user->id, 'isOpen' => "true"])->get();

            foreach ($investments as $investment){
                $investment->transaction = $investment->transaction();
                $investment->portfolio = $investment->portfolio();

                $now = Carbon::now();

                $investment->diff = $now->diffInDays($investment->datePurchased);

                if($investment->diff > 90){
                    $investment->isReady = true;
                }else{
                    $investment->isReady = false;
                }
            }
            $data = [
                'title' => 'Dashboard',
                'user' => $user,
                'portfolios' => $portfolios,
                'investments' => $investments,
            ];

            return view('dashboard.investor.investment', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function i_dashboard_oneInvestment(Request $request, $id) {
        try {
            $user = Auth::user();

            $portfolio = $this->portfolio->where('id', decrypt($id))->first();

            if($portfolio->sizeRemaining == 0){
                \Session::put('danger', true);
                return back()->withErrors('An error has occurred');
            }
            $portfolio->units = $portfolio->size / $portfolio->amountPerUnit;

            $data = [
                'title' => 'Dashboard',
                'user' => $user,
                'portfolio' => $portfolio
            ];

            return view('dashboard.investor.oneInvestment', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

//    End Investors Dashboard view Functions
}
