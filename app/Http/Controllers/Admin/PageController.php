<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Formatter;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\fundPayment;
use App\Models\Funds;
use App\Models\Introducer;
use App\Models\introducerAccount;
use App\Models\introducerDocument;
use App\Models\Investment;
use App\Models\Invite;
use App\Models\Lender as Investor;
use App\Models\lenderAccount;
use App\Models\busAccount;
use App\Models\Referral;
use App\Models\Stash;
use App\Models\Eligibility;
use App\Http\Helpers\partials;
use App\Models\Transaction;
use App\Models\transferRequest;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

use App\Models\User;
use App\Models\Portfolio;

class PageController extends Controller
{
    //
    private $user;
    private $bank;
    private $investment;
    private $transaction;
    private $formatter;
    private $portfolio;
    private $fund;
    private $admin;
    private $transferRequest;
    private $stash;
    private $investor;
    private $account;
    private $business;
    private $baccount;
    private $eligibility;
    private $partials;
    private $referral;
    private $introducer;
    private $introducerAccount;
    private $introducerDocument;
    private $invite;
    private $payment;
    public function __construct(User $user, Bank $bank, Investment $investment, Transaction $transaction, Formatter $formatter, Portfolio $portfolio, Funds $fund, Admin $admin, transferRequest $transferRequest, Stash $stash, Investor $investor, lenderAccount $account, Business $business, busAccount $baccount, Eligibility $eligibility, partials $partials, Referral $referral, Introducer $introducer, introducerAccount $introducerAccount, introducerDocument $introducerDocument, Invite $invite, fundPayment $payment){
        $this->user = $user;
        $this->bank = $bank;
        $this->investment = $investment;
        $this->transaction = $transaction;
        $this->formatter = $formatter;
        $this->portfolio = $portfolio;
        $this->fund = $fund;
        $this->admin = $admin;
        $this->transferRequest = $transferRequest;
        $this->stash = $stash;
        $this->investor = $investor;
        $this->account = $account;
        $this->business = $business;
        $this->baccount = $baccount;
        $this->eligibility = $eligibility;
        $this->partials = $partials;
        $this->referral = $referral;
        $this->introducer = $introducer;
        $this->introducerDocument = $introducerDocument;
        $this->introducerAccount = $introducerAccount;
        $this->invite = $invite;
        $this->payment = $payment;
    }

    public function searchDashboard(Request $request)
    {
        try {
            switch ($request->target) {
                case 'business':
                    $user = Auth::user();

                    $businesses = $this->business->where(['isDeleted' => false])->where('name', 'LIKE', '%%'.$request->term.'%%')->latest()->paginate(10);
                    foreach ($businesses as $getBusiness){
                        $getBusiness->user = $getBusiness->owner();
                        $getBusiness->account = $getBusiness->account() ?? null;
                        if($getBusiness->account !== null){
                            $getBusiness->bank = $this->bank->where('id', $getBusiness->account->bankId)->first();
                        }
                    }
                    $data = [
                        'title' => 'Search results for '.$request->term,
                        'user' => $user,
                        'isSuper' => $this->isSuper(),
                        'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                        'businesses' => $businesses,
                    ];

                    return view('admin.businesses', $data);
                    break;
                case 'introducer':
                    $user = Auth::user();

                    $introducers = $this->introducer->where('name', 'LIKE', '%%'.$request->term.'%%')->latest()->paginate(10);
                    foreach ($introducers as $getIntroducer){
                        $getIntroducer->user = $getIntroducer->owner;
                        $getIntroducer->account = $getIntroducer->account ?? null;
                        if($getIntroducer->account !== null){
                            $getIntroducer->bank = $this->bank->where('id', $getIntroducer->account->bankId)->first();
                        }
                    }
                    $data = [
                        'title' => 'Search results for '.$request->term,
                        'user' => $user,
                        'isSuper' => $this->isSuper(),
                        'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                        'introducers' => $introducers,
                    ];

                    return view('admin.introducers', $data);
                    break;
                case 'investor':
                    $user = Auth::user();

                    $getInvestors = $this->user->where(["type" => "investor", 'isDeleted' => false])->where('name', 'LIKE', '%%'.$request->term.'%%')->latest()->paginate(10);
                    foreach ($getInvestors as $getUser){
                        $getUser->account = $getUser->account() ?? null;
                        if($getUser->account !== null){
                            $getUser->bank = $this->bank->where('id', $getUser->account->bankId)->first();
                        }
                    }

//                    dd($getInvestors);
                    $data = [
                        'title' => 'Admin',
                        'user' => $user,
                        'isSuper' => $this->isSuper(),
                        'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                        'users' => $getInvestors,
                    ];

                    return view('admin.investors', $data);
                    break;
                default:
                    \Session::put('blue', true);
                    return back()->withErrors("Please specify where to look");
                    break;
            }
        } catch(\Exception $e) {
            \Session::put('red', true);
            return back()->withErrors($e->getMessage());
        }
    }

