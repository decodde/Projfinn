<?php

namespace App\Http\Controllers\Investment;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Investment;
use App\Models\Stash;
use App\Models\Transaction;
use App\Models\Portfolio;
use App\Http\Helpers\apiHelper;

use App\Http\Helpers\Validate;
use Illuminate\Support\Facades\Auth;

class LoadController extends Controller
{
    //
    private $investment;
    private $validate;
    private $stash;
    private $transaction;
    private $portfolio;
    private $api;
    public function __construct(Investment $investment, Validate $validate, Stash $stash, Transaction $transaction, Portfolio $portfolio, apiHelper $api){
        $this->investment = $investment;
        $this->validate = $validate;
        $this->stash = $stash;
        $this->transaction = $transaction;
        $this->portfolio = $portfolio;
        $this->api = $api;
    }

    public function create(Request $request){
        try{
            $user = Auth::user();
//            dd($request->all());
            $data = $request->except('_token');

            $validation = $this->validate->investment($data, 'create');


            if($validation->fails()){
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            }


            if($data["paymentMethod"] == 'bank'){
                \Session::put('type', 'debit');
                \Session::put('portfolioId', $data["portfolioId"]);
                $body = [
                    'amount' => $data["amount"] * 100,
                    'email' => $user->email,
                ];

                $response = $this->api->call('/transaction/initialize', 'POST', $body);

                return redirect($response->data->authorization_url);
            }
            else{
                $stash = $this->stash->where('investorId', $user->investor()->id);

                $getStash = $stash->first();

                if($getStash == null){
                    $trnxData = [
                        'reference' => str_random(10),
                        'status' => "failure",
                        'message' => "Insufficient Funds",
                        'amount' => $data["amount"],
                        'investorId' => $user->investor()->id,
                        'userId' => $user->id,
                        'type' => "debit"
                    ];

                    $this->getTrnxId($trnxData);
                    \Session::put('danger', true);
                    return back()->withErrors("Insufficient funds in your stash")->withInput();
                }

                if($getStash->availableAmount < $data["amount"]){
                    $trnxData = [
                        'reference' => str_random(10),
                        'status' => "failure",
                        'message' => "Insufficient Funds",
                        'amount' => $data["amount"],
                        'investorId' => $user->investor()->id,
                        'userId' => $user->id,
                        'type' => "debit"
                    ];

                    $this->getTrnxId($trnxData);
                    \Session::put('danger', true);
                    return back()->withErrors("Insufficient funds in your Stash")->withInput();
                }
                elseif ($getStash->availableAmount - $data["amount"] < 5000){
                    $trnxData = [
                        'reference' => str_random(10),
                        'status' => "failure",
                        'message' => "Insufficient Funds",
                        'amount' => $data["amount"],
                        'investorId' => $user->investor()->id,
                        'userId' => $user->id,
                        'type' => "debit"
                    ];

                    $this->getTrnxId($trnxData);
                    \Session::put('danger', true);
                    return back()->withErrors("Insufficient funds in your Stash, Your Stash balance cannot be lower than ₦ 5,000")->withInput();
                }

                $trnxData = [
                    'reference' => str_random(10),
                    'status' => "success",
                    'message' => "Successful",
                    'amount' => $data["amount"],
                    'investorId' => $user->investor()->id,
                    'userId' => $user->id,
                    'type' => "debit"
                ];

                $transactionId = $this->getTrnxId($trnxData);

                $stash->decrement('totalAmount', $data["amount"]);
                $stash->decrement('availableAmount', $data["amount"]);

                $invData = [
                    'userId' => $user->id,
                    "investorId" => $user->investor()->id,
                    "portfolioId" => $data["portfolioId"],
                    "transactionId" => $transactionId,
                    "unitsBought" => $data["unitsBought"],
                    "amount" => $data["amount"],
                    "paymentMethod" => "stash",
                    "datePurchased" => Carbon::now(),
                ];

                $portfolio = $this->portfolio->where("id", $data["portfolioId"]);

                $getPortfolio = $portfolio->first();

                if($getPortfolio === null){
                    \Session::put('danger', true);
                    return back()->withErrors('An error has occurred: ');
                }

                $portfolio->decrement('sizeRemaining', $data["amount"]);
                $this->investment->create($invData);
            }

            \Session::put('success', true);
            return redirect('dashboard/i/investments')->withErrors("You have successfully invested into '". $data["portfolioName"]."'");
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

//    public function payWithBank($data, $user){
//        try{
////            dd("Peoplw");
//            \Session::put('type', 'debit');
//                $body = [
//                    'amount' => $data["amount"] * 100,
//                    'email' => $user->email,
//                ];
//
//                $response = $this->api->call('/transaction/initialize', 'POST', $body);
//
//                redirect($response->data->authorization_url);
//            }
//        catch (\Exception $e){
//            \Session::put('danger', true);
//            redirect('dashboard/i')->withErrors('An error has occurred: '.$e->getMessage());
//        }
//    }

    public function getTrnxId($data){

        $transactionId = $this->transaction->create($data)->id;

        return $transactionId;
    }
}
