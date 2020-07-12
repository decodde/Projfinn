@extends('admin.master')
@section('content')
    <style>
        .guarantor{
            text-align: left;
        }
        .guarantor p{
            margin-bottom: 0;
            font-size: 15px;
        }
        .guarantor span{
            font-size: 14px;
            color: #000;
        }
    </style>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Funding for <a style="color: #5867dd; font-weight: bold">{{$fund->business->name}}</a>
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="card-text">
                        <dl class="row text-black">
                            <dt class="col-md-9">Amount</dt>
                            <dd class="col-md-3 text-success text-right" style="font-size: 16px">₦ {{App\Http\Helpers\Formatter::MoneyConvert($fund->amount, "full")}}</dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-6">Description</dt>
                            <dd class="col-md-6 text-right"><a href="{{$fund->description}}" target="_blank">{{ $fund->description }}</a></dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-9">Contact Details</dt>
                            <dd class="col-md-3 text-right">
                                Phone Number: {{ $fund->user->phone }}
                            <br/>
                                Email Address: {{ $fund->user->email }}
                            </dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-9">Documents</dt>
                            <dd class="col-md-3 text-right">
                                @foreach($fund->documents as $document)
                                    <p>
                                        <a>{{ ucfirst($document->type) }} :</a>
                                        <a href="{{ $document->file }}" target="_blank" class="btn btn-primary">View file <i class="la la-link"></i></a>
                                    </p>
                                @endforeach
                            </dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-9">Guarantors</dt>
                            <dd class="col-md-3 text-right">
                                @foreach($fund->guarantors as $guarantor)
                                    <div class="guarantor">
                                        <p>Relationship: <span>{{strtoupper($guarantor->relationship)}}</span></p>
                                        <br>
                                        <p>Name: <span>{{$guarantor->name}}</span></p>
                                        <br>
                                        <p>Phone Number: <span>{{$guarantor->phone}}</span></p>
                                        <br>
                                        <p>Email: <span>{{$guarantor->email}}</span></p>
                                        <br>
                                        <p>BVN: <span>{{$guarantor->bvn}}</span></p>
                                    </div>
                                    <hr>
                                @endforeach
                            </dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-9">Application Date</dt>
                            <dd class="col-md-3 text-right">
                                {{App\Http\Helpers\Formatter::dataTime($fund->created_at)}}
                            </dd>
                        </dl>
                        <hr>
                        @if($fund->progress !== "review")
                            <dl class="row text-black">
                                <dt class="col-md-9">Commission Fee: </dt>
                                @if($fund->progress === "payment")
                                    <dd class="col-md-3 text-right text-danger">
                                        The commission fee has not been paid
                                    </dd>
                                @else
                                    <dd class="col-md-3 text-right text-success">
                                        The commission fee has been paid
                                    </dd>
                                @endif
                            </dl>
                            <hr>
                        @endif
                        <dl class="row text-black">
                            <dt class="col-md-8">Actions</dt>
                            <dd class="col-md-4 d-flex float-right" style="justify-content: space-evenly">
                                <form action="{{URL('/admin/rouzz/status')}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="businessId" value="{{$fund->business->id}}">
                                    <input type="hidden" name="name" value="{{$fund->user->name}}">
                                    <input type="hidden" name="email" value="{{$fund->user->email}}">
                                    @if($fund->progress === "review")
                                        <input type="hidden" name="progress" value="payment">
                                        <button type="submit" class="btn btn-success">
                                            Application Approved
                                        </button>
                                    @elseif($fund->progress === "visitation")
                                        <input type="hidden" name="progress" value="approved">
                                        <button type="submit" class="btn btn-success">
                                            Visitation Completed(Accept Funding)
                                        </button>
                                    @elseif($fund->progress === "approved")
                                        <input type="hidden" name="progress" value="rejected">
                                        <button type="submit" class="btn btn-success">
                                            Visitation Completed(Reject Funding)
                                        </button>
                                    @endif
                                </form>
                                <form action="{{URL('/admin/rouzz/status')}}" method="post">
                                    <button type="submit" class="btn btn-danger">
                                        <input type="hidden" name="progress" value="rejected">
                                        Reject Application
                                    </button>
                                </form>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
