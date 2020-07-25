<?php

namespace App\Http\Controllers\Investment;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Investment;
use App\Models\Stash;
use App\Models\Transaction;
use App\Models\Portfolio;
use App\Models\TranxConfirm;

use App\Http\Helpers\apiHelper;
use App\Http\Helpers\Validate;
use App\Http\Helpers\Formatter;
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
    private $tranx;
    private $format;
    public function __construct(Investment $investment, Validate $validate, Stash $stash, Transaction $transaction, Portfolio $portfolio, apiHelper $api, TranxConfirm $tranx, Formatter $format){
        $this->investment = $investment;
        $this->validate = $validate;
        $this->stash = $stash;
        $this->transaction = $transaction;
        $this->portfolio = $portfolio;
        $this->api = $api;
        $this->tranx = $tranx;
        $this->format = $format;
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

            $getPortfolio = $this->portfolio->where("id", $data["portfolioId"])->first();
            if($getPortfolio->sizeRemaining <= 0){
                \Session::put('danger', true);
                return redirect("/dashboard/i/investments")->withErrors("Sorry, this Portfolio has been sold out, You can purchase units from our other Portfolios")->withInput();
            }
            if ($data["amount"] > $getPortfolio->sizeRemaining){

                $unitsRemaining = $getPortfolio->sizeRemaining / $getPortfolio->amountPerUnit;
                \Session::put('danger', true);
                //return validation error
                return back()->withErrors("Sorry Only ".$unitsRemaining." units of the ".$getPortfolio->name." Portfolio is left. Pay ₦". $this->format->MoneyConvert($getPortfolio->sizeRemaining, 'full')." to acquire it")->withInput();
            }

            if($data["paymentMethod"] == 'bank'){
                \Session::put('type', 'debit');
                \Session::put('portfolioId', $data["portfolioId"]);
                $body = [
                    'amount' => $data["amount"] * 100,
                    'email' => $user->email,
                ];

                $response = $this->api->call('/transaction/initialize', 'POST', $body);

                $data = [
                    "email" => $user->email,
                    "amount" => $data["amount"],
                    "type" => "debit",
                    "portfolioId" => $data["portfolioId"],
                    "reference" => $response->data->reference
                ];
                $this->tranx->create($data);
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
                elseif ($getStash->availableAmount - $data["amount"] < 1000){
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
                    return back()->withErrors("Insufficient funds in your Stash, Your Stash balance cannot be lower than ₦ 1,000")->withInput();
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

                $roiInPer = $getPortfolio['returnInPer'] - $getPortfolio['managementFee'];

                $roi = ($roiInPer / 100) * $data["amount"];

                $invData["roi"] = $roi;
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

    public function getTrnxId($data){

        $transactionId = $this->transaction->create($data)->id;

        return $transactionId;
    }

    public function transfer(Request $request){
        try{
            $user = Auth::user();
            $data = $request->except('_token');

            $investment = $this->investment->where(['userId' => $user->id, 'id' => $data["investmentId"] ]);
            $inv = $investment->first();

            $now = Carbon::now();

            $inv->diff = $now->diffInDays($inv->datePurchased);
            if($inv == null){
                \Session::put('danger', true);
                return back()->withErrors('Something went wrong');
            }
            $stash = $this->stash->where("investorId", $user->investor()->id);

            if ($data["withdrawalOption"] == "int+inv"){
                $amt = (($inv->diff / 365) * $inv->roi) + $inv->amount;

                $stash->increment('totalAmount', $amt);
                $stash->increment('availableAmount', $amt);

                $investment->update(["isOpen" => "false"]);
            }else{
                $amt = (($inv->diff / 365) * $inv->roi);

                $stash->increment('totalAmount', $amt);
                $stash->increment('availableAmount', $amt);

                $investment->update(["datePurchased" => Carbon::now()]);
            }

            \Session::put('success', true);
            return redirect("dashboard/i/stash")->withErrors("You can Now Withdraw From your wallet");

        }catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        try{
            $user = Auth::user();
            $data = $request->except('_token');

            $investment = $this->investment->where(['userId' => $user->id, 'id' => $data["investmentId"] ]);
            $inv = $investment->first();
            if($inv == null){
                \Session::put('danger', true);
                return back()->withErrors('Something went wrong');
            }
            $investment->update(["isCompleted" => true, "period" => $data["months"]]);
            \Session::put('success', true);
            return back()->withErrors("Your Account has been updated");

        }catch(\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function success(){
        \Session::put('success', true);
        return redirect("/dashboard/i/stash")->withErrors("Transfer Initiated, The transaction will be validated in the next 24hours");
    }
    public function danger(){

        \Session::put('danger', true);
        return redirect("/dashboard/i/stash")->withErrors("An Error Occurred");
    }
}
