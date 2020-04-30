<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\lenderAccount;
use App\Models\User;
use App\Models\Bank;

use App\Http\Helpers\Validate;
use App\Http\Helpers\apiHelper;

class LoadController extends Controller
{
    //
    private $lenderAccount;
    private $user;
    private $validate;
    private $api;
    private $bank;


    public function __construct(User $user, lenderAccount $lenderAccount, Validate $validate, apiHelper $api, Bank $bank){
         $this->lenderAccount = $lenderAccount;
         $this->user = $user;
         $this->validate = $validate;
         $this->api = $api;
         $this->bank = $bank;
    }

    public function editUser(Request $request){
        try{
            $data = $request->except('_token');

            $validation = $this->validate->account($data, "edit");

            if($validation->fails()){
                \Session::put('warning', true);
                return back()->withErrors($validation->getMessageBag())->withInput();
            }

            $getUser = $this->user->where('id', $data["userId"]);

            if($getUser->first() === null){
                \Session::put('danger', true);
                return back()->withErrors('An error has occurred:');
            }

            $name = $data["f_name"]." ".$data["l_name"];

            $getUser->update(['name' => $name]);

            \Session::put('success', true);
            return back()->withErrors('Profile Updated Successfully');
        }catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function createDetails(Request $request){
        try{
            $data = $request->except('_token');

            $validation = $this->validate->account($data, null);

            if($validation->fails()){
                \Session::put('warning', true);
                return back()->withErrors($validation->getMessageBag())->withInput();
            }

            $bank = $this->bank->where('id', $data['bankId'])->first();

            if($bank === null){
                \Session::put('danger', true);
                return back()->withErrors('An error has occurred');
            }

            $user = \Auth::user();

            $name = explode(" ", $user->name);

            $body = [
                'account_number' => $data['accountNumber'],
                'bank_code' => $bank->code,
                'bvn' => $data['bvn'],
                'first_name' => $name[0],
                'last_name' => $name[1]
            ];

//            dd("Heyyy");
            $is_verified = $this->verifyACC($body);

            if($is_verified === true){
                $this->lenderAccount->create($data);
            }
            else{
                \Session::put('danger', true);
                return back()->withErrors('Incorrect Account Details');
            }

            \Session::put('success', true);
            return back()->withErrors('Account Details Verified');
        }catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function updateDetails(Request $request){
        try{
            $data = $request->except('_token');

            $validation = $this->validate->account($data, "updateDetails");

            if($validation->fails()){
                \Session::put('warning', true);
                return back()->withErrors($validation->getMessageBag())->withInput();
            }

            $bank = $this->bank->where('id', $data['bankId'])->first();

            if($bank === null){
                \Session::put('danger', true);
                return back()->withErrors('An error has occurred');
            }

            $user = \Auth::user();

            $name = explode(" ", $user->name);

            $body = [
                'account_number' => $data['accountNumber'],
                'bank_code' => $bank->code,
                'bvn' => $data['bvn'],
                'first_name' => $name[0],
                'last_name' => $name[1]
            ];

            $is_verified = $this->verifyACC($body);

            if($is_verified === true){
                $lac = $this->lenderAccount->where('id', decrypt($data["dd"]));

                if($lac->first() !== null){
                    $lac->update([
                        "userId" => $data["userId"],
                        "bankId" => $data["bankId"],
                        "bvn" => $data["bvn"],
                        "accountNumber" => $data["accountNumber"]
                    ]);
                }
            }
            else{
                \Session::put('danger', true);
                return back()->withErrors('Incorrect Account Details');
            }

            \Session::put('success', true);
            return back()->withErrors('Account Details Verified');
        }catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    private function verifyACC($data){
        try{
//            dd("Hey");
            $nubanMatch = $this->api->call('/bank/resolve?account_number='.$data['account_number'].'&bank_code='.$data['bank_code'], 'GET');

//            dd($nubanMatch);

            if (!$nubanMatch->status){
                return false;
            }

            if(strpos($nubanMatch->data->account_name, $data['first_name']) == false && strpos($nubanMatch->data->account_name, $data['last_name']) == false && $nubanMatch->data->account_number !== $data["account_number"]){
                return false;
            }
            $bvnMatch = $this->api->call('/bank/resolve_bvn/'.$data['bvn'], 'GET');

//            dd($bvnMatch);
            if(!$bvnMatch->status){
                return false;
            }

            if ($bvnMatch->data->first_name !== strtoupper($data["first_name"]) && $bvnMatch->data->last_name !== strtoupper($data["last_name"]) && $bvnMatch->data->bvn !== $data["bvn"]){
                return false;
            }



                return true;
        }catch (\Exception $e){
            dd($e->getMessage());
        }
        return false;
    }
}