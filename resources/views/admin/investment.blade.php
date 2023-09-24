@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Investments
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if(count($investments) !== 0 )
                        <table class="table">
                            <thead class="font-weight-bolder">
                            <tr>
                                <th>User</th>
                                <th>Portfolio</th>
                                <th>Payment Method</th>
                                <th>Units Bought</th>
                                <th>Amount</th>
                                <th>Lock Period</th>
                                <th>Has Completed</th>
                                <th>Projected Return</th>
                                <th>Date Purchased</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-grey">
                            @php
                                $i = 0;
                            @endphp
                            @foreach($investments as $investment)
                                <tr>
                                    <td><p class="mb-0">{{$investment->user->name}}</p> <a class="text-primary">{{$investment->user->email}}</a></td>
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
                                    <td>
                                        @if($investment->isOpen == "true")
                                            <a class="btn btn-primary text-white" href="javascript:void(0);" data-toggle="modal" data-target="#liquidateModal{{$i}}">Liquidate</a>
                                        @else
                                            investment closed
                                        @endif
                                    </td>

                                    <div class="modal fade bd-example-modal-sm" id="liquidateModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="false">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content border-0">
                                                <div class="modal-header border-0 p-0 pr-2 pt-1">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body py-0">
                                                    <p class="py-1">
                                                        Are you sure you want to Liquidate this investment
                                                        <br><br> Email <a class="text-primary">{{$investment->user->email}}</a>
                                                        <br><br> Amount: <a class="text-success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->amount, "full")}}</a>
                                                        <br><br> Return: <a class="text-success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->roi, "full")}}</a>
                                                        <br><br> Lock Period: <a>{{$investment->period}} Months ({{App\Http\Helpers\Formatter::dataTime($investment->datePurchased)}})</a>
                                                    </p>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <a href="{{URL('/admin/rouzz/liquidate/'.$investment->id)}}" class="btn btn-success">Yes</a>
                                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @php
                                    $i++
                                @endphp
                            @endforeach
                            </tbody>
                            {{$investments->links()}}
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