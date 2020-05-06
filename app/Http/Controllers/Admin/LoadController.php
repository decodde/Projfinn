<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Lender;
use App\Models\Portfolio;
use App\Models\Referral;
use App\Models\Stash;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Helpers\Validate;
use App\Http\Helpers\apiHelper;

class LoadController extends Controller
{
    //
    private $user;
    private $api;
    private $transaction;
    private $validate;
    private $stash;
    private $referral;
    private $investor;
    private $portfolio;
    private $investment;
    public function __construct(User $user, apiHelper $api, Validate $validate, Transaction  $transaction, Stash $stash, Referral $referral, Lender $investor, Portfolio $portfolio, Investment $investment){
        $this->user = $user;
        $this->api = $api;
        $this->transaction = $transaction;
        $this->validate = $validate;
        $this->stash = $stash;
        $this->referral = $referral;
        $this->investor = $investor;
        $this->portfolio = $portfolio;
        $this->investment = $investment;
    }

    public function adminConfirm(Request $request){
        try {
            $data = $request->except('_token');

            $validation = $this->validate->transaction($data, "admin");
            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            }

            $user = $this->user->where('email', $data["email"])->first();

            if ($user == null){
                \Session::put('danger', true);
                return back()->withErrors('Email does not exist');
            }

            if ($user->investor() == null){
                \Session::put('danger', true);
                return back()->withErrors('User is not an investor');
            }


            $reference = $data["reference"];

            $trnxData = $this->api->call('/transaction/verify/' . $reference, 'GET')->data;

//            dd($trnxData);
            $amountPaid = $trnxData->amount / 100;

            $params = [
                'reference' => $trnxData->reference,
                'status' => $trnxData->status,
                'message' => $trnxData->message ?? $trnxData->gateway_response,
                'amount' => $amountPaid,
                'investorId' => $user->investor()->id,
                'userId' => $user->id,
                'type' => $data['type']
            ];

            $trnXId = $this->transaction->create($params)->id;

            //credit the Investor's wallet
            if ($data['type'] == 'credit') {
                $stash = $this->stash->where('investorId', $user->investor()->id);

                if ($stash->first() === null) {
                    $stashParams = [
                        'investorId' => $user->investor()->id,
                        'customerId' => $trnxData->customer->customer_code,
                        'totalAmount' => $amountPaid,
                        'availableAmount' => $amountPaid
                    ];
                    $stash->create($stashParams);
                } else {
                    $stash->increment('totalAmount', $amountPaid);
                    $stash->increment('availableAmount', $amountPaid);
                }

                $gr = $this->referral->where(['userId' => $user->id, 'hasPayed' => false]);
                $getRef = $gr->first();

                if ($getRef !== null) {
                    $refId = $this->investor->where('userId', $getRef->refererId)->first();
                    $refStash = $this->stash->where('investorId', $refId->id);
                    $refStash->increment('totalAmount', 2000);
                    $refStash->increment('availableAmount', 2000);
                    $gr->update(['hasPayed' => true]);
                }

                \Session::put('success', true);
                return back()->withErrors('Stash credited successfully');
            } else {
                if ($data['portfolioId'] !== null) {
                    $portfolioId = $data['portfolioId'];
                    $getPortfolio = $this->portfolio->where("id", $portfolioId);

                    $getP = $getPortfolio->first();
                    if ($getP === null) {
                        \Session::put('danger', true);
                        return back()->withErrors('An error has occurred');
                    }

                    $units = $amountPaid / $getP->amountPerUnit;

                    $invData = [
                        'userId' => $user->id,
                        "investorId" => $user->investor()->id,
                        "portfolioId" => $portfolioId,
                        "transactionId" => $trnXId,
                        "unitsBought" => $units,
                        "amount" => $amountPaid,
                        "paymentMethod" => "bank",
                        "datePurchased" => Carbon::now(),
                    ];


                    $roiInPer = $getP['returnInPer'] - $getP['managementFee'];
                    $roi = (($roiInPer / 100) * $amountPaid);

                    $invData["roi"] = $roi;
                    $getPortfolio->decrement('sizeRemaining', $amountPaid);
                    $this->investment->create($invData);

                    \Session::put('success', true);
                    return back()->withErrors("User Investment in '" . $getP->name . "' Recorded Successfully");
                }

                \Session::put('danger', true);
                return back()->withErrors('An error has occurred: ');
            }
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
