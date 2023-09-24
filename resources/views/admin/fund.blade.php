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
                            <dd class="col-md-6 text-right">
                                @php
                                    $query = "http://"
                                @endphp
                                @if(substr($fund->description, 0, strlen($query)) === $query)
                                    <a target="_blank" href="{{$fund->description}}">{{$fund->description}}</a>
                                @else
                                    <p class="blue">{{$fund->description}}</p>
                                @endif
                            </dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-6">Reside in Lagos?</dt>
                            <dd class="col-md-6 text-right">
                                @if($fund->address == true)
                                    <a class="text-blue">Yes</a>
                                @else
                                    <a class="text-blue">No</a>
                                @endif
                            </dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-6">Have Existing Loan?</dt>
                            <dd class="col-md-6 text-right">
                                @if($fund->existingLoan == true)
                                    <a class="text-blue">Yes</a>
                                @else
                                    <a class="text-blue">No</a>
                                @endif
                            </dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-6">Accept that your guarantors will take full responsibility of repayment and liability if default?</dt>
                            <dd class="col-md-6 text-right">
                                @if($fund->certifyGuarantor == true)
                                    <a class="text-blue">Yes</a>
                                @else
                                    <a class="text-blue">No</a>
                                @endif
                            </dd>
                        </dl>
                        <hr>
                        <dl class="row text-black">
                            <dt class="col-md-6">Accept that your loan application details are correct ?</dt>
                            <dd class="col-md-6 text-right">
                                @if($fund->certifyDocuments == true)
                                    <a class="text-blue">Yes</a>
                                @else
                                    <a class="text-blue">No</a>
                                @endif
                            </dd>
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
                        @if($fund->progress == 'approved')
                            <dl class="row text-black">
                                <dt class="col-md-9">Fund Repayment</dt>
                                <dd class="col-md-3 text-right">
                                    <p>Fund Repayment(Month {{$fund->payment->months - $fund->payment->months_left }} of {{$fund->payment->months}})</p>
                                    @if($fund->payment->months_left <= 0)
                                        Payment Completed
                                    @else
                                        <a href="{{URL('/admin/rouzz/confirmFund/'.$fund->id.'/'.$fund->business->email)}}" class="btn btn-primary">Confirm Payment</a>
                                    @endif
                                </dd>
                            </dl>
                            <hr>
                        @endif
                        @if($fund->progress !== "review" && $fund->progress !== "visitation")
                            <dl class="row text-black">
                                <dt class="col-md-9">Reason for Approval or Rejection</dt>
                                <dd class="col-md-3 text-right">
                                    {{$fund->message}}
                                </dd>
                            </dl>
                        <hr>
                        @endif
                        {{--@if($fund->progress !== "review")
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
                        @endif --}}
                         @if($admin->role !== "business-team")
                            <dl class="row text-black">
                                <dt class="col-md-8">Actions</dt>
                                <dd class="col-md-4 float-right">
                                    <form action="{{URL('/admin/rouzz/status')}}" method="post" name="businessForm">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="businessId" value="{{$fund->business->id}}">
                                        <input type="hidden" name="fundId" value="{{$fund->id}}">
                                        <input type="hidden" name="name" value="{{$fund->user->name}}">
                                        <input type="hidden" name="email" value="{{$fund->user->email}}">
                                        <input type="hidden" name="amountPerMonth" id="amountPerMonth" class="form-control" placeholder="Amount Per Month">
                                        <input type="hidden" name="months" id="months" class="form-control" value="3">
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea name="message" id="message" class="form-control" required="required" cols="30" rows="5">{{$fund->message}}</textarea>
                                        </div>
                                        @if($fund->progress === "review")
                                            <input type="hidden" name="progress" value="visitation">
                                            <button type="submit" class="btn btn-success">
                                                Application Approved
                                            </button>
                                        @elseif($fund->progress === "visitation")
                                            <input type="hidden" name="progress" value="approved" id="prog">
                                            <div class="form-group">
                                                <label for="amount">Amount in Naira(₦)</label>
                                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount" value="{{$fund->amount}}">
                                            </div>
                                            {{--<div class="form-group">
                                                <label for="amountPerMonth">Amount Per Month in Naira(₦)</label>

                                            </div>--}}
                                            {{--<div class="form-group">
                                                <label for="months">Number of Repayment Month</label>
                                                <input type="number" name="months" id="months" class="form-control" placeholder="eg. 2, 12, 24">
                                            </div>--}}
                                            <button type="submit" class="btn btn-success">
                                                Visitation Completed(Accept Funding)
                                            </button>
                                        @endif
                                        <br>
                                        <button type="submit" class="btn btn-danger mt-2" id="rejectSubmit">
                                            Reject Application
                                        </button>
                                    </form>
                                </dd>
                            </dl>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop