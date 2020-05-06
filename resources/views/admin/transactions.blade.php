@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        @include('_partials.errors')
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" style="margin-top: -40px;">
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
                                <label class="col-form-label">Reference from Paystack:</label>
                                <input type="text" name="reference" class="form-control" placeholder="Reference">
                                <code class="form-text">eg: <span class="text-muted">3Dth4se234</span></code>
                            </div>
                            <div class="col-lg-3">
                                <label class="col-form-label">Transaction type:</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="credit">Credit</option>
                                    <option value="debit">Debit</option>
                                </select>
                                <code class="form-text">eg: <span class="text-muted">Credit Or Debit</span></code>
                            </div>
                            <div class="col-lg-3" id="porfolio" style="display: none">
                                <label class="col-form-label">Select Portfolio:</label>
                                <select name="portfolioId" class="form-control">
                                    @foreach($portfolios as $portfolio)
                                        <option value="{{$portfolio->id}}">{{$portfolio->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" style="width: 100px;margin-left: auto">Record</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Transactions
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if(count($transactions) !== 0 )
                        <table class="table">
                            <thead class="font-weight-bolder">
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Reference</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody class="text-grey">
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->user->name}}</td>
                                    <td>{{$transaction->user->email}}</td>
                                    <td>
                                        @if($transaction->status === "success")
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-times text-danger"></i>
                                        @endif
                                    </td>
                                    <td>{{$transaction->reference}}</td>
                                    <td>
                                        @if($transaction->type === "debit")
                                            <button type="button" class="btn mr-1 mb-1 btn-outline-danger text-danger btn-sm">Debit</button>
                                        @else
                                            <button type="button" class="btn mr-1 mb-1 btn-outline-success text-success btn-sm">Credit</button>
                                        @endif

                                    </td>
                                    <td>
                                        <p class="font-size-17px text-success darken-4">
                                            ₦ {{$transaction->amount}}
                                        </p>
                                    </td>

                                    <td>{{$transaction->message}}</td>
                                    <td>{{$transaction->date}} </td>

                                </tr>
                            @endforeach
                            </tbody>
                            {{$transactions->links()}}
                        </table>
                    @else
                        <div class="text-center dotted-btn width-550">
                            No records of any Investments yet
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
