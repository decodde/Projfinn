@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid row" id="kt_content">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Details for <a style="color: #5867dd; font-weight: bold">{{$business->name}}</a>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="card-text">
                            <dl class="row text-black">
                                <dt class="col-md-9">Business Owner</dt>
                                <dd class="col-md-3 text-right">{{ $gUser->name }}</dd>
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
                                <dt class="col-md-9">Number of Transactions Made</dt>
                                <dd class="col-md-3 text-right text-success">{{count($transactions)}}</dd>
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
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Eligibility Details</dt>
                                <dd class="col-md-3 text-right">
                                    <div class="guarantor">
                                        <p>Business Type: <span>{{$eligibility->registrationStatus}}</span></p>
                                        <br>
                                        <p>Years Of Operation: <span>{{$eligibility->yearsOfRunning}}</span></p>
                                        <br>
                                        <p>Eligibility Score: <span style="font-size:18px;color:{{ $grade->color }};">{{ $grade->grade }}</span></p>
                                    </div>
                                </dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Account Details</dt>
                                <dd class="col-md-3 text-right">
                                    <div class="guarantor">
                                        <p>Account Number: <span>{{$account->accountNumber}}</span></p>
                                        <br>
                                        <p>Bank: <span>{{$account->bank->name}}</span></p>
                                    </div>
                                </dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">BVN</dt>
                                <dd class="col-md-3 text-right">
                                    {{$business->bvn->number}}
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
                                Fund Applications for <a style="color: #5867dd; font-weight: bold">{{$business->name}}</a>
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table">
                            <thead class="font-weight-bolder">
                            <tr>
                                <th>Amount Requested</th>
                                <th>Description</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-grey">
                            @foreach($funds as $fund)
                                <tr>
                                    <td class="text-success">₦ {{App\Http\Helpers\Formatter::MoneyConvert($fund->amount, "full")}}</td>
                                    <td>{{$fund->description}}</td>
                                    <td>{{App\Http\Helpers\Formatter::dataTime($fund->created_at)}} </td>
                                    <td><a class="btn btn-success" href="{{URL('/admin/rouzz/funding/'.encrypt($fund->id))}}">View More Details</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            {{$funds->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
