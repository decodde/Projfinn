@extends('_partials.dashboard.master')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Home</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Home
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h4 style="color:{{ $grade->color }};">{{ $grade->grade }}</h4>
                                <h6>Eligibility Score</h6>
                            </div>
                            <div>
                                <i class="fa fa-check blue-grey font-large-1 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-blue-grey" role="progressbar" style="width: 100%"
                                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success darken-4">₦ 0.00</h3>
                                <h6>Funds</h6>
                            </div>
                            <div>
                                <i class="fa fa-money success darken-4 font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
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
                                        <th>Reference</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody class="borderless">
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>
                                                @if($transaction->status === "success")
                                                    <i class="fa fa-check success"></i>
                                                @else
                                                    <i class="fa fa-times danger"></i>
                                                @endif
                                            </td>
                                            <td>{{$transaction->reference}}</td>
                                            <td>
                                                @if($transaction->type === "debit")
                                                    <button type="button" class="btn mr-1 mb-1 btn-outline-success btn-sm">Fund Repayment</button>
                                                @else
                                                    @if($transaction->amount === "2,000.00")
                                                        <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm">Visitation Fee</button>
                                                    @else
                                                        <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm">Fund Request</button>
                                                    @endif
                                                @endif

                                            </td>
                                            <td>
                                                <p class="font-size-17px success darken-4">
                                                    ₦ {{$transaction->amount}}
                                                </p>
                                            </td>

                                            <td>{{$transaction->message}}</td>
                                            <td>{{$transaction->date}} </td>

                                        </tr>
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
    </div>
@stop
