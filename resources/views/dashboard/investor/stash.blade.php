@extends('_partials.dashboard.master')
@section('content')
    <style>
        .borderless, .borderless > th{
            border: none !important;
        }

        .table td{
            border-top: none !important;
        }

    </style>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card" title="This is the total money you have in your stash. click on the 'credit your wallet button to credit your stash for investment' ">
                <div class="card-content" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <h1 style="margin-top: -10px;"><i class="fa fa-money success darken-4 font-size-40px" title="ROI"></i></h1>
                            </div>
                            <div class="col-10">
                                <h6 >₦  {{$balance}}</h6>
                                <span class="text-muted">Available Balance</span>
                            </div>
                        </div>

                        <div class="chart-stats mb-2 float-right mt-1">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#makePayment" class="btn btn-success mr-1 btn-glow btn-sm">credit your wallet <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Transactions</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
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
                                                <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-sm">Debit</button>
                                            @else
                                                <button type="button" class="btn mr-1 mb-1 btn-outline-success btn-sm">Credit</button>
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
                        </div>
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
                    <h6 class="font-size-18px font-weight-bold">Credit Your Stash</h6>
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
@stop
