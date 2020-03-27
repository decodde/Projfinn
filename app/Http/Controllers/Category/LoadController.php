<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Helpers\Validate;
use App\Models\Category;

class LoadController extends Controller
{
    private $validate;
    private $category;

    public function __construct(Category $category, Validate $validate) {
        $this->category = $category;
        $this->validate = $validate;
    }

    public function create(Request $request) {
        try {
            //get request body
            $data = $request->all();

            //validate the input
            $validation = $this->validate->category($data, "create");

            if($validation->fails())
            {
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                $data['slug'] = str_random(15);
                $this->category->create($data);

                return back()->withErrors('Category successfully created');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error occurred: '.$e->getMessage());
        }
    }

    public function edit(Request $request) {
        try {
            //get request body
            $data = $request->except('_token');

            //validate the input
            $validation = $this->validate->category($data, "edit");

            if($validation->fails())
            {
                //return validation error
                return back()->withErrors($validation->getMessageBag())->withInput();
            } else {
                $this->category->where('id', $request->id)->update($data);

                return back()->withErrors('Category successfully created');
            }
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error occurred: '.$e->getMessage());
        }
    }

    public function delete(Request $request) {
        try {
            $this->category->where('slug', $request->slug)->delete();

            return redirect('office/categories')->withErrors('Industry category successfully deleted');
        } catch(\Exception $e) {
            \Session::put('danger', true);
            return back()->withErrors('An error has occurred: '.$e->getMessage());
        }
    }
}
