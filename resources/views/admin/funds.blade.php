@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Funding
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if(count($funds) !== 0 )
                        <table class="table">
                            <thead class="font-weight-bolder">
                            <tr>
                                <th>Business</th>
                                <th>Email</th>
                                <th>Amount Requested</th>
                                <th>Description</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-grey">
                            @foreach($funds as $fund)
                                <tr>
                                    <td>{{$fund->business->name}}</td>
                                    <td>{{$fund->user->email}}</td>
                                    <td class="text-success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($fund->amount, "full")}}</td>
                                    <td>{{$fund->description}}</td>
                                    <td>{{App\Http\Helpers\Formatter::dataTime($fund->created_at)}} </td>
                                    <td><a class="btn btn-success" href="{{URL('/admin/rouzz/funding/'.encrypt($fund->id))}}">View More Details</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            {{$funds->links()}}
                        </table>
                    @else
                        <div class="text-center dotted-btn width-550">
                            No records of any Funds yet
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
