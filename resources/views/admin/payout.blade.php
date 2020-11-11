@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Record Transaction
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" method="post" action="{{URL('/admin/rouzz/transact')}}">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="col-lg-3">
                                <label class="col-form-label">User's Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                                <code class="form-text">eg: <span class="text-muted">Enter Existing user's email</span></code>
                            </div>
                            <div class="col-lg-3">
                                <label class="col-form-label">Amount the User Paid:</label>
                                <input type="text" name="amount" class="form-control" placeholder="Amount">
                                <code class="form-text">eg: <span class="text-muted">200000</span></code>
                            </div>
                            <div class="col-lg-3">
                                <label class="col-form-label">Lock Period:</label>
                                <select name="period" id="period" class="form-control">
                                    <option value="3">3</option>
                                    <option value="6">6</option>
                                    <option value="9">9</option>
                                    <option value="12">12</option>
                                </select>
                                <code class="form-text">eg: <span class="text-muted">Credit Or Debit</span></code>
                            </div>
                            <div class="col-lg-3">
                                <label class="col-form-label">Select Portfolio:</label>
                                <select name="portfolioId" class="form-control">
                                    <option value="">Yoo</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" style="width: 100px;margin-left: auto">Record</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@stop
