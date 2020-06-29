@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Referrals
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table">
                        <thead class="font-weight-bolder">
                        <tr>
                            <th>hasPayed</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Referrer Name</th>
                            <th>Referrer Email</th>
                        </tr>
                        </thead>
                        <tbody class="text-grey">
                        @foreach($referrals as $referral)
                            <tr>
                                <td>
                                    @if($referral->hasPayed == true)
                                        <i class="la la-check text-success font-weight-bolder"></i>
                                    @else
                                        <i class="la la-times font-weight-bolder"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($user->type == "investor")
                                        <a href="{{URL('/admin/rouzz/investor/'.encrypt($referral->user->id))}}" class="text-success">
                                    @else
                                        <a href="{{URL('/admin/rouzz/business/'.encrypt($referral->user->id))}}" class="text-success">
                                    @endif
                                        {{$referral->user->name}}
                                    </a>
                                </td>
                                <td>{{$referral->user->email}}</td>
                                <td>
                                    @if($user->type == "investor")
                                        <a href="{{URL('/admin/rouzz/investor/'.encrypt($referral->referrer->id))}}" class="text-success">
                                    @else
                                        <a href="{{URL('/admin/rouzz/business/'.encrypt($referral->referrer->id))}}" class="text-success">
                                    @endif
                                    {{$referral->referrer->name}}
                                    </a>
                                </td>
                                <td>{{$referral->referrer->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{$referrals->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
