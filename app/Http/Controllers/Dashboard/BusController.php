<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Http\Helpers\Formatter;
use App\Http\Helpers\partials;
use App\Models\BVN;
use App\Models\Document;
use App\Models\Eligibility;

use App\Models\Funds;
use App\Models\Guarantor;
use App\Models\Transaction;
use App\Models\User;
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
    public function __construct(Auth $auth, User $user, Eligibility $eligible, partials $partials, Funds $funds, Document $document, BVN  $bvn, Transaction $transaction,  Formatter $formatter, Guarantor $guarantor)
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

            if (!$hasDocs){
                \Session::put('danger', true);
                return redirect("/dashboard/document")->withErrors('Provide your Bvn, Guarantors and Upload Your Documents before applying for Funds');
            }
            $funds = $this->funds->where('businessId', $user->business()->id)->paginate(10);

            $business = $user->business();
            if($business) {
                $user = $this->auth::user();
                $data = [
                    'user' => $user,
                    'funds' => $funds
                ];

                return view('dashboard.business.funds', $data);
            } else {
                abort('404');
            }
        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function settings(Request $request){
        try{
            $user = Auth::user();

            $names = explode(" ", $user->name);

            $user->f_name = $names[0];
            $user->l_name = $names[1];

            $data = [
                'title' => 'Dashboard:Settings',
                'user' => $user,
            ];

            return view('dashboard.business.settings', $data);


        }catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
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
