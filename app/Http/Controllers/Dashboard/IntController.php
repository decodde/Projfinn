<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Http\Helpers\partials;

use App\Models\Bank;
use App\Models\introducerAccount;
use App\Models\Invite;
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
    public function __construct(Auth $auth, User $user, partials $partials, Bank $bank, introducerAccount $introducerAccount, Invite $invite)
    {
        $this->partials = $partials;
        $this->auth = $auth;
        $this->user = $user;
        $this->bank = $bank;
        $this->introducerAccount = $introducerAccount;
        $this->invite = $invite;
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

            $invites = $this->invite->where("introducerId", $user->introducer->id)->paginate(10);
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
