<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index() {

        return view('default.index');
    }
    //
    public function about() {

        return view('default.about');
    }
    //
    public function contact() {

        return view('default.contact');
    }
}