    public function index(Request $request){
        try {
            $user = Auth::user();

            $getUsers = $this->user->where("isDeleted", false)->paginate(10);
            $countPortfolio = count($this->portfolio->get());
            $countUser = count($this->user->where("isDeleted", false)->get());
            $countInvestments = count($this->investment->get());

            foreach ($getUsers as $getUser){
                $getUser->account = $getUser->account() ?? null;
                if($getUser->account !== null){
                    $getUser->bank = $this->bank->where('id', $getUser->account->bankId)->first();
                }
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'users' => $getUsers,
                'NoOfPortfolios' => $countPortfolio,
                'NoOfUser' => $countUser,
                'NoOfInvestments' => $countInvestments
            ];


            return view('admin.index', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function user(Request $request) {
        try {
            $user = Auth::user();

            $getUsers = $this->user->where("isDeleted", false)->paginate(10);
            foreach ($getUsers as $getUser){
                $getUser->account = $getUser->account() ?? null;
                if($getUser->account !== null){
                    $getUser->bank = $this->bank->where('id', $getUser->account->bankId)->first();
                }
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'users' => $getUsers
            ];


            return view('admin.user', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function investors(Request $request){
        try{
            $user = Auth::user();

            $getInvestors = $this->user->where(["type" => "investor", 'isDeleted' => false])->paginate(10);
            foreach ($getInvestors as $getUser){
                $getUser->account = $getUser->account() ?? null;
                if($getUser->account !== null){
                    $getUser->bank = $this->bank->where('id', $getUser->account->bankId)->first();
                }
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'users' => $getInvestors,
            ];


            return view('admin.investors', $data);
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function investor(Request $request){
        try{
            $id = decrypt($request->id);
            $user = Auth::user();


            $getUser = $this->user->where(["id" => $id, "type" => "investor", 'isDeleted' => false])->first();

            $getInvestor = $this->investor->where("userId", $getUser->id)->first();

            $getStash = $this->stash->where("investorId", $getInvestor->id)->first();

            $getAccount = $this->account->where("userId", $getUser->id)->first();

            $getAccount->bank = $getAccount->bank();

            $getTransaction = $this->transaction->where("userId", $getUser->id)->get();

            $getInvestments = $this->investment->where("userId", $getUser->id)->paginate(10);

            foreach($getInvestments as $getInvestment){
                $getInvestment->date = $this->formatter->dataTime($getInvestment->datePurchased);
                $getInvestment->portfolio = $getInvestment->portfolio();
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'gUser' => $getUser,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'stash' => $getStash,
                'investor' => $getInvestor,
                'account' => $getAccount,
                'transactions' => $getTransaction,
                'investments' => $getInvestments
            ];


            return view('admin.investor', $data);
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function business(Request $request){
        try{
            $id = decrypt($request->id);
            $user = Auth::user();

            $getUser = $this->user->where(["id" => $id, "type" => "business", 'isDeleted' => false])->first();

            $getBusiness = $this->business->where("userId", $getUser->id)->first();

            $getBusiness->bvn = $getBusiness->bvn;

            $eligibility = $this->eligibility->where("businessId", $getBusiness->id)->first();

            $getFunds = $this->fund->where(["userId" => $getUser->id, "businessId" => $getBusiness->id])->paginate(10);

            $grade = $this->partials->gradeScore($eligibility->score);

            $getAccount = $this->baccount->where("userId", $getUser->id)->first();

            $getAccount->bank = $getAccount->bank();

            $getTransaction = $this->transaction->where("userId", $getUser->id)->get();

            $documents = $getBusiness->documents;

            $data = [
                "title" => 'Admin',
                "user" => $user,
                "gUser" => $getUser,
                "isSuper" => $this->isSuper(),
                "funds" => $getFunds,
                "account" => $getAccount,
                "business" => $getBusiness,
                "eligibility" => $eligibility,
                "grade" => $grade,
                'transactions' => $getTransaction,
                'documents' => $documents
            ];


            return view('admin.business', $data);
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function businesses(Request $request){
        try{
            $user = Auth::user();

            $getBusinesses = $this->business->where(['isDeleted' => false])->paginate(10);
            foreach ($getBusinesses as $getBusiness){
                $getBusiness->user = $getBusiness->owner();
                $getBusiness->account = $getBusiness->account() ?? null;
                if($getBusiness->account !== null){
                    $getBusiness->bank = $this->bank->where('id', $getBusiness->account->bankId)->first();
                }
            }
            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'businesses' => $getBusinesses,
            ];


            return view('admin.businesses', $data);
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function introducer(Request $request){
        try{
            $id = decrypt($request->id);
            $user = Auth::user();

            $getUser = $this->user->where(["id" => $id, "type" => "introducer", 'isDeleted' => false])->first();

            $getIntroducer = $this->introducer->where("userId", $getUser->id)->first();

            $getInvites = $this->invite->where(["introducerId" => $getIntroducer->id, "hasSignUp" => true])->get();

            $businesses = [];
            foreach ($getInvites as $invite){
                $bus = $this->business->where("email", $invite->email)->first();
                $bus->user = $bus->owner();
                array_push($businesses, $bus);
            }

            $getAccount = $this->introducerAccount->where("userId", $getUser->id)->first();

            $getAccount->bank = $getAccount->bank();

            $documents = $getIntroducer->documents;

            $data = [
                "title" => 'Admin',
                "user" => $user,
                "gUser" => $getUser,
                "isSuper" => $this->isSuper(),
                "account" => $getAccount,
                "introducer" => $getIntroducer,
                'documents' => $documents,
                'businesses' => $businesses,
            ];


            return view('admin.introducer', $data);
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function introducers(Request $request){
        try{
            $user = Auth::user();

            $getIntroducers = $this->introducer->paginate(10);
            foreach ($getIntroducers as $getIntroducer){
                $getIntroducer->user = $getIntroducer->owner;
                $getIntroducer->account = $getIntroducer->account ?? null;
                if($getIntroducer->account !== null){
                    $getIntroducer->bank = $this->bank->where('id', $getIntroducer->account->bankId)->first();
                }
            }
            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'introducers' => $getIntroducers,
            ];


            return view('admin.introducers', $data);
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function investments(Request $request) {
        try {
            $user = Auth::user();

            if (!$this->isSuper()){
                \Session::put('danger', true);
                return redirect("/admin/rouzz/overview")->withErrors("You are not allowed here");
            }
            $getInvs = $this->investment->paginate(10);
            foreach ($getInvs as $getInv){
                $getInv->user = $getInv->user();
                $getInv->portfolio = $getInv->portfolio();
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'investments' => $getInvs
            ];


            return view('admin.investment', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function transactions(Request $request) {
        try {
            $user = Auth::user();
            if (!$this->isSuper()){
                \Session::put('danger', true);
                return redirect("/admin/rouzz/overview")->withErrors("You are not allowed here");
            }
            $transactions = $this->transaction->paginate(10);
            $portfolios = $this->portfolio->get();

            $creditAmount = 0;
            $debitAmount = 0.00;
            foreach ($transactions as $transaction){
                $transaction->user = $transaction->user();
                if ($transaction->type === "credit"){
                    $creditAmount += $transaction->amount;
                } else {
                    $debitAmount += $transaction->amount;
                }
                $transaction->amount = $this->formatter->MoneyConvert($transaction->amount, "full");
                $transaction->date = $this->formatter->dataTime($transaction->created_at);
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'portfolios' => $portfolios,
                'transactions' => $transactions
            ];


            return view('admin.transactions', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function payOut(Request $request) {
        try {
            $user = Auth::user();
            if (!$this->isSuper()){
                \Session::put('danger', true);
                return redirect("/admin/rouzz/overview")->withErrors("You are not allowed here");
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
            ];


            return view('admin.payout', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function funds(Request $request) {
        try {
            $getFunds = $this->fund->paginate(10);

            foreach ($getFunds as $getFund){
                $getFund->user = $getFund->user();
                $getFund->business = $getFund->business();
            }
//            dd($getFunds);
            $data = [
                'title' => 'Admin',
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'funds' => $getFunds
            ];


            return view('admin.funds', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function transfers(Request $request) {
        try {
            $getTransfers = $this->transferRequest->where('otpConfirmed', false)->paginate(10);

            foreach ($getTransfers as $getTransfer){
                $getTransfer->investor = $getTransfer->investor();
                $getTransfer->user = $getTransfer->user($getTransfer->investor->userId);
                $getTransfer->account = $this->account->where('userId', $getTransfer->user->id)->first();
                $getTransfer->bank = $getTransfer->account->bank();
            }

            $data = [
                'title' => 'Admin',
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'transfers' => $getTransfers
            ];


            return view('admin.validateTransfer', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function bvnValidate(Request $request) {
        try {
            $params = $request->except("_token");

            $data = [
                'title' => 'Admin',
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'bvn' => $params["bvn"] ?? '',
                'first_name' => $params["first_name"] ?? '',
                'last_name' => $params["last_name"] ?? '',
            ];


            return view('admin.validateBVN', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function fund(Request $request){
        try {
            $id = decrypt($request->id);
            $getFund = $this->fund->where("id", $id)->first();

            if($getFund === null){
                \Session::put('danger', true);
                return back()->withErrors('An error has occurred');
            }
            $getFund->user = $getFund->user();
            $getFund->business = $getFund->business();
            $getFund->documents = $getFund->documents();
            $getFund->guarantors = $getFund->guarantors();
            if($getFund->progress == 'approved'){
                $getFund->payment = $this->payment->where("fundId", $getFund->id)->first();
            }
            $data = [
                'title' => 'Admin',
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'fund' => $getFund
            ];


            return view('admin.fund', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function portfolio(Request $request) {
        try {
            $id = decrypt($request->id);
            $user = Auth::user();
            if (!$this->isSuper()){
                \Session::put('danger', true);
                return redirect("/admin/rouzz/overview")->withErrors("You are not allowed here");
            }
            $portfolio = $this->portfolio->where("id", $id)->first();
            $portfolio->units = $portfolio->size / $portfolio->amountPerUnit;
            $portfolio->unitsBought = $portfolio->units - ($portfolio->sizeRemaining / $portfolio->amountPerUnit);

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'portfolio' => $portfolio
            ];


            return view('admin.onePortfolio', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function portfolios(Request $request){
        try {

            $user = Auth::user();
            if (!$this->isSuper()){
                \Session::put('danger', true);
                return redirect("/admin/rouzz/overview")->withErrors("You are not allowed here");
            }
            $portfolios = $this->portfolio->paginate(10);

            foreach ($portfolios as $portfolio){
                $portfolio->units = $portfolio->size / $portfolio->amountPerUnit;
                $portfolio->unitsBought = $portfolio->units - ($portfolio->sizeRemaining / $portfolio->amountPerUnit);
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'portfolios' => $portfolios
            ];

            return view('admin.portfolio', $data);
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function referrals(Request $request){
        try{
            $user = Auth::user();

            $getReferrals = $this->referral->paginate(10);

            foreach ($getReferrals as $referral){
                $referral->referrer = $referral->referrer();
                $referral->user = $referral->user();
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'isSuper' => $this->isSuper(),
                'isIntroducerAdmin' => $this->isIntroducerAdmin(),
                'referrals' => $getReferrals,
            ];

            return view('admin.referrals', $data);
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function isSuper(){
        $user = Auth::user();
        $getRole = $this->admin->where('userId', $user->id)->first();

        if($getRole->role == "super-admin"){
            return true;
        }
        else{
            return false;
        }
    }

    public function isIntroducerAdmin(){
        $user = Auth::user();
        $getRole = $this->admin->where('userId', $user->id)->first();

        if($getRole->role == "introducer-admin"){
            return true;
        }
        else{
            return false;
        }
    }
}
