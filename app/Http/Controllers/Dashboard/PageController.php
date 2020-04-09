<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use App\Models\User;

class PageController extends Controller
{
    //
    private $auth;
    private $user;
    public function _construct(Auth $auth, User $user){
        $this->auth = $auth;
        $this->user = $user;
    }

    public function dashboard(Request $request) {
        try {
            $user = Auth::user();

            $data = ['title' => 'Dashboard', 'business' => $user->business() ?? null, 'investor' => $user->investor() ?? null];

            if($user->type == 'business') {
                return view('dashboard.business.index', $data);
            } else {
                return view('dashboard.investor.index', $data);
            }
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
}
