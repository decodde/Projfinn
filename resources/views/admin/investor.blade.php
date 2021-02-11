@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid row" id="kt_content">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Details for <a style="color: #5867dd; font-weight: bold">{{$gUser->name}}</a>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="card-text">
                            <dl class="row text-black">
                                <dt class="col-md-8">Email Address</dt>
                                <dd class="col-md-4 text-right">{{ $gUser->email }}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Phone Number</dt>
                                <dd class="col-md-3 text-right"> {{ $gUser->phone }}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Number of Transactions Made</dt>
                                <dd class="col-md-3 text-right text-success">{{count($transactions)}}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Stash Balance</dt>
                                <dt class="col-md-3 text-right text-success" style="font-size: 16px">₦ {{App\Http\Helpers\Formatter::MoneyConvert($stash->availableAmount, "full")}}</dt>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Account Details</dt>
                                <dd class="col-md-3 text-right">
                                    <div class="guarantor">
                                        <p>BVN: <span>{{strtoupper($account->bvn)}}</span></p>
                                        <br>
                                        <p>Account Number: <span>{{$account->accountNumber}}</span></p>
                                        <br>
                                        <p>Bank: <span>{{$account->bank->name}}</span></p>
                                    </div>
                                    <hr>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            @if($adminType !== "clientservice-admin")
                <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Investments for <a style="color: #5867dd; font-weight: bold">{{$gUser->name}}</a>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table">
                            <thead class="font-weight-bolder">
                                <tr>
                                    <th>Status</th>
                                    <th>Reference</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Lock Period</th>
                                    <th>Has Completed</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody class="text-grey">
                                @foreach($investments as $investment)
                                    <tr>
                                        <td>{{$investment->portfolio->name}}</td>
                                        <td>
                                            @if($investment->paymentMethod == "stash")
                                                <a type="button" class="btn mr-1 mb-1 btn-outline-success btn-sm text-success">Stash</a>
                                            @else
                                                <a type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm text-primary">Bank</a>
                                            @endif
                                        </td>

                                        <td>{{$investment->unitsBought}}</td>
                                        <td class="text-success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->amount, "full")}}</td>
                                        <td>{{$investment->period}} Months</td>
                                        <td>
                                            @if($investment->isCompleted == false)
                                                <a class="btn btn-outline-primary btn-sm text-primary">No</a>
                                            @else
                                                <a class="btn btn-outline-success btn-sm text-success">Yes</a>
                                            @endif
                                        </td>
                                        <td class="text-success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->roi, "full")}}</td>
                                        <td>{{App\Http\Helpers\Formatter::dataTime($investment->datePurchased)}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$investments->links()}}
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@stop
