@extends('_partials.dashboard.master')
@section('content')
    <style>
        .my--01{
            margin-top: 2px;
            margin-bottom: 2px;
        }
    </style>
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12">
            <h5 class="content-header-title">Save to borrow</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Save to borrow
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row py-1" style="flex-wrap: nowrap; overflow-x: auto">
                <div class="col-lg-4 col-sm-9">
                        <div class="card" style="border-radius: 10px">
                            <div class="card-header d-flex justify-content-between pb-0" style="border-radius: 10px">
                                <h4 class="card-title grey-blue font-weight-bold lighten-2">
                                    Stash
                                </h4>
                                <div class="float-right">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a>
                                                <i style="padding: 3px 5px !important;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#0f7bd4" opacity="0.3"/>
                                                            <polygon fill="#0f7bd4" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                                                        </g>
                                                    </svg>
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                        <p class="blue-grey lighten-2 mb-0">Available Balance (Naira)</p>
                                        <h6 class="text-bold-400"><a class="font-size-20px font-weight-bold success">₦ {{$availableAmt}}</a></h6>
                                    </div>
                                    <div class="col-md-6 col-12 text-center">
                                        <p class="blue-grey lighten-2 mb-0">Amount In Savings (Naira)</p>
                                        <h6 class="text-bold-400"><a class="font-size-20px font-weight-bold success">₦ {{$balance}}</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-sm-9 col-lg-8">
                    <div class="card" style="border-radius: 10px">
                        <div class="card-header" style="border-radius: 10px">
                            <h4 class="card-title grey-blue font-weight-bold lighten-2">Transactions</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                        <p class="blue-grey lighten-2 mb-0">Credit Transactions (Naira)</p>
                                        <h6 class="text-bold-400"><a class="font-size-20px font-weight-bold success">₦ {{$tranX["credit"]}}</a></h6>
                                    </div>
                                    <div class="col-md-6 col-12 text-center">
                                        <p class="blue-grey lighten-2 mb-0">Debit Transactions (Naira)</p>
                                        <h6 class="text-bold-400"><a class="font-size-20px font-weight-bold success">₦ {{$tranX["debit"]}}</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#saveToInvest" class="btn btn-blue mr-1 mb-2 float-right font-size-16px border-0 px-2" style="margin-top: -3px">create savings plan <i class="icon-ion-ios-cash"></i></a>
            @if($isAllowed)
                <a href="javascript:void(0);" data-toggle="modal" data-target="#makeWithdrawal" class="btn btn-primary mr-1 btn-md mb-2 float-right border-0">Withdraw savings <i class="fa fa-credit-card"></i></a>
            @else
                <a href="javascript:void(0);" data-toggle="modal" data-target="#withModal" class="btn btn-primary mr-1 btn-md mb-2 float-right border-0">Withdraw savings <i class="fa fa-credit-card"></i></a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card pb-1" style="border-radius: 10px">
                <div class="card-header" style="border-radius: 10px">
                    <h4 class="card-title">Saving plans</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <p>Clcik on the <code>View Full Details</code> button for complete information of a specific savings plan</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr class="borderless">
                                    <th>#</th>
                                    <th>Plan</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="borderless">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($savings as $saving)
                                        <tr>
                                            <td>
                                                {{$i+1}}
                                            </td>
                                            <td>
                                                <a class="grey-blue font-weight-bold lighten-2">{{$saving->name}}</a>
                                                <br>
                                                <a class="info lighten-2">{{App\Http\Helpers\Formatter::dataTime($saving->created_at)}}</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-info info mx-1 my--01" data-toggle="modal" data-target="#details{{$i}}">
                                                    View Full Details
                                                </a>
                                                <div id="details{{$i}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content px-2" style="border: none">
                                                            <div class="modal-header px-0" style="justify-content: normal; border-bottom: 1px solid #c6d4df">
                                                                <div>
                                                                    <h6 class="font-size-16px grey-blue font-weight-bold lighten-2">{{$saving->name}}</h6>
                                                                    <a class="info">{{App\Http\Helpers\Formatter::dataTime($saving->created_at)}}</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Amount: </dt>
                                                                    <dd class="success ml-1">₦ {{App\Http\Helpers\Formatter::MoneyConvert($saving->amount, 'full')}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Interval: </dt>
                                                                    <dd class="ml-1">
                                                                        {{$saving->interval}}
                                                                    </dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Expected Eligible Loan Amount: </dt>
                                                                    <dd class="success ml-1">
                                                                        ₦ {{App\Http\Helpers\Formatter::MoneyConvert($saving->expectedLoanAmount, 'full')}}
                                                                    </dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Reference: </dt>
                                                                    <dd class="ml-1"> {{$saving->reference}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Duration Missed: </dt>
                                                                    <dd class="ml-1">
                                                                        {{$saving->durationPassed - $saving->durationPaid}}
                                                                        @if($saving->interval == 'daily')
                                                                            Days
                                                                        @elseif($saving->interval == 'weekly')
                                                                            Weeks
                                                                        @else
                                                                            Months
                                                                        @endif
                                                                    </dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Savings Progress: </dt>
                                                                    <dd class="ml-1">
                                                                        {{$saving->durationPassed}} / {{$saving->duration}}
                                                                        @if($saving->interval == 'daily')
                                                                            Days
                                                                        @elseif($saving->interval == 'weekly')
                                                                            Weeks
                                                                        @else
                                                                            Months
                                                                        @endif
                                                                    </dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Next Payment: </dt>
                                                                    <dd class="ml-1">{{App\Http\Helpers\Formatter::dataTime($saving->nextPayment)}}</dd>
                                                                </dl>
                                                            </div>
                                                            <div class="modal-footer" style="border-top: 1px solid #c6d4df">
                                                                <a data-dismiss="modal" class="text-center m-auto info" style="text-decoration: underline">Dismiss</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            {{$savings->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="saveToInvest" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="font-size-18px font-weight-bold">Save To Borrow</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('/business/save') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <div class="form-group d-flex">
                            <div class="mr-1">
                                <label for="name">Savings Name</label>
                                <input type="text" name="name" class="form-control" required="required">
                            </div>
                            <div>
                                <label for="amount">Amount in Naira (₦)</label>
                                <input type="number" name="amount" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file">Savings Interval <i class="fa fa-info-circle" title="how frequent do you want to save?"></i></label>
                            <select class="form-control" name="interval">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        <p><code>Note:</code>the savings plan will span for a minimum of 3 months</p>
                        <p><code>Note:</code>your will make the first payment now so as to store your details for subsequent payment</p>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-sm btn-success">Proceed to Payment</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <div id="makeWithdrawal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="font-size-18px font-weight-bold">Withdraw from savings</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('/transaction/transferBusiness') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <input type="hidden" name="type" value="business">
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <div class="form-group">
                            <label for="amount">Amount in Naira (₦)</label>
                            <input type="number" name="amount" id="amount" class="form-control" required="required">
                        </div>
                    </div>
                    <p class="mx-1"><code>Note:</code> The money will be transferred to the <a href="{{URL('/dashboard/i/settings')}}">account set during your bank verification</a></p>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="danger" data-dismiss="modal">Close</a>
                        <button type="submit" id="activeBtn" class="btn btn-sm btn-success text-white font-size-14px">Withdraw</button>
                        <button type="submit" id="inactiveBtn" class="btn btn-sm btn-success text-white font-size-14px" style="display: none" disabled>Processing Withdrawal ... <i class="fa fa-spinner fa-spin"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="withModal" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-0 pr-2 pt-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body font-size-16 font-weight-bold py-0">
                    <br>
                    <p class="py-1">
                        Please Try again later, Your Previous Withdrawal Request is being processed
                    </p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if($isStash == true)
        <div class="modal fade bd-example-modal-sm" id="stashModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0 p-0 pr-2 pt-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body font-size-16 font-weight-bold py-0">
                        Hi <a class="blue-grey darken-4">{{$user->name}}</a>👋,
                        <br>
                        <p class="py-1">
                            &nbsp;&nbsp;&nbsp;&nbsp;You are eligible for a loan of <a class="success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($totalExpectedLoan, 'full')}}</a> at the end of your savings.
                        </p>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
