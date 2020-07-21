<?php

namespace App\Http\Controllers\Funds;

use App\Http\Controllers\Controller;
use App\Http\Helpers\sendMail;
use App\Http\Helpers\Validate;
use App\Models\Funds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudder as Cloudinary;


class LoadController extends Controller
{
    //
    private $validate;
    private $funds;
    private $mail;
    public function __construct(Validate $validate, Funds $funds, sendMail $mail){
        $this->validate = $validate;
        $this->funds = $funds;
        $this->mail = $mail;
    }

    public function apply(Request $request){
        try{
            $user = Auth::user();
            $data = $request->except('_token');

            $validation = $this->validate->fund($data, "apply");

            if($validation->fails()){
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            }

            if($data["existingLoan"] == 'yes'){
                $isExist = true;
            }
            else{
                $isExist = false;
            }

            if($data["certifyGuarantor"] == 'yes'){
                $isGuarant = true;
            }
            else{
                $isGuarant = false;
            }

            if($data["certifyDocuments"] == 'yes'){
                $isDocs = true;
            }
            else{
                $isDocs = false;
            }

            if($data["address"] == 'yes'){
                $resides = true;
            }
            else{
                $resides = false;
            }

            /*$ext = $request->file('description')->getClientOriginalExtension();
            $extArr = ['pdf', 'docs', 'docx',  'doc', 'jpeg', 'jpg'];

            if(in_array($ext, $extArr)) {
                $file = Cloudinary::upload($request->description)->getResult()['url'];
            }*/

            $params = [
                "userId" => $user->id,
                "businessId" => $user->business()->id,
                "amount" => $data["amount"],
                "address" => $resides,
                "type" => $data["type"],
                "existingLoan" => $isExist,
                "certifyGuarantor" => $isGuarant,
                "certifyDocuments" => $isDocs,
                "description" => $data['description'],
                "progress" => "review"
            ];

            $this->funds->create($params);

            $this->mail->sendToAdmin($params, $user);

            \Session::put('success', true);
            return back()->withErrors("Your Application has been received and is under review, check your dashboard for updates on the application");

        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

}
