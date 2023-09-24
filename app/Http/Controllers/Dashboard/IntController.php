<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Http\Helpers\Formatter;
use App\Http\Helpers\partials;

use App\Models\Bank;
use App\Models\introducerAccount;
use App\Models\Invite;
use App\Models\Reserve;
use App\Models\Safe;
use App\Models\Transaction;
use App\Models\transferBRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

class IntController extends Controller{

    private $partials;
    private $auth;
    private $user;
    private $bank;
    private $introducerAccount;
    private $invite;
    private $transaction;
    private $reserve;
    private $safe;
    private $transferRequest;
    private $formatter;

    public function __construct(Auth $auth, User $user, partials $partials, Bank $bank, introducerAccount $introducerAccount, Invite $invite, Transaction $transaction, Reserve $reserve, Safe $safe, transferBRequest $transferRequest, Formatter $formatter)
    {
        $this->partials = $partials;
        $this->auth = $auth;
        $this->user = $user;
        $this->bank = $bank;
        $this->introducerAccount = $introducerAccount;
        $this->invite = $invite;
        $this->reserve = $reserve;
        $this->safe = $safe;
        $this->transaction = $transaction;
        $this->transferRequest = $transferRequest;
        $this->formatter = $formatter;
    }

    public function dashboard(Request $request) {
        try {
            $user = Auth::user();
            $user->introducer = $user->introducer();

            $docs = $user->introducer->documents;
            $account = $user->introducer->account;

            if(count($docs) === 0){
                \Session::put('danger', true);
                return redirect('/dashboard/e/document')->withErrors('Please Provide Your Documents');
            }

            if($account === null){
                \Session::put('danger', true);
                return redirect('/dashboard/e/settings')->withErrors('Please Provide Your Account Details');
            }

            $invites = $this->invite->where(["introducerId" => $user->introducer->id])->paginate(10);
            $invitesAccepted = 0;
            $invitesPending = 0;

            foreach ($invites as $invite){
                if ($invite->hasSignUp == true){
                    $invitesAccepted += 1;
                }else{
                    $invitesPending += 1;
                }
            }
            $data = ['title' => 'Introducer', 'invites' => $invites, 'introducer' => $user->introducer, 'invitesAccepted' => $invitesAccepted, 'invitesPending' => $invitesPending];

            return view('dashboard.introducer.index', $data);
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return redirect('/')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function businesses(Request $request){
        try {
            $user = Auth::user();
            $user->introducer = $user->introducer();

            $docs = $user->introducer->documents;
            $account = $user->introducer->account;

            if(count($docs) === 0){
                \Session::put('danger', true);
                return redirect('/dashboard/e/document')->withErrors('Please Provide Your Documents');
            }

            if($account === null){
                \Session::put('danger', true);
                return redirect('/dashboard/e/settings')->withErrors('Please Provide Your Account Details');
            }

            $invites = $this->invite->where("introducerId", $user->introducer->id)->get();
            $inviteLink = URL('rTD/'.$user->introducer->slug.'/nomail');
            $invitesAccepted = 0;

            foreach ($invites as $invite){
                if ($invite->hasSignUp == true){
                    $invitesAccepted += 1;
                }
            }
            $data = ['title' => 'Introducer', 'invites' => $invites, 'introducer' => $user->introducer, 'inviteCode' => $inviteLink, 'invitesAccepted' => $invitesAccepted];

            return view('dashboard.introducer.businesses', $data);
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return redirect('/')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
    
     public function save(){
        try{
            $user = $this->auth::user();

            $stash = $this->safe->where('userId', $user->id);

            if($stash->first() === null){
                $availableBalance = 0;
                $totalAmount = 0;
            }
            else{
                $availableBalance = $stash->first()->availableAmount;
                $totalAmount = $stash->first()->totalAmount;
            }

            $introducer = $user->introducer();
            if($introducer) {

                $getSav = $this->reserve->where(["email" => $user->email, "isStarted" => true]);

                $getSavings = $getSav->paginate(10);

                $getAllSavings = $getSav->get();

                $cred = 0;

                $totalExpectedLoan = 0;
                $isStash = false;
                foreach ($getSavings as $save){
                    $isStash = true;
                    $save->expectedLoanAmount = 1.5 * ($save->amount * ($save->duration - ($save->durationPassed - $save->durationPaid)));
                    $totalExpectedLoan += $save->expectedLoanAmount;
                }

                foreach ($getSavings as $save){
                    $cred += $save->amount * $save->durationPaid;
                }

                $transactions = $this->transaction->where('userId', $user->id)->latest()->paginate(5);
                $allTransactions = $this->transaction->where('userId', $user->id)->get();

                $isAllowed = true;
                $getTransfers = $this->transferRequest->where(['userId' => $user->id, 'otpConfirmed' => false])->get();
                if (count($getTransfers) > 0){
                    $isAllowed = false;
                }

                $creditAmount = 0;
                $debitAmount = 0.00;
                foreach ($allTransactions as $transaction){
                    if($transaction->status === "success"){
                        if ($transaction->type === "reserve" || $transaction->type === "funding"){
                            $creditAmount += $transaction->amount;
                        } else {
                            $debitAmount += $transaction->amount;
                        }
                    }
                }

                foreach($transactions as $transaction){
                    $transaction->amount = $this->formatter->MoneyConvert($transaction->amount, "full");
                    $transaction->date = $this->formatter->dataTime($transaction->created_at);
                }
                $totalAmount += $cred;
                $data = [
                    'title' => 'Dashboard : Save to Borrow',
                    'user' => $user,
                    'balance' => $this->formatter->MoneyConvert($totalAmount, 'full'),
                    'availableAmt' => $this->formatter->MoneyConvert($availableBalance, 'full'),
                    'tranX' => [ "credit" => $this->formatter->MoneyConvert($creditAmount, "full"), "debit" => $this->formatter->MoneyConvert($debitAmount), "full"],
                    'transactions' => $transactions,
                    'totalExpectedLoan' => $totalExpectedLoan,
                    'savings' => $getSavings,
                    'isStash' => $isStash,
                    'isAllowed' => $isAllowed
                ];

                return view('dashboard.introducer.save', $data);
            } else {
                \Session::put('danger', true);
                return redirect('dashboard')->withErrors('An error has occurred: ');
            }

        }catch (\Exception $e){
            \Session::put('danger', true);
            return redirect('dashboard')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function documents(Request $request){
        try {
            $user = Auth::user();

            $introducer = $user->introducer();

            $docTypes = ['cac'];

            $docs = $introducer->documents;
            if (count($docs) === 0){
                $ListOfDocs = $docTypes;
            }else{
                $castDocs = [];
                $ListOfDocs = [];
                foreach ($docs as $doc){
                    array_push($castDocs, $doc->type);
                }
                foreach ($docTypes as $type){
                    if(!in_array($type, $castDocs)){
                        array_push($ListOfDocs, $type);
                    };
                }
            }
            if($introducer) {
                $data = [
                    'user' => $user,
                    'documents' => $docs,
                    'title' => 'Documents',
                    'introducer' => $introducer,
                    'documentTypes' => $ListOfDocs
                ];

                return view('dashboard.introducer.document', $data);
            } else {
                abort('404');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function settings(Request $request){
        try{
            $user = Auth::user();

            $i_account = $this->introducerAccount->where('userId', $user->id)->first();

            $banks = $this->bank->get();

            $names = explode(" ", $user->name);

            $user->f_name = $names[0];
            $user->l_name = $names[1];

            $data = [
                'title' => 'Dashboard:Settings',
                'user' => $user,
                'banks' => $banks,
                'accountDetails' => $i_account,
            ];

            return view('dashboard.introducer.settings', $data);


        }catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}