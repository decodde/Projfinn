<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Http\Helpers\Formatter;
use App\Http\Helpers\partials;
use App\Models\BVN;
use App\Models\Document;
use App\Models\Eligibility;

use App\Models\fundPayment;
use App\Models\Funds;
use App\Models\Guarantor;
use App\Models\Reserve;
use App\Models\Safe;
use App\Models\Transaction;
use App\Models\transferBRequest;
use App\Models\User;
use App\Models\busAccount;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

class BusController extends Controller{

    private $eligible;
    private $partials;
    private $auth;
    private $user;
    private $funds;
    private $document;
    private $bvn;
    private $transaction;
    private $formatter;
    private $guarantor;
    private $busAccount;
    private $bank;
    private $payment;
    private $reserve;
    private $safe;
    private $transferRequest;

    public function __construct(Auth $auth, User $user, Eligibility $eligible, partials $partials, Funds $funds, Document $document, BVN  $bvn, Transaction $transaction,  Formatter $formatter, Guarantor $guarantor, busAccount $busAccount, Bank $bank, fundPayment $payment, Reserve $reserve, Safe $safe, transferBRequest $transferRequest)
    {
        $this->eligible = $eligible;
        $this->partials = $partials;
        $this->auth = $auth;
        $this->user = $user;
        $this->funds = $funds;
        $this->document = $document;
        $this->bvn = $bvn;
        $this->transaction = $transaction;
        $this->formatter = $formatter;
        $this->guarantor = $guarantor;
        $this->busAccount = $busAccount;
        $this->bank = $bank;
        $this->payment = $payment;
        $this->reserve = $reserve;
        $this->safe = $safe;
        $this->transferRequest = $transferRequest;
    }

    public function dashboard(Request $request) {
        try {
            $user = Auth::user();

            $businessId = $user->business()->id;
            $score = $this->eligible->where('businessId', $businessId)->first();

            $grade = $this->partials->gradeScore($score->score);

            $transactions = $this->transaction->where("userId", $user->id)->paginate(10);
            foreach ($transactions as $transaction){
                $transaction->amount = $this->formatter->MoneyConvert($transaction->amount, "full");
                $transaction->date = $this->formatter->dataTime($transaction->created_at);
            }
            $data = ['title' => 'Dashboard', 'business' => $user->business(), 'transactions' => $transactions, 'grade' => $grade,];


            return view('dashboard.business.index', $data);
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

            $docTypes = $this->partials->documentTypes();

            $docs = $business->documents;
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
            if($business) {
                $user = $this->auth::user();
                $data = [
                    'user' => $user,
                    'guarantors' => $business->guarantors,
                    'documents' => $docs,
                    'title' => 'Credit Assessments',
                    'business' => $business,
                    'relationships' => $this->partials->guarantorsRelationhip(),
                    'documentTypes' => $ListOfDocs,
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

    public function funds(Request $request){
        try {
            $user = Auth::user();

            $hasDocs = $this->checkDocuments($user);

            $busAccount = $this->busAccount->where("userId", $user->id)->first();

            if (!$hasDocs){
                \Session::put('danger', true);
                return redirect("/dashboard/document")->withErrors('Provide your Bvn, Guarantors and Upload Your Documents before applying for Funds');
            }

            if ($busAccount === null){
                \Session::put('danger', true);
                return redirect("/dashboard/settings")->withErrors('Provide your Banks Details before applying for Funds');
            }
            $funds = $this->funds->where('businessId', $user->business()->id)->paginate(10);

            $business = $user->business();
            if($business) {
                $user = $this->auth::user();
                $data = [
                    'title' => 'Dashboard : Funds',
                    'user' => $user,
                    'funds' => $funds
                ];

                return view('dashboard.business.funds', $data);
            } else {
                \Session::put('danger', true);
                return back()->withErrors('An error has occurred: ');
            }
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function funds_one(Request $request, $id){
        try{
            $user = Auth::user();
            $hasDocs = $this->checkDocuments($user);

            $busAccount = $this->busAccount->where("userId", $user->id)->first();

            if (!$hasDocs){
                \Session::put('danger', true);
                return redirect("/dashboard/document")->withErrors('Provide your Bvn, Guarantors and Upload Your Documents before applying for Funds');
            }

            if ($busAccount === null){
                \Session::put('danger', true);
                return redirect("/dashboard/settings")->withErrors('Provide your Banks Details before applying for Funds');
            }
            $fund = $this->funds->where(['businessId' => $user->business()->id, 'id' => decrypt($id)])->first();

            if($fund->progress == 'approved'){
                $fund->payment = $this->payment->where("fundId", $fund->id)->first();
            }
            $data = [
                'title' => 'Dashboard : Fund',
                'fund' => $fund
            ];
            return view('dashboard.business.fund', $data);
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function settings(Request $request){
        try{
            $user = Auth::user();

            $b_account = $this->busAccount->where('userId', $user->id)->first();

            $banks = $this->bank->get();

            $names = explode(" ", $user->name);

            $user->f_name = $names[0];
            $user->l_name = $names[1];

            $data = [
                'title' => 'Dashboard:Settings',
                'user' => $user,
                'banks' => $banks,
                'accountDetails' => $b_account,
            ];

            return view('dashboard.business.settings', $data);


        }catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
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

            $business = $user->business();
            if($business) {

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

                $transactions = $this->transaction->where('businessId', $user->business()->id)->latest()->paginate(5);
                $allTransactions = $this->transaction->where('businessId', $user->business()->id)->get();

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

                return view('dashboard.business.save', $data);
            } else {
                \Session::put('danger', true);
                return redirect('dashboard')->withErrors('An error has occurred: ');
            }

        }catch (\Exception $e){
            \Session::put('danger', true);
            return redirect('dashboard')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function checkDocuments($user)
    {
        $document = $this->document->where("businessId", $user->business()->id)->get();

        $guarantor = $this->guarantor->where("businessId", $user->business()->id)->get();

        $bvn = $this->bvn->where("businessId", $user->business()->id)->first();

        if(count($document) === 3 && count($guarantor) === 1  && $bvn !== null){
            return true;
        }else{
            return false;
        }
    }

}
