@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Save To Borrow
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table">
                        <thead class="font-weight-bolder">
                        <tr>
                            <th>User</th>
                            <th>User type</th>
                            <th>Plan name</th>
                            <th>Savings interval</th>
                            <th>Amount</th>
                            <th>Saving progress</th>
                            <th>Months missed</th>
                            <th>Expected Eligible Loan Amount:  </th>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody class="text-grey">
                        @foreach($reserves as $reserve)
                            <tr>
                                <td><p class="mb-0">{{$reserve->user->name}}</p> <a class="text-primary">{{$reserve->user->email}}</a></td>
                                <td>
                                    @if($reserve->user->type == "business")
                                        <a class="btn btn-outline-primary btn-sm text-primary">business</a>
                                    @else
                                        <a class="btn btn-outline-success btn-sm text-success">introducer</a>
                                    @endif
                                </td>
                                <td>{{$reserve->name}}</td>

                                <td>
                                    @if($reserve->interval == "monthly")
                                        <a class="btn btn-outline-primary btn-sm text-primary">monthly</a>
                                    @elseif($reserve->interval == "weekly")
                                        <a class="btn btn-outline-danger btn-sm text-danger">weekly</a>
                                    @else
                                        <a class="btn btn-outline-success btn-sm text-success">Yes</a>
                                    @endif
                                </td>
                                <td class="text-success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($reserve->amount, 'full')}}</td>
                                <td>
                                    {{$reserve->durationPassed}}
                                    @if($reserve->interval == 'daily')
                                        Days
                                    @elseif($reserve->interval == 'weekly')
                                        Weeks
                                    @else
                                        Months
                                    @endif</td>
                                <td>
                                    {{$reserve->durationPassed - $reserve->durationPaid}}
                                    @if($admin->interval == 'daily')
                                        Days
                                    @elseif($admin->interval == 'weekly')
                                        Weeks
                                    @else
                                        Months
                                    @endif
                                </td>
                                <td class="text-success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($reserve->expectedLoanAmount, 'full')}}</td>
                                <td class="row justify-content-between">
                                    <a href="{{URL('/admin/rouzz/business/'.encrypt($user->id))}}" class="btn btn-success">View Details</a>
                            </tr>
                        @endforeach
                        </tbody>
                        {{$reserves->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop