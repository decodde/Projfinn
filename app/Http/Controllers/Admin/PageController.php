<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Formatter;
use App\Models\Bank;
use App\Models\Investment;
use App\Models\Transaction;
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
    public function __construct(User $user, Bank $bank, Investment $investment, Transaction $transaction, Formatter $formatter, Portfolio $portfolio){
        $this->user = $user;
        $this->bank = $bank;
        $this->investment = $investment;
        $this->transaction = $transaction;
        $this->formatter = $formatter;
        $this->portfolio = $portfolio;
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

            $getInvs = $this->investment->paginate(10);
            foreach ($getInvs as $getInv){
                $getInv->user = $getInv->user();
                $getInv->portfolio = $getInv->portfolio();
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
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
                'portfolios' => $portfolios,
                'transactions' => $transactions
            ];


            return view('admin.transactions', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function portfolios(Request $request) {
        try {
            $user = Auth::user();

            $portfolios = $this->portfolio->paginate(10);

            foreach ($portfolios as $portfolio){
                $portfolio->units = $portfolio->size / $portfolio->amountPerUnit;
                $portfolio->unitsBought = $portfolio->units - ($portfolio->sizeRemaining / $portfolio->amountPerUnit);
            }

            $data = [
                'title' => 'Admin',
                'user' => $user,
                'portfolios' => $portfolios
            ];


            return view('admin.portfolio', $data);

        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
