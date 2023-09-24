@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                           BVN Validation
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="alert alert-danger alert-dismissable flat" id="errorDanger" style="display: none">
                        <div class="container">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <a id="errorDangerMessage"></a>
                        </div>
                    </div>
                    <div class="alert alert-success alert-dismissable flat" id="errorSuccess" style="display: none">
                        <div class="container">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <a id="errorSuccessMessage"></a>
                        </div>
                    </div>
                    <form method="post" action="{{URL('/bvn/valid')}}" id="getValidation" class="form-group">
                        <label for="bvn">Bank Verification Number</label>
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control " type="text" id="bvn" name="bvn" value="{{$bvn}}" placeholder="Enter Bvn">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success" type="submit" id="activeBtn">Get Bvn Details</button>
                                <button class="btn btn-success" type="submit" style="display: none" id="inactiveBtn">Getting Bvn Details <i class="fa fa-spinner fa-spin"></i></button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input class="form-control mr-3" type="text" id="first_name" disabled placeholder="The Users First Name will appear here">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input class="form-control mr-3" type="text" id="last_name" disabled placeholder="The Users Last Name will Appear here">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop