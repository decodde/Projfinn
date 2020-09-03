@extends('_partials.dashboard.master')
@section('content')
    <style>
        .borderless, .borderless > th{
            border: none !important;
        }

        .table td{
            border-top: none !important;
        }
        .my--01{
            margin-top: 2px;
            margin-bottom: 2px;
        }

    </style>
    @if($purchase['can'] === true)
        <div class="alert alert-success flat">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            😉 Do you know you can purchase units from the <a class="text-black font-weight-bold underline" href="{{URL('/dashboard/i/investment/'.encrypt($purchase['pid']))}}">{{$purchase['portfolioName']}}</a>
        </div>
    @endif
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Savings</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard/i')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Savings
                        </li>
                    </ol>
                </div>
            </div>
            <p class="m-0">Save up money for investments.</p> <p class="mb-0"><code>Note</code> Your balance cannot be less than <a class="success darken-4">₦1,000.00</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-money success darken-4 font-size-16px" title="Balance"></i> Stash Balance</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <p class="blue-grey lighten-2 mb-0">Available Balance (Naira) <i class="fa fa-info-circle grey-blue darken-4" data-toggle="tooltip" data-placement="top" title="This is the total amount you have immediate access to in your account."></i></p>
                                <h6 class="text-bold-400"><a class="success">₦   {{$availableAmt}}</a></h6>
                            </div>
                            <div class="col-md-6 col-12 text-center">
                                <p class="blue-grey lighten-2 mb-0">Total Balance (Naira) <i class="fa fa-info-circle grey-blue darken-4" data-toggle="tooltip" data-placement="top" title="This is the total amount held in your account, this includes savings and saving's interests."></i></p>
                                <h6 class="text-bold-400"><a class="blue-grey">₦ {{$balance}}</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Transactions</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <p class="blue-grey lighten-2 mb-0">Credit Transactions (Naira)</p>
                                <h6 class="text-bold-400"><a class="blue-grey">₦ {{$tranX["credit"]}}</a></h6>
                            </div>
                            <div class="col-md-6 col-12 text-center">
                                <p class="blue-grey lighten-2 mb-0">Debit Transactions (Naira)</p>
                                <h6 class="text-bold-400"><a class="blue-grey">₦ {{$tranX["debit"]}}</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#makeWithdrawal" class="btn btn-primary mr-1 btn-md mb-2 float-right border-0">Withdraw savings <i class="fa fa-credit-card"></i></a>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#makePayment" class="btn btn-success mr-1 btn-md mb-2 float-right border-0">Credit your wallet <i class="fa fa-plus"></i></a>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#saveToInvest" class="btn btn-blue mr-1 mb-2 float-right font-size-16px border-0 px-2" style="margin-top: -3px">Save to Invest <i class="icon-ion-ios-wallet"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card pb-1">
                <div class="card-header">
                    <h4 class="card-title">Transactions</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if(count($transactions) !== 0 )
                            <p class="card-text">The <code>type</code> field shows if the transaction was a credit or debit transaction.<br>
                                The <code>status</code> field shows if the transaction was successful or failed.
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="borderless">
                                            <th>Status</th>
                                            <th>Transaction</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="borderless">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>
                                                @if($transaction->status === "success")
                                                    <i class="fa fa-check success"></i>
                                                @else
                                                    <i class="fa fa-times danger"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="">{{$transaction->reference}}</a>
                                                <br>
                                                <a class="font-size-17px success darken-4">₦ {{$transaction->amount}}</a>
                                                <br>
                                                <a href="">{{App\Http\Helpers\Formatter::dataTime($transaction->created_at)}}</a>
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
                                                                    <h6 class="font-size-16px grey-blue font-weight-bold lighten-2">{{$transaction->reference}}</h6>
                                                                    <a class="info">{{App\Http\Helpers\Formatter::dataTime($transaction->created_at)}}</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Amount: </dt>
                                                                    <dd class="success ml-1">₦ {{$transaction->amount}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Type: </dt>
                                                                    <dd class="ml-1">
                                                                        @if($transaction->type === "debit")
                                                                            <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm">Investment</button>
                                                                        @else
                                                                            <button type="button" class="btn mr-1 mb-1 btn-outline-success btn-sm">Credit</button>
                                                                        @endif
                                                                    </dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Reference: </dt>
                                                                    <dd class="ml-1"> {{$transaction->reference}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Date: </dt>
                                                                    <dd class="ml-1">{{App\Http\Helpers\Formatter::dataTime($transaction->created_at)}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Message: </dt>
                                                                    <dd class="ml-1"> {{$transaction->message}}</dd>
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
                                {{$transactions->links()}}
                            </div>
                        @else
                            <div class="text-center dotted-btn width-550">
                                You haven't made any transaction Yet
                                <br>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#makePayment" class="btn btn-success mr-1 btn-md mt-2">credit your wallet <i class="fa fa-plus"></i></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card pb-1">
                <div class="card-header">
                    <h4 class="card-title">Saving Plans</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if(count($transactions) !== 0 )
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="borderless">
                                        <th>Name</th>
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
                                                <a href="">{{$saving->name}}</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-info info mx-1 my--01" data-toggle="modal" data-target="#detail{{$i}}">
                                                    View Full Details
                                                </a>
                                                <div id="detail{{$i}}" class="modal fade" role="dialog">
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
                                                                    <dd class="success ml-1">₦ {{$saving->amount}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Interval: </dt>
                                                                    <dd class="ml-1">
                                                                        {{$saving->interval}}
                                                                    </dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Reference: </dt>
                                                                    <dd class="ml-1"> {{$saving->reference}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Savings span: </dt>
                                                                    <dd class="ml-1"> {{$saving->months}} months</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Savings Progress: </dt>
                                                                    <dd class="ml-1"> {{$saving->monthsPaid}} / {{$saving->months}} months</dd>
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
                        @else
                            <div class="text-center dotted-btn width-550">
                                You haven't made any transaction Yet
                                <br>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#makePayment" class="btn btn-success mr-1 btn-md mt-2">credit your wallet <i class="fa fa-plus"></i></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="card pb-1">
                <div class="card-header">
                    <h4 class="card-title">Withdrawals</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body px-0">
                        @if(count($transfers) !== 0 )
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="borderless">
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody class="borderless">
                                    @foreach($transfers as $transfer)
                                        <tr>
                                            <td>
                                                @if($transfer->otpConfirmed === true)
                                                    <i class="fa fa-check success" title="This transaction has been confirmed"></i>
                                                @else
                                                    <i class="fa fa-times warning" title="This transaction is pending"></i>
                                                @endif
                                            </td>
                                            <td class="px-1">
                                                <p class="font-size-17px success darken-4">
                                                    ₦ {{App\Http\Helpers\Formatter::MoneyConvert($transfer->amount, "full")}}
                                                </p>
                                            </td>

                                            <td class="px-1">
                                                @if($transfer->otpConfirmed === true)
                                                    The Money has been disbursed
                                                @else
                                                    The Money will be disbursed soon
                                                @endif
                                            </td>
                                            <td class="px-1">{{App\Http\Helpers\Formatter::dataTime($transfer->created_at)}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$transfers->links()}}
                            </div>

                        @else
                            <div class="text-center dotted-btn width-250">
                                You haven't made any withdrawal Yet
                                <br>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#makeWithdrawal" class="btn btn-primary mr-1 btn-md mb-2">Withdraw savings <i class="fa fa-credit-card"></i></a>
                            </div>
                        @endif
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
                    <h6 class="font-size-18px font-weight-bold">Credit Your Savings</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('/transaction/buy') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="businessId" value="{{ $investor->id }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="type" value="crd">

                        <div class="form-group">
                            <label for="file">Amount in Naira (₦)</label>
                            <input type="number" name="amount" class="form-control" required="required">
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
    <div id="saveToInvest" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="font-size-18px font-weight-bold">Save To Invest</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('/stash/save') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="type" value="crd">

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
                            <label for="file">Saving Interval <i class="fa fa-info-circle" title="how frequent do you want ton save?"></i></label>
                            <select class="form-control" name="interval">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Investment span <i class="fa fa-info-circle" title="how long do you want to invest?"></i></label>
                            <select class="form-control" name="span">
                                <option value="3">3 months (1.5% interest)</option>
                                <option value="6">6 months (3.6% interest)</option>
                                <option value="9">9 months (5.4% interest)</option>
                            </select>
                        </div>
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

                <form action="{{ URL('/transaction/transfer') }}" method="POST" enctype="multipart/form-data" id="getAmt">
                    <div class="modal-body">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <input type="hidden" name="investorId" value="{{ $user->investor()->id }}">
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
@stop
