@extends('_partials.dashboard.master')
@section('content')
    <style>
        .borderless th, .borderless td{
            border: none !important;
        }
        @media (max-width: 768px){
            .font-sm-1{
                font-size: 1rem;
            }
            .px-sm-02{
                padding-left: .4rem !important;
                padding-right: .4rem !important;
            }
        }
    </style>
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Fund</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard/')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard/funds')}}">Funds</a>
                        </li>
                        <li class="breadcrumb-item active">{{App\Http\Helpers\Formatter::dataTime($fund->created_at)}}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card px-2 pb-3" id="investDetails">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr class="borderless text-center">
                                    <th class="grey-blue lighten-1 font-size-16px font-weight-normal font-sm-1 px-sm-02">Amount</th>
                                    <th class="grey-blue lighten-1 font-size-16px font-weight-normal font-sm-1 px-sm-02">Loan Type</th>
                                    <th class="grey-blue lighten-1 font-size-16px font-weight-normal font-sm-1 px-sm-02">Progress</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="borderless text-center">
                                    <td class="success darken-3 font-weight-bold font-size-20px font-sm-1 px-sm-02" >₦ {{App\Http\Helpers\Formatter::MoneyConvert($fund->amount, 'full')}}</td>
                                    <td class="grey-blue darken-3 font-weight-bold font-size-16px font-sm-1 px-sm-02">
                                        @if($fund->type == "capital")
                                            Working Capital (90 day repayment cycle)
                                        @else
                                            Asset Finance- (To purchase equipment that can be paid back within 6 months)
                                        @endif
                                    </td>
                                    <td class="font-weight-bold font-size-16px font-sm-1 px-sm-02">
                                        @if($fund->progress == "approved")
                                            <a class="success darken-3">Approved</a>
                                        @elseif($fund->progress == "rejected")
                                            <a class="danger darken-3">Rejected</a>
                                        @else
                                            <a class="success darken-3">In Review</a>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card px-1" style="border: 1px solid #efefef">
                            <div class="card-header p-0 pt-2 pb-1">
                                <h4 class="card-title grey-blue lighten-1">
                                    Fund Repayment(Month {{$fund->payment->months - $fund->payment->months_left + 1}} of {{$fund->payment->months}})
                                </h4>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr class="borderless text-center">
                                                <th class="grey-blue lighten-1 font-size-15px font-weight-normal font-sm-1 px-sm-02">Amount</th>
                                                <th class="grey-blue lighten-1 font-size-15px font-weight-normal font-sm-1 px-sm-02">Payment Day</th>
                                                <th class="grey-blue lighten-1 font-size-15px font-weight-normal font-sm-1 px-sm-02">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="borderless text-center">
                                                <td class="success darken-3 font-weight-bold font-size-16px font-sm-1 px-sm-02">₦ {{App\Http\Helpers\Formatter::MoneyConvert($fund->payment->amountPerMonth, 'full')}}</td>
                                                <td class="grey-blue lighten-1 font-size-16px font-weight-normal font-sm-1 px-sm-02">{{$fund->payment->nextPayment}}</td>
                                                <td class="grey-blue darken-3 font-size-16px font-sm-1 px-sm-02">
                                                    @if($fund->payment->months_left <= 0)
                                                        <a class="text-success">Payment completed</a>
                                                    @else
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#makePayment" class="btn btn-primary">Pay Now</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-text px-1">
                        <h5 class="font-weight-bold grey-blue lighten-3">Purpose of Funding</h5>
                        <p>
                            {{$fund->description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="makePayment" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="font-size-18px font-weight-bold">Fund Repayment</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('/transaction/repayFund') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="businessId" value="{{ $user->business()->id }}">
                        <input type="hidden" name="fundId" value="{{ $fund->id }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="type" value="funding">

                        <div class="form-group text-center">
                            <label for="file">You are to pay </label>
                            <p>A</p>
                            <p>Sum of</p>
                            <p class="text-success font-size-20px">₦ {{App\Http\Helpers\Formatter::MoneyConvert($fund->payment->amountPerMonth, 'full')}}</p>
                            <input type="hidden" name="amount" class="form-control" required="required" value="{{$fund->payment->amountPerMonth}}">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-sm btn-success">Proceed to Payment</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@stop
