<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\loanRates;
use App\Models\Saving;
use App\Models\transferRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Bank;
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
    private $partials;
    private $transaction;
    private $stash;
    private $formatter;
    private $referral;
    private $lenderAccount;
    private $bank;
    private $portfolio;
    private $investment;
    private $transferRequest;
    private $saving;
    private $rates;

    public function __construct(Auth $auth, User $user, partials $partials, Transaction $transaction, Stash $stash, Formatter $formatter, Referral $referral, lenderAccount $lenderAccount, Bank $bank, Portfolio $portfolio, Investment $investment, transferRequest $transferRequest, Saving $saving, loanRates $rates){
        $this->auth = $auth;
        $this->user = $user;
        $this->partials = $partials;
        $this->transaction = $transaction;
        $this->stash = $stash;
        $this->formatter = $formatter;
        $this->referral = $referral;
        $this->lenderAccount = $lenderAccount;
        $this->bank = $bank;
        $this->portfolio = $portfolio;
        $this->investment = $investment;
        $this->transferRequest = $transferRequest;
        $this->saving = $saving;
        $this->rates = $rates;
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
                $isStash = false;
                $availableBalance = 0;
            }
            else{
                $availableBalance = $stash->first()->availableAmount;
                $isStash = true;
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
                'isStash' => $isStash
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
                $totalAmount = 0;
                $isStash = false;
            }
            else{
                $availableBalance = $stash->first()->availableAmount;
                $totalAmount = $stash->first()->totalAmount;
                $isStash = true;
            }
            
            $getPortfolios = $this->portfolio->where('isOpen', true)->get();
            
            $purchase = [
                'can' => false,
                'portfolioName' => '',
                'pid' => 0
            ];
            foreach ($getPortfolios as $getPortfolio){
                if ($availableBalance >= $getPortfolio->amountPerUnit){
                    $purchase['can'] = true;
                    $purchase['portfolioName'] = $getPortfolio->name;
                    $purchase['pid'] = $getPortfolio->id;
                }
            }

            $transactions = $this->transaction->where('investorId', $user->investor()->id)->latest()->paginate(5);

            $creditAmount = 0;
            $debitAmount = 0.00;
            foreach ($transactions as $transaction){
                if ($transaction->type === "credit" || $transaction->type === "saving"){
                    $creditAmount += $transaction->amount;
                } else {
                    $debitAmount += $transaction->amount;
                }
                $transaction->amount = $this->formatter->MoneyConvert($transaction->amount, "full");
                $transaction->date = $this->formatter->dataTime($transaction->created_at);
            }

            $transfers = $this->transferRequest->where('investorId', $user->investor()->id)->paginate(5);
            $getTransfers = $this->transferRequest->where(['investorId' => $user->investor()->id, 'otpConfirmed' => false])->get();
            $isAllowed = true;
            if (count($getTransfers) > 0){
                $isAllowed = false;
            }
            $sav = $this->saving->where("email", $user->email)->paginate(5);
            $savings = $this->saving->where(["email" => $user->email, "isStarted" => true])->get();
            $cred = 0;
            foreach ($savings as $saving){

                if ($saving->isCompleted == false){
                    $roi = ($this->partials->interestSavings($saving->months)/100);
                    if ($saving->interval == 'weekly'){
                        $monthsPaid = (($roi * ($saving->months * 4 * $saving->amount))/$saving->months)/4;
                    }
                    elseif ($saving->interval == 'monthly'){
                        $monthsPaid = (($roi * ($saving->months * $saving->amount))/$saving->months);
                    }
                    else{
                        $monthsPaid = (($roi * ($saving->months * 30 * $saving->amount))/$saving->months)/30;
                    }
                    $cred += ($monthsPaid * $saving->monthsPaid) + ($saving->amount * $saving->monthsPaid);
                }
            }
            $totalAmount += $cred;
            $data = [
                'title' => 'Dashboard',
                'investor' => $user->investor(),
                'balance' => $this->formatter->MoneyConvert($totalAmount, 'full'),
                'availableAmt' => $this->formatter->MoneyConvert($availableBalance, 'full'),
                'tranX' => [ "credit" => $this->formatter->MoneyConvert($creditAmount, "full"), "debit" => $this->formatter->MoneyConvert($debitAmount), "full"],
                'transactions' => $transactions,
                'transfers' => $transfers,
                'purchase' => $purchase,
                'savings' => $sav,
                'isStash' => $isStash,
                'isAllowed' => $isAllowed
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

            foreach ($referrals as $pf){
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

                $pdate = Carbon::create($investment->datePurchased);
                $projectedDay = Carbon::create($investment->datePurchased)->addMonths($investment->period);

                $daysS = $pdate->diffInDays($projectedDay);
                $investment->daySS = $daysS;
                $investment->diff = $now->diffInMonths($investment->datePurchased);
                $investment->diffDays = $now->diffInDays($investment->datePurchased);

                if($investment->diff >= $investment->period){
                    $investment->isReady = true;
                    $investment->interstSofar = $investment->roi;
                }else{
                    $investment->isReady = false;
                    $investment->interstSofar = (($investment->diffDays / ($daysS)) * $investment->roi);
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

            if($portfolio->sizeRemaining == 0 || $portfolio->isOpen == false){
                \Session::put('danger', true);
                return back()->withErrors('An error has occurred');
            }
            $getLoanDetail = $this->rates->where("id", $portfolio->id)->first();
            $getLoanDetails = [
                '3' => $getLoanDetail->three,
                '6' => $getLoanDetail->six,
                '9' => $getLoanDetail->nine,
                '12' => $getLoanDetail->twelve,
            ];
            $portfolio->units = $portfolio->size / $portfolio->amountPerUnit;
            $portfolio->unitsLeft = $portfolio->sizeRemaining / $portfolio->amountPerUnit;

            $data = [
                'title' => 'Dashboard',
                'user' => $user,
                'portfolio' => $portfolio,
                'loanOptions' => $getLoanDetails
            ];

            return view('dashboard.investor.oneInvestment', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

//    End Investors Dashboard view Functions
}
