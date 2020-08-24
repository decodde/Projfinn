<?php

namespace App\Http\Controllers\Stash;

use App\Http\Controllers\Controller;
use App\Http\Helpers\apiHelper;
use App\Models\Saving;
use App\Models\Stash;
use App\Models\TranxConfirm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoadController extends Controller
{
    //
    private $stash;
    private $api;
    private $tranx;
    private $saving;
    public function __construct(Stash $stash, apiHelper $api, TranxConfirm $tranx, Saving $saving){
        $this->stash = $stash;
        $this->api = $api;
        $this->tranx = $tranx;
        $this->saving = $saving;
    }

    public function saveToInvest(Request $request){
        try{
            $data = $request->except('_token');

            $planData = [
                "name" => $data["name"],
                "amount" => $data["amount"] * 100,
                "interval" => $data["interval"]
            ];
            $result = $this->api->call("/plan", 'POST', $planData);
            if ($result->status !== true){
                \Session::put('danger', true);
                return back()->withErrors("An Error Occurred");
            }


            $body = [
                'amount' => $data["amount"] * 100,
                'email' => $data["email"]
            ];

            $response = $this->api->call('/transaction/initialize', 'POST', $body);

            $Tranxdata = [
                "email" => $data['email'],
                "amount" => $data['amount'],
                "type" => "saving",
                "reference" => $response->data->reference,
                "plan_code" => $result->data->plan_code,
            ];

            $this->tranx->create($Tranxdata);

            $savingData = [
                'email' => $data['email'],
                'name' => $data["name"],
                'amount' => $data["amount"],
                'interval' => $data["interval"],
                'plan_code' => $result->data->plan_code,
                'reference' => $response->data->reference,
                'months' => $data["span"],
            ];
            $this->saving->create($savingData);
            return redirect($response->data->authorization_url);
        }
        catch (\Exception $e){
            \Session::put('danger', true);
            return redirect('dashboard/i')->withErrors('An error has occurred: '.$e->getMessage());
        }


    }
}
