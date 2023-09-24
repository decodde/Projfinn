<?php

namespace App\Http\Controllers\Bvn;

use App\Http\Helpers\apiHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BVN;
use App\Models\Business;
use App\Http\Helpers\Validate;

class LoadController extends Controller
{
    private $bvn;
    private $business;
    private $validate;
    private $api;
    public function __construct(BVN $bvn, Validate $validate, Business $business, apiHelper $api) {
        $this->bvn = $bvn;
        $this->business = $business;
        $this->validate = $validate;
        $this->api = $api;
    }

    public function create(Request $request) {
        try {
            $body = $request->except('_token');

            //validate the input
            $validation = $this->validate->bvn($body, "create");

            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                $this->bvn->create($body);

                //update business profile percentage
                $this->business->profilePercentage($request->businessId, 5);

                return back()->withErrors('BVN is successfully added');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit(Request $request) {
        try {
            $body = $request->except('_token');

            //validate the input
            $validation = $this->validate->bvn($body, "edit");

            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                unset($body['id']);
                $this->bvn->where('id', \Crypt::decrypt($request->id))->update($body);

                return back()->withErrors('Changes successfully saved');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors($e->getMessage());
        }
    }

    public function delete(Request $request, $bvnId) {
        try {
            $this->bvn->where('id', \Crypt($bvnId))->delete();
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors($e->getMessage());
        }
    }
    
    public function valid(Request $request){
        try {
            $data = $request->except("_token");
            $bvnMatch = $this->api->call('/bank/resolve_bvn/' . $data['bvn'], 'GET');
            if ($bvnMatch === null) {
                return response()->json(["message" => "An Error Occurred", "error" => true, "data" => []], 200);
            }

            if (!$bvnMatch->status) {
                return response()->json(["message" => $bvnMatch->message, "error" => true, "data" => []], 200);
            }
            $data = [
                "first_name" => $bvnMatch->data->first_name,
                "last_name" => $bvnMatch->data->last_name,
                "bvn" => $bvnMatch->data->bvn,
            ];
            return response()->json(["message" => "BVN validated", "error" => false, "data" => $data], 200);
        }
        catch (\Exception $e){
            return response()->json(["message" => $e->getMessage(), "error" => true, "data" => []], 200);
        }
    }
}
