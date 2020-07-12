<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Document;
use App\Models\Business;
use App\Http\Helpers\Validate;

use Cloudder as Cloudinary;

class LoadController extends Controller
{

    private $document;
    private $validate;
    private $business;
    private $cloudinary;
    public function __construct(Document $document, Validate $validate, Cloudinary $cloudinary, Business $business) {
        $this->document = $document;
        $this->validate = $validate;
        $this->business = $business;
        $this->cloudinary = $cloudinary;
    }

    public function create(Request $request) {
        try {
            $body = $request->except('_token');

            //validate the input
            $validation = $this->validate->document($body, "create");

            if($validation->fails())
            {
                \Session::put('warning', true);
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                $ext = $request->file('file')->getClientOriginalExtension();
                $extArr = ['pdf', 'docs', 'docx', 'jpeg', 'jpg'];

                if(in_array($ext, $extArr)) {
                    $body['file'] = Cloudinary::upload($request->file)->getResult()['url'];

                    $this->document->create($body);

                    $count = $this->document->where('businessId', $request->businessId)->count();

                    if($count == 1) {
                        $this->business->profilePercentage($request->businessId, 5);
                    } elseif($count == 2) {
                        $this->business->profilePercentage($request->businessId, 5);
                    }

                    return back()->withErrors('Document saved successfully.');
                } else {
                    \Session::put('warning', true);
                    return back()->withErrors('Document failed to upload, allowed file types includes '.implode(', ',$extArr));
                }
            }
        } catch(\Excpetion $e) {
            \Session::put('red', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }

    public function delete(Request $request, $documentId) {
        try {
            $query = $this->document->where('id', \Crypt::decrypt($documentId));

            $this->business->reduceProfilePercentage($query->value('businessId'), 5);

            $query->delete();

            return back()->withErrors('Document deleted successfully.');
        } catch(\Excpetion $e) {
            \Session::put('red', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
