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

    public function account($data, $type)
    {
        if($type == "edit")
        {
            return $this->validator::make($data, [
                "userId" => "required",
                "l_name" => "required",
                "f_name" => "required",
                "phone" => "required"
            ]);
        }
        else if($type == "updateDetails"){
            return $this->validator::make($data, [
                "dd" => "required",
                "userId" => "required",
                "bankId" => "required",
                // "bvn" => "required",
                "accountNumber" => "required"
            ]);
        }
        else if($type == "updateBus"){
            return $this->validator::make($data, [
                "dd" => "required",
                "userId" => "required",
                "bankId" => "required",
                "accountNumber" => "required"
            ]);
        }
        else if($type == "business"){
            return $this->validator::make($data, [
                "userId" => "required",
                "bankId" => "required",
                "accountNumber" => "required|unique:bus_accounts"
            ]);
        }
        else if($type == "introducer"){
            return $this->validator::make($data, [
                "userId" => "required",
                "bankId" => "required",
                "accountNumber" => "required|unique:introducer_accounts"
            ]);
        }
        else {
            return $this->validator::make($data, [
                "userId" => "required",
                "bankId" => "required",
                // "bvn" => "required|unique:lender_accounts",
                "accountNumber" => "required|unique:lender_accounts"
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
                    'lenderCategoryId' => 'required',
                    'terms' => 'required'
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
                    'lenderCategoryId' => 'required',
                ]);
            default:
                # code...
                break;
        }
    }

    public function introducer($data, $type)
    {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'o_name' => 'required',
                    'f_name' => 'required',
                    'l_name' => 'required',
                    'email' => 'required|email|unique:introducers',
                    'phone' => 'required|unique:introducers',
                    'address' => 'required',
                    "password" => "required|min:6|confirmed",
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function invite($data, $type)
    {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'introducerId' => 'required',
                    'businessName' => 'required',
                    'email' => 'required|email|unique:introducers|unique:lenders',
                ]);
                break;
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
            case 'intCreate':
                return $this->validator::make($data, [
                    'introducerId' => 'required',
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

    public function investment($data, $type) {
        switch ($type) {
            case 'create':
                return $this->validator::make($data, [
                    'unitsBought' => 'required',
                    'portfolioId' => 'required',
                    'paymentMethod' => 'required',
                    'amount' => 'required',
                    'months' => 'required'
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function contact($data, $type) {
        switch ($type) {
            case 'submit':
                return $this->validator::make($data, [
                    'email' => 'required',
                    'name' => 'required',
                    'message' => 'required',
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function transaction($data, $type) {
        switch ($type) {
            case 'admin':
                return $this->validator::make($data, [
                    'email' => 'required',
                    'reference' => 'required',
                    'type' => 'required',
                ]);
                break;
            case 'transfer':
                return $this->validator::make($data, [
                    'userId' => 'required',
                    'investorId' => 'required',
                    'amount' => 'required',
                    'name' => 'required',
                ]);
                break;
            default:
                # code...
                break;
        }
    }
    public function fund($data, $type) {
        switch ($type) {
            case 'apply':
                return $this->validator::make($data, [
                    'amount' => 'required',
                    'description' => 'required',
                ]);
                break;
            default:
                # code...
                break;
        }
    }
}
