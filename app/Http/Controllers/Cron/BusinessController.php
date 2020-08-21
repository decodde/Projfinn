<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Http\Helpers\sendMail;
use App\Models\Business;
use App\Models\fundPayment;
use App\Models\TranxConfirm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    private $mail;
    private $business;
    private $fundPayment;
    private $api;
    private $tranx;
    public function __construct(Business $business, sendMail $mail, fundPayment $fundPayment, apiHelper $api, TranxConfirm $tranx) {
        $this->mail = $mail;
        $this->business = $business;
        $this->fundPayment = $fundPayment;
        $this->api = $api;
        $this->tranx = $tranx;
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
}
