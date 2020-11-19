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
                                    <td><a class="btn btn-primary text-white">Liquidate</a> </td>
                                </tr>
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
