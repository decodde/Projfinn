<?php

namespace App\Http\Helpers;

use Validator;

class Validate {
    private $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function auth($data, $type)
    {
        if($type == "code")
        {
            return $this->validator::make($data, ["email" => "required|unique:activationCodes|email"]);
        }elseif($type == "reset-password") {
            return $this->validator::make($data, [
                "token" => "required",
                "password" => "required|min:6|confirmed",
            ]);
        }elseif($type == "login") {
            return $this->validator::make($data, [
                "email" => "required",
                "password" => "required|min:6",
            ]);
        }elseif($type == "recovery-link") {
            return $this->validator::make($data, [
                "email" => "required",
            ]);
        } else {
            return $this->validator::make($data, [
                "email" => "required|unique:users|email",
                "password" => "required|min:6|confirmed",
                "f_name" => "required",
                "l_name" => "required",
                "phone" => "required|min:11|unique:users",
                "address" => "required",
                "type" => "required", 
            ]);
        }
    }

    public function category($data, $type)
    {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    "name" => "required",
                ]);
                break;
            case 'edit':
                return $this->validator::make($data, [
                    "name" => "required",
                    "id" => "required",
                ]);
                break;
            default:
                # code...
                break;
        }
    }
    
    public function business($data, $type)
    {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'registrationStatus' => 'required',
                    'yearsOfRunning' => 'required',
                    'lastBusinessRevenue' => 'required',
                    'accountVerifiable' => 'required',
                    'l_name' => 'required',
                    'f_name' => 'required',
                    'email' => 'required|email|unique:businesses',
                    'phone' => 'required|unique:businesses',
                    'address' => 'required',
                ]);
                break;
            case 'save':
                return $this->validator::make($data, [
                    'name' => 'required',
                    'email' => 'required|email|unique:businesses,email,'.$data['id'],
                    'phone' => 'required|unique:businesses,phone,'.$data['id'],
                    'address' => 'required',
                    'categoryId' => 'required',
                    'size' => 'required',
                    'startDate' => 'required',
                    'state' => 'required',
                    'bio' => 'required',
                    'financialRaise' => 'required',
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function lender($data, $type)
    {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'f_name' => 'required',
                    'l_name' => 'required',
                    'email' => 'required|email|unique:lenders',
                    'phone' => 'required|unique:lenders',
                    'duration' => 'required',
                    'rate' => 'required',
                    'year' => 'required',
                    'band' => 'required',
                    'turnover' => 'required',
                    'categoryIds' => 'required',
                ]);
                break;
            case 'save':
                return $this->validator::make($data, [
                    'name' => 'required',
                    'email' => 'required|email|unique:lenders,email,'.$data['id'],
                    'phone' => 'required|unique:lenders,phone,'.$data['id'],
                    'address' => 'required',
                ]);
                break;
            case 'preference':
                return $this->validator::make($data, [
                    'band' => 'required',
                    'year' => 'required',
                    'turnover' => 'required',
                    'categoryIds' => 'required',
                    'rate' => 'required',
                    'duration' => 'required',
                ]);
            default:
                # code...
                break;
        }
    }

    public function eligibility($data, $type)
    {
        switch ($type) {
            case 'score':
                return $this->validator::make($data, [
                    'registrationStatus' => 'required',
                    'yearsOfRunning' => 'required',
                    'lastBusinessRevenue' => 'required',
                    'accountVerifiable' => 'required'
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function guarantor($data, $type)
    {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'businessId' => 'required',
                    'name' => 'required',
                    'phone' => 'required',
                    'relationship' => 'required',
                    'bvn' => 'required',
                ]);
                break;
            case 'save':
                return $this->validator::make($data, [
                    'id' => 'required',
                    'businessId' => 'required',
                    'name' => 'required',
                    'phone' => 'required',
                    'relationship' => 'required',
                    'bvn' => 'required',
                ]);
            default:
                # code...
                break;
        }
    }

    public function document($data, $type)
    {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'businessId' => 'required',
                    'type' => 'required',
                    'file' => 'required',
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function bvn($data, $type) {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'businessId' => 'required',
                    'number' => 'required',
                ]);
                break;
            case 'edit':
                return $this->validator::make($data, [
                    'businessId' => 'required',
                    'number' => 'required',
                    'id' => 'required',
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function plan($data, $type) {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'name' => 'required|unique:plans',
                    'description' => 'required',
                    'amount' => 'required',
                    'credit' => 'required',
                    'tag' => 'required',
                ]);
                break;
            case 'edit':
                return $this->validator::make($data, [
                    'id' => 'required',
                    'name' => 'required|unique:plans,name,'.$data['id'],
                    'description' => 'required',
                    'amount' => 'required',
                    'credit' => 'required',
                    'tag' => 'required',
                ]);
                break;
            default:
                # code...
                break;
        }
    }
}
