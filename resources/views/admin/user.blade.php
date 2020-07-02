@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Users
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table">
                        <thead class="font-weight-bolder">
                        <tr>
                            <th>Verified</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Account Number</th>
                            <th>BVN</th>
                            <th>Bank</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-grey">
                        @foreach($users as $gUser)
                            <tr>
                                <td>
                                    @if($gUser->verified === 1)
                                        <i class="la la-check text-success font-weight-bolder"></i>
                                    @else
                                        <i class="la la-times font-weight-bolder"></i>
                                    @endif
                                </td>
                                <td>{{$gUser->name}}</td>
                                <td>{{$gUser->email}}</td>
                                <td>
                                    @if($gUser->type == 'investor')
                                        <a class="btn btn-label-success text-success">
                                            @elseif($gUser->type == 'business')
                                                <a class="btn btn-label-danger text-danger">
                                                    @else
                                                        <a class="btn btn-label-primary text-primary">
                                                            @endif
                                                            {{$gUser->type}}
                                                        </a>
                                </td>
                                <td>{{$gUser->phone}}</td>
                                <td>{{$gUser->address}}</td>
                                <td>{{$gUser->account->accountNumber ?? "null"}}</td>
                                <td>{{$gUser->account->bvn ?? "null"}}</td>
                                <td>{{$gUser->bank->name ?? "null"}}</td>
                                <td class="row justify-content-between">
                                    @if($gUser->type == "investor")
                                        <a href="{{URL('/admin/rouzz/investor/'.encrypt($gUser->id))}}" class="btn btn-success">View</a>
                                    @else
                                        <a href="{{URL('/admin/rouzz/business/'.encrypt($gUser->id))}}" class="btn btn-success">View</a>
                                    @endif
                                    <a href="{{URL('/admin/rouzz/user/delete/'.encrypt($gUser->id))}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{$users->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
