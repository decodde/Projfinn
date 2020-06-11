<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Formatter;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Funds;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\transferRequest;
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
    public function __construct(User $user, Bank $bank, Investment $investment, Transaction $transaction, Formatter $formatter, Portfolio $portfolio, Funds $fund, Admin $admin, transferRequest $transferRequest){
        $this->user = $user;
        $this->bank = $bank;
        $this->investment = $investment;
        $this->transaction = $transaction;
        $this->formatter = $formatter;
        $this->portfolio = $portfolio;
        $this->fund = $fund;
        $this->admin = $admin;
        $this->transferRequest = $transferRequest;
    }

    public function index(Request $request){
        try {
            $user = Auth::user();

            $getUsers = $this->user->paginate(10);
            $countPortfolio = count($this->portfolio->get());
            $countUser = count($this->user->get());
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

            $getUsers = $this->user->paginate(10);
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
                'users' => $getUsers
            ];


            return view('admin.user', $data);

        } catch(\Exception $e) {
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
                'portfolios' => $portfolios,
                'transactions' => $transactions
            ];


            return view('admin.transactions', $data);

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

            $data = [
                'title' => 'Admin',
                'isSuper' => $this->isSuper(),
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
            }

            $data = [
                'title' => 'Admin',
                'isSuper' => $this->isSuper(),
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

            $data = [
                'title' => 'Admin',
                'isSuper' => $this->isSuper(),
                'fund' => $getFund
            ];


            return view('admin.fund', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function portfolios(Request $request) {
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
                'portfolios' => $portfolios
            ];


            return view('admin.portfolio', $data);

        } catch(\Exception $e) {
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
}
