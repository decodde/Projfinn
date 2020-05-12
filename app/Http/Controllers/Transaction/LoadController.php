<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Models\Transaction;
use App\Models\Stash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\Lender;
use App\Models\Portfolio;
use App\Models\Investment;
use App\Models\TranxConfirm;

class LoadController extends Controller
{

    private $api;
    private $transaction;
    private $stash;
    private $referral;
    private $investor;
    private $portfolio;
    private $investment;
    private $tranx;

    public function __construct(apiHelper $api, Transaction $transaction, Stash $stash, Referral $referral, Lender $investor, Portfolio $portfolio, Investment $investment, TranxConfirm $tranx){
        $this->api = $api;
        $this->transaction = $transaction;
        $this->stash = $stash;
        $this->portfolio = $portfolio;
        $this->referral = $referral;
        $this->investor = $investor;
        $this->investment = $investment;
        $this->tranx = $tranx;
    }

    public function buy(Request $request){
        try{
            $body = [
                'amount' => $request->amount * 100,
                'email' => $request->email
            ];

            $response = $this->api->call('/transaction/initialize', 'POST', $body);

            $data = [
                "email" => $request->email,
                "amount" => $request->amount,
                "type" => "credit",
                "reference" => $response->data->reference
            ];
            $this->tranx->create($data);
            return redirect($response->data->authorization_url);
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return redirect('dashboard/i')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function confirm(Request $request) {
        try {
            $reference = $request->reference;

            $trnxData = $this->api->call('/transaction/verify/'.$reference, 'GET')->data;

            $amountPaid = $trnxData->amount / 100;

            $user = \Auth::user();
            $tranxDetail = $this->tranx->where(['reference' => $reference, 'isCompleted' => false, 'email' => $user->email]);
            $tranxDetails = $tranxDetail->first();
            if($tranxDetails == null){
                \Session::put('danger', true);
                return redirect('dashboard/i')->withErrors('Something went Wrong');
            }

            $trnxType = $tranxDetails->type;


            $params = [
                'reference' => $trnxData->reference,
                'status' => $trnxData->status,
                'message' => $trnxData->message ?? $trnxData->gateway_response,
                'amount' => $amountPaid,
                'investorId' => $user->investor()->id,
                'userId' => $user->id,
                'type' => $trnxType
            ];

            $trnXId = $this->transaction->create($params)->id;

            //credit the Investor's wallet
            if ( $trnxType == 'credit') {
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
                $tranxDetail->update([
                    "isCompleted" => true
                ]);
                \Session::put('success', true);
                return redirect('dashboard/i/stash')->withErrors('Stash credited successfully');
            }
            else{
                if ($tranxDetails->portfolioId !== null){
                    $portfolioId = $tranxDetails->portfolioId;
                    $getPortfolio = $this->portfolio->where("id", $portfolioId);

                    $getP = $getPortfolio->first();
                    if($getP === null){
                        \Session::put('danger', true);
                        return redirect('dashboard/i')->withErrors('An error has occurred');
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
                    $tranxDetail->update([
                        "isCompleted" => true
                    ]);
                    \Session::put('success', true);
                    return redirect('dashboard/i/investments')->withErrors("You have successfully invested into '". $getP->name."'");
                }

                \Session::put('danger', true);
                return redirect('dashboard/i')->withErrors('An error has occurred: ');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return redirect('dashboard/i')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
