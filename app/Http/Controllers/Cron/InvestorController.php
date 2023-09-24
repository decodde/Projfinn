<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Http\Helpers\Formatter;
use App\Http\Helpers\partials;
use App\Http\Helpers\sendMail;
use App\Models\Investment;
use App\Models\Lender;
use App\Models\Portfolio;
use App\Models\Saving;
use App\Models\Stash;
use App\Models\User;
use Carbon\Carbon;

class InvestorController extends Controller
{
    private $mail;
    private $investment;
    private $stash;
    private $user;
    private $portfolio;
    private $formatter;
    private $saving;
    private $api;
    private $investor;
    private $partials;
    public function __construct(sendMail $mail, Investment $investment, Stash $stash, User $user, Portfolio $portfolio, Formatter $formatter, Saving $saving, apiHelper $api, Lender $investor, partials $partials)
    {
        $this->mail = $mail;
        $this->investment = $investment;
        $this->stash = $stash;
        $this->user = $user;
        $this->portfolio = $portfolio;
        $this->formatter = $formatter;
        $this->saving = $saving;
        $this->api = $api;
        $this->investor = $investor;
        $this->partials = $partials;
    }

    public function transferInvestment()
    {
        try {
            $investments = $this->investment->where("isOpen", true)->get();

            $counter = 0;
            foreach ($investments as $investment) {
                $now = Carbon::now();

                $pdate = Carbon::create($investment->datePurchased);
                $projectedDay = Carbon::create($investment->datePurchased)->addMonths($investment->period);

                $investment->diff = $now->diffInMonths($investment->datePurchased);

                $stash = $this->stash->where("investorId", $investment->investorId);

                if($investment->diff >= $investment->period){
                    $daysS = $pdate->diffInDays($projectedDay);
                    if($investment->oldInv == true){
                        $amt = ($investment->roi + $investment->amount);
                    }
                    else{
                        $amt = ($investment->roi + $investment->amount);
                    }
                    $stash->increment('totalAmount', $amt);
                    $stash->increment('availableAmount', $amt);

                    $this->investment->where("id", $investment->id)->update(["isOpen" => "false"]);
                    $getUser = $this->user->where("id", $investment->userId)->first();
                    $getPortfolio = $this->portfolio->where("id", $investment->portfolioId)->first();
                    $data = [
                        "email" => $getUser->email,
                        "name" => $getUser->name,
                        "amount" => ''.$this->formatter->MoneyConvert($investment->amount, 'full'),
                        "portfolio" => $getPortfolio->name,
                        "url" => URL('/dashboard/i/stash')
                    ];
                    $this->mail->sendInvestmentMature($data);
                    $counter++;
                }
            }

            return response()->json(['message' => $counter . ' investment found today'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error has occurred: ' . $e->getMessage()], 500);
        }
    }

    public function verifySub(){
        try {
            $savings = $this->saving->where(["isCompleted" => false, "isStarted" => true])->get();

            $counter = 0;

            foreach ($savings as $saving){

                if($saving->monthsPaid != 0){
                    $now = Carbon::now()->isoFormat('YYYY-MM-DD');
                    $now = Carbon::create($now);

                    $nextP = Carbon::create($saving->nextPayment)->isoFormat('YYYY-MM-DD');
                    $nextP = Carbon::create($nextP);

                    $diff = $now->diffInDays($nextP);

                    if ($nextP->isPast() == true || $diff == 0){

                        $getSub = $this->api->call("/subscription/".$saving->sub_code, "GET");
                        $allSubs = $getSub->data->invoices;

                        $lenOfInv = 0;
                        foreach ($allSubs as $sub_val){
                            if($sub_val->status == "success"){
                                $lenOfInv += 1;
                            }
                        }

                        if ($lenOfInv > $saving->monthsPaid-1){

                            $this->saving->where("id", $saving->id)->increment("monthsPaid", 1);

                            if ($saving->interval == "monthly"){
                                $x = $saving->months;
                            }
                            elseif($saving->interval == "weekly"){
                                $x = $saving->months * 4;
                            }
                            else{
                                $x = $saving->months * 30;
                            }
                            if ($saving->monthsPaid + 1 >= $x){
                                $this->saving->where("id", $saving->id)->update(["isCompleted" => true]);
                                $now = Carbon::now();
                                $dayCreated = Carbon::create($saving->datePurchased);
                                $projectedMonths = Carbon::create($saving->datePurchased)->addMonths(intval($saving->months));
                                $diffToday = $now->diffInDays($dayCreated);
                                $diffProj = $dayCreated->diffInDays($projectedMonths);
                                $roi = $this->partials->interestSavings($saving->months) * $saving->amount;
                                $amt = (($diffToday / $diffProj) * $roi) + ($saving->amount * ($saving->monthsPaid-1));

                                $investor = $this->investor->where("email", $saving->email)->first();
                                $stash = $this->stash->where("investorId", $investor->id);

                                $stash->increment('totalAmount', $amt);
                                $stash->increment('availableAmount', $amt+$saving->amount);
                                $sub_body = [
                                    "code" => $saving->sub_code,
                                    "token" => $saving->email_token
                                ];
                                $disableSub = $this->api->call("/subscription/disable", "POST", $sub_body);
                            }
                            $counter++;
                        }
                    }
                }
            }

            return response()->json(['message' => $counter . ' savings updated today'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error has occurred: ' . $e->getMessage()], 500);
        }
    }
}