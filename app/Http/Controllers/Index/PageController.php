<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Helpers\sendMail;
use App\Http\Helpers\Validate;

class PageController extends Controller
{
    //
    private $mail;
    private $validate;
    public function __construct(sendMail $mail, Validate $validate)
    {
        $this->mail = $mail;
        $this->validate = $validate;
    }

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
    //
    public function faq() {

        return view('default.faq');
    }

    public function contactUs(Request $request){
        try{
            $data = $request->except('_token');

            $validation = $this->validate->contact($data, "submit");

            if($validation->fails()) {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            }

            $this->mail->Contact($data);

            \Session::put('success', true);
            return back()->withErrors('Your Message was delivered Successfully');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function signup(Request $request){
        return view('default.signup');
    }
}
