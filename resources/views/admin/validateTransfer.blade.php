@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Validate Transfers
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if(count($transfers) !== 0 )
                        <table class="table">
                            <thead class="font-weight-bolder">
                            <tr>
                                <th>Investor</th>
                                <th>Email</th>
                                <th>Amount Requested</th>
                                <th>Date Requested</th>
                                <th>OTP Code</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-grey">
                            @foreach($transfers as $transfer)
                                <tr>
                                    <form action="{{URL('/admin/rouzz/transfer')}}" method="post">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="transfer_code" value="{{$transfer->transfer_code}}">
                                        <input type="hidden" name="investorId" value="{{$transfer->investor->id}}">
                                        <td>{{$transfer->investor->name}}</td>
                                        <td>{{$transfer->user->email}}</td>
                                        <td class="text-success" style="font-size: 16px">₦ {{App\Http\Helpers\Formatter::MoneyConvert($transfer->amount, "full")}}</td>
                                        <td>{{App\Http\Helpers\Formatter::dataTime($transfer->created_at)}} </td>
                                        <td><input type="text" class="form-control" name="otp" placeholder="OTP Code" required></td>
                                        <td><button class="btn btn-success" >View More Details</button></td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                            {{$transfers->links()}}
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
