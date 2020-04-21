<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Models\Transaction;
use App\Models\Stash;
use Illuminate\Http\Request;

class LoadController extends Controller
{

    private $api;
    private $transaction;
    private $stash;

    public function __construct(apiHelper $api, Transaction $transaction, Stash $stash){
        $this->api = $api;
        $this->transaction = $transaction;
        $this->stash = $stash;
    }

    public function buy(Request $request){
        try{
            \Session::put('type', $request->type);
            $body = [
                'amount' => $request->amount * 100,
                'email' => $request->email
            ];

            $response = $this->api->call('/transaction/initialize', 'POST', $body);

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

            if (\Session::get('type') === 'crd'){
                $trnxType = 'credit';
            }
            else{
                $trnxType = 'debit';
            }


            $params = [
                'reference' => $trnxData->reference,
                'status' => $trnxData->status,
                'message' => $trnxData->message ?? $trnxData->gateway_response,
                'amount' => $amountPaid,
                'investorId' => $user->investor()->id,
                'userId' => $user->id,
                'type' => $trnxType
            ];

            $this->transaction->create($params);

            //credit the Investor's wallet

            $stash = $this->stash->where('investorId', $user->investor()->id);

            if($stash->first() === null){
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
            \Session::forget('type');
            \Session::put('success', true);
            return redirect('dashboard/i/stash')->withErrors('Stash credited successfully');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return redirect('dashboard/i')->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
