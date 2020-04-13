<?php

namespace App\Http\Controllers\Bvn;

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
    public function __construct(BVN $bvn, Validate $validate, Business $business) {
        $this->bvn = $bvn;
        $this->business = $business;
        $this->validate = $validate;
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
}
