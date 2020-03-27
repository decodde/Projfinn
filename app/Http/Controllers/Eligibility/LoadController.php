<?php

namespace App\Http\Controllers\Eligibility;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use App\Http\Helpers\partials as Partials;
use App\Http\Helpers\Validate;
use App\Models\Eligibility;

class LoadController extends Controller
{
    //
    private $partials;
    private $validate;
    private $eligibility;

    public function __construct(Partials $partials, Eligibility $eligibility, Validate $validate) {
        $this->partials = $partials;
        $this->validate = $validate;
        $this->eligibility = $eligibility;
    }

    public function score($body) {

        //validate the input
        $validation = $this->validate->eligibility($body, 'score');

        if($validation->fails()) {
            \Session::put('warning', true);
            //return validation error
            return back()->withErrors($validation->getMessageBag())->withInput();
        }

        try {
            $options = $this->partials->eligibilityOptions();

            $scores = [];

            unset($body['businessId']);

            $scoreParams = [];

            foreach ($body as $key => $value) {
//                dd($value);
                $options = $this->partials->eligibilityOptions($key);
                for ($i=0; $i < count($options); $i++) {
                    if($options[$i]->id == $value) {
                        array_push($scores, $options[$i]->score);

                        $scoreParams[$key] = $options[$i]->name;
                    }
                }
            }
//            dd($scores);

            $scoreSum = array_sum($scores);
            $scoreParams['score'] = $scoreSum;
            $scoreParams['slug'] = str_random(30);

            $scoreQuery = http_build_query($scoreParams);
            \Session::put('scoreQuery', $scoreQuery);
        } catch(\Exception $e) {
            \Session::put('danger', true);
            dd($e->getMessage());
        }
    }
}
