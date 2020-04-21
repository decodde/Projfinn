<?php

namespace App\Http\Helpers;

class apiHelper{

    private function config()
    {
        //get environment
        $baseUrl = env('PAYSTACK_PAYMENT_URL');

        //check for apiToken
        $secret_key = env('PAYSTACK_SECRET_KEY');

        $config = [
            'baseUrl' => $baseUrl,
            'secret_key' => $secret_key,
        ];
        return $config;
    }

    public function call($url, $verb, $body = null)
    {
        $getConfig = $this->config();

        $uri = $getConfig['baseUrl'].$url;

        $headers = ['authorization: Bearer '.$getConfig['secret_key'], "content-type: application/json", "cache-control: no-cache"];

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if($verb === 'POST')
        {
            curl_setopt($ch, CURLOPT_POST, true);
            $body = json_encode($body);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLINFO_HTTP_CODE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $result = curl_exec($ch);
        $response = json_decode($result);

//        dd($response);

        if(!$response->status){
            // there was an error from the API
            print_r('API returned error: ' . $response['message']);
        }
        //get the curl info
        $responseInfo = curl_getinfo($ch);

        //close curl operation after successful run.
        curl_close($ch);

        if($response !== null)
        {
            if($responseInfo['http_code'] !== 0)
            {
                //add the response code to response body
                $response->http_code = $responseInfo['http_code'];
            } else {
                $response->http_code = 500;
            }
        } else {
            dd($uri, $verb, $body, $responseInfo['http_code']);
        }

//        dd($response);
        //return the response to controller
        return $response;
    }
}
