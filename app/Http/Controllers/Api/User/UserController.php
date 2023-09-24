<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $stash;
    private $auth;

    
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function profile(Request $request){
        
    }

    public function balance(){
        $user = Auth::user();


    }
}
