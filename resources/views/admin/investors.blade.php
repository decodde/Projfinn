@extends('admin.master')
@section('content')
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Investors
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
                        <th>Phone</th>
                        <th>Address</th>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody class="text-grey">
                    @foreach($users as $user)
                    <tr>
                        <td>
                            @if($user->verified === 1)
                            <i class="la la-check text-success font-weight-bolder"></i>
                            @else
                            <i class="la la-times font-weight-bolder"></i>
                            @endif
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td class="row justify-content-between">
                            <a href="{{URL('/admin/rouzz/investor/'.encrypt($user->id))}}" class="btn btn-success">View</a>
                            @if($admin->role !== "business-team")
                            <a href="{{URL('/admin/rouzz/user/delete/'.encrypt($user->id))}}" class="btn btn-danger">Delete</a></td>
                            @endif
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
