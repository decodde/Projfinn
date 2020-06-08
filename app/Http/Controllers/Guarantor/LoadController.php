<?php

namespace App\Http\Controllers\Guarantor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Guarantor;
use App\Models\Business;
use App\Http\Helpers\Validate;

class LoadController extends Controller
{
    private $guarantor;
    private $business;
    private $validate;
    public function __construct(Guarantor $guarantor, Validate $validate, Business $business) {
        $this->guarantor = $guarantor;
        $this->business = $business;
        $this->validate = $validate;
    }

    public function create(Request $request) {
        try {
            $body = $request->except('_token');

            //validate the input
            $validation = $this->validate->guarantor($body, "create");

            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                $this->guarantor->create($body);

                $count = $this->guarantor->where('businessId', $request->businessId)->count();

                if($count == 1) {
                    //update business profile percentage
                    $this->business->profilePercentage($request->businessId, 5);
                } elseif($count == 2) {
                    //update business profile percentage
                    $this->business->profilePercentage($request->businessId, 5);
                }

                return back()->withErrors('Guarantor saved successfully.');
            }
        } catch(\Excpetion $e) {
            \Session::put('red', true);
            return back()->withErrors('An error has occured: '.$e->getMessage());
        }
    }

    public function save(Request $request) {
        try {
            $body = $request->except('_token');

            //validate the input
            $validation = $this->validate->guarantor($body, "save");

            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                unset($body['id']);
                $this->guarantor->where('id', \Crypt::decrypt($request->id))->update($body);

                return back()->withErrors('Guarantor changes saved successfully.');
            }
        } catch(\Excpetion $e) {
            \Session::put('red', true);
            return back()->withErrors('An error has occured: '.$e->getMessage());
        }
    }

    public function delete(Request $request, $guarantorId) {
        try {
            $query = $this->guarantor->where('id', \Crypt::decrypt($guarantorId));

            $this->business->reduceProfilePercentage($query->value('businessId'), 5);

            $query->delete();

            return back()->withErrors('Guarantor deleted successfully.');
        } catch(\Excpetion $e) {
            \Session::put('red', true);
            return back()->withErrors('An error has occured: '.$e->getMessage());
        }
    }
}
