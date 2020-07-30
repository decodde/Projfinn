@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid row" id="kt_content">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Details for <a style="color: #5867dd; font-weight: bold">{{$introducer->name}}</a>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="card-text">
                            <dl class="row text-black">
                                <dt class="col-md-9">Introducer Name</dt>
                                <dd class="col-md-3 text-right">{{ $gUser->name }}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Introducer Address</dt>
                                <dd class="col-md-3 text-right">{{$introducer->address}}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Email Address</dt>
                                <dd class="col-md-3 text-right">{{ $gUser->email }}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Phone Number</dt>
                                <dd class="col-md-3 text-right"> {{ $gUser->phone }}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-6">Documents</dt>
                                <dd class="col-md-6 text-right">
                                    @foreach($documents as $document)
                                        <p>
                                            <a>{{ ucfirst($document->type) }} :</a>
                                            <a href="{{ $document->file }}" target="_blank" class="btn btn-primary">View file <i class="la la-link"></i></a>
                                        </p>
                                    @endforeach
                                </dd>
                            </dl>
                            <dl class="row text-black">
                                <dt class="col-md-9">Account Details</dt>
                                <dd class="col-md-3 text-right">
                                    @if($account !== null)
                                    <div class="guarantor">
                                        <p>Account Number: <span>{{$account->accountNumber}}</span></p>
                                        <br>
                                        <p>Bank: <span>{{$account->bank->name}}</span></p>
                                    </div>
                                    @else
                                        <p>Account details Not Found</p>
                                    @endif
                                </dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">BVN</dt>
                                <dd class="col-md-3 text-right">
                                    @if($account !== null)
                                        {{$account->bvn}}
                                    @else
                                        <p>No BVN Found</p>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Businesses Under <a style="color: #5867dd; font-weight: bold">{{$introducer->name}}</a>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table">
                            <thead class="font-weight-bolder">
                            <tr>
                                <th>Verified</th>
                                <th>Organization Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <td>Actions</td>
                            </tr>
                            </thead>
                            <tbody class="text-grey">
                            @foreach($businesses as $business)
                                <tr>
                                    <td>
                                        @if($business->user->verified === 1)
                                            <i class="la la-check text-success font-weight-bolder"></i>
                                        @else
                                            <i class="la la-times font-weight-bolder"></i>
                                        @endif
                                    </td>
                                    <td>{{$business->name}}</td>
                                    <td>{{$business->email}}</td>
                                    <td>{{$business->phone}}</td>
                                    <td>{{$business->address}}</td>
                                    <td class="row justify-content-between">
                                        <a href="{{URL('/admin/rouzz/business/'.encrypt($business->user->id))}}" class="btn btn-success">View</a>
                                        @if($admin->role !== "business-team")
                                            <a href="{{URL('/admin/rouzz/user/delete/'.encrypt($business->user->id))}}" class="btn btn-danger">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
