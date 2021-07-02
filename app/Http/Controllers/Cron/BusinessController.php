<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Http\Helpers\sendMail;
use App\Models\Business;
use App\Models\fundPayment;
use App\Models\Reserve;
use App\Models\Transaction;
use App\Models\TranxConfirm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    private $mail;
    private $business;
    private $fundPayment;
    private $api;
    private $tranx;
    private $reserve;
    private $user;
    private $transaction;

    public function __construct(Business $business, sendMail $mail, fundPayment $fundPayment, apiHelper $api, TranxConfirm $tranx, Reserve $reserve, User $user, Transaction $transaction) {
        $this->mail = $mail;
        $this->business = $business;
        $this->fundPayment = $fundPayment;
        $this->api = $api;
        $this->tranx = $tranx;
        $this->reserve = $reserve;
        $this->user = $user;
        $this->transaction = $transaction;
    }
    //
    public function fundReminder() {
        try {
            $funding = $this->fundPayment->where("isCompleted", false)->get();

            $counter = 0;
            $now = Carbon::now()->isoFormat('YYYY-MM-DD');
            $now = Carbon::create($now);
            $p = [];
            foreach($funding as $key => $fund) {
                $business = $this->business->where('id', $fund->businessId)->first();
                $r = Carbon::create($fund->nextPayment)->isoFormat('YYYY-MM-DD');
                $r = Carbon::create($r);

                if($r->diffInDays($now) == 0){
                    $data = [
                        "date" => $r->format('l jS \\of F Y'),
                        "email" => $business->email,
                        "name" => $business->name,
                        "url" => URL('/dashboard/')
                    ];
                    $this->mail->sendFundingReminder($data);
                }
                elseif ($r->isPast()){
                    $data = [
                        "date" => $r->format('l jS \\of F Y'),
                        "email" => $business->email,
                        "name" => $business->name,
                        "url" => URL('/dashboard/')
                    ];
                    $this->mail->sendPostFundReminder($data);
                }
                elseif ($r->diffInDays($now) == 1){
                    $data = [
                        "date" => $r->format('l jS \\of F Y'),
                        "email" => $business->email,
                        "name" => $business->name,
                        "url" => URL('/dashboard/')
                    ];
                    $this->mail->sendPreFundReminder($data);
                }

                array_push($p, [$r->isPast(), $r->diffInDays($now), $r, $now]);
                $counter++;
            }

            return response()->json(['message' => $counter . ' funding repayment has been found', 'data' => $p], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => 'An error has occurred: '.$e->getMessage()], 500);
        }
    }

    public function savingsPlan() {
        try {
            $reserves = $this->reserve->where(["isCompleted" => false, "isStarted" => true])->get();

            $counter = 0;

            foreach ($reserves as $reserve){
                $now = Carbon::now()->isoFormat('YYYY-MM-DD');
                $now = Carbon::create($now);

                $nextP = Carbon::create($reserve->nextPayment)->isoFormat('YYYY-MM-DD');;
                $nextP = Carbon::create($nextP);

                $diff = $now->diffInDays($nextP);

                if ($nextP->isPast() == true || $diff == 0){
                    $chargeParams = [
                        "authorization_code" => $reserve->auth_code,
                        "email" => $reserve->email,
                        "amount" => $reserve->amount * 100,
                    ];
                    $chargeAuth = $this->api->call("/transaction/charge_authorization", "POST", $chargeParams);

                    $user = $this->user->where('email', $reserve->email)->first();
                    $params = [
                        'reference' => $chargeAuth->data->reference,
                        'status' => $chargeAuth->status,
                        'message' => $chargeAuth->message ?? $chargeAuth->gateway_response,
                        'amount' => $reserve->amount,
                        'userId' => $user->id,
                        'type' => "reserve"
                    ];

                    if ($user->type == "business"){
                        $params['businessId'] = $user->business()->id;
                    }

                    $this->transaction->create($params)->id;
                    $getReserveForUpdate = $this->reserve->where('id', $reserve->id);
                    if ($chargeAuth->status == true){
                        $getReserveForUpdate->increment("durationPassed", 1);
                        $getReserveForUpdate->increment("durationPaid", 1);
                    }
                    else{
                        $getReserveForUpdate->increment("durationPassed", 1);

                    }

                    if ($reserve->interval === 'daily'){
                        $projection = $now->addDays(1);
                    }
                    elseif ($reserve->interval === 'weekly'){
                        $projection = $now->addWeeks(1);
                    }
                    else{
                        $projection = $now->addMonths(1);
                    }

                    $getReserveForUpdate->update(["nextPayment" => $projection]);

                    if ($reserve->durationPassed >= $reserve->duration){
                        $getReserveForUpdate->update(["isCompleted" => true]);

                    }
                }
                $counter++;
            }

            return response()->json(['message' => $counter . ' funding repayment has been found'], 200);
        } catch(\Exception $e) {
            return response()->json(['message' => 'An error has occurred: '.$e->getMessage()], 500);
        }
    }
}
