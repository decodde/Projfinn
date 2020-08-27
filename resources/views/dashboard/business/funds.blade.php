@extends('_partials.dashboard.master')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Funds</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Funds
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Funding History</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <p class="blue-grey lighten-2 mb-0">Funds Disbursed (Naira)</p>
                                <h6 class="text-bold-400"><a class="blue-grey">₦ 0.00</a></h6>
                            </div>
                            <div class="col-md-6 col-12 text-center">
                                <p class="blue-grey lighten-2 mb-0">Funds Repaid (Naira)</p>
                                <h6 class="text-bold-400"><a class="blue-grey">₦ 0.00</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" onclick="runThis()" class="btn btn-success btn-md my-1">Apply for Funds <i class="fa fa-plus"></i></a>
    <div class="row" id="funds">
        <div class="col-12">
            <div class="card pb-1">
                <div class="card-header">
                    <h4 class="card-title">Funds</h4>
                    <p>
                        <code>Note:</code> By Applying for Funding, It means you have read and agreed to the
                        <a href="{{ asset('assets/docs/Rouzo-Borrowers-Terms-and-Conditions.pdf') }}" target="_blank">Business's Terms of Use.</a>
                    </p>
                    <p>
                        <code>Note</code> You will be contacted via the <a href="{{URL('/dashboard/settings')}}">contact details you set in your profile</a>
                    </p>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if(count($funds) === 0)
                            <div class="text-center dotted-btn width-550 mt-4">
                                You haven't applied for any funds yet
                                <br>
                                <a href="#" onclick="runThis()" class="btn btn-success mr-1 btn-md mt-2">Apply for Funds <i class="fa fa-plus"></i></a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="borderless">
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Fund Purpose Links</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="borderless">
                                    @foreach($funds as $fund)
                                        <tr>
                                            <td>
                                                @if($fund->progress === "approved")
                                                    <i class="la la-dot-circle-o success"></i>
                                                @elseif($fund->progress === "rejected")
                                                    <i class="la la-dot-circle-o danger"></i>
                                                @else
                                                    <i class="la la-dot-circle-o warning"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="font-size-17px success darken-4">
                                                    ₦ {{App\Http\Helpers\Formatter::MoneyConvert($fund->amount, "full")}}
                                                </p>
                                            </td>
                                            <td>
                                                @php
                                                    $query = "http://"
                                                @endphp
                                                @if(substr($fund->description, 0, strlen($query)) === $query)
                                                    <a target="_blank" href="{{$fund->description}}">{{$fund->description}}</a>
                                                @else
                                                    <p class="blue">{{$fund->description}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($fund->progress === "review")
                                                    <a class="warning">Your Application is under review
                                                @elseif($fund->progress === "payment")
                                                    <a class="warning">You are to Pay a sum of ₦2,000.00
                                                @elseif($fund->progress === "approved" )
                                                    <a class="success">{{$fund->message}}
                                                @elseif($fund->progress === "rejected" )
                                                    <a class="danger">{{$fund->message}}
                                                @elseif($fund->progress === "visitation" )
                                                    <a class="warning">A face to face visitation is required
                                                @else
                                                    <a class="danger"> Your Application has been rejected
                                                @endif
                                                    </a>
                                            </td>
                                            <td>{{App\Http\Helpers\Formatter::dataTime($fund->created_at)}} </td>
                                            <td>
                                                @if($fund->progress == "approved")
                                                    <a href="{{URL('/dashboard/fund/'.encrypt($fund->id))}}" class="btn btn-outline-info info ">View Full Details<i class="ft-arrow-right position-relative" style="top: 2px;margin-left: 6px; font-size: 15px"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        <div id="makePayment" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-sm">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="font-size-18px font-weight-bold">Visitation Payment</h6>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <form action="{{ URL('/transaction/commissionFee') }}" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="businessId" value="{{ $user->business()->id }}">
                                                            <input type="hidden" name="fundId" value="{{ $fund->id }}">
                                                            <input type="hidden" name="email" value="{{ $user->email }}">
                                                            <input type="hidden" name="type" value="crd">

                                                            <div class="form-group text-center">
                                                                <label for="file">You are to pay </label>
                                                                <p>A</p>
                                                                <p>Sum of</p>
                                                                <p class="text-success font-size-20px">₦2, 0000</p>
                                                                <input type="hidden" name="amount" class="form-control" required="required" value="2000">

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:void(0);" class="danger" data-dismiss="modal">Close</a>
                                                            <button type="submit" class="btn btn-sm btn-success">Proceed to Payment</button>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$funds->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="row" id="createFunds" style="display: none">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="card-title " href="#" onclick="runThat()"><i class="la la-angle-left" style="font-size: 17px"></i> Back</a>
                    <h2 class="card-title mt-2">
                        Apply For Funding
                    </h2>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{URL('/funds/create')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label for="amount">Amount Needed in Naira(₦)</label>
                                <input type="number" id="amount" name="amount" value="" class="form-control">

                                <label for="address" class="mt-2">Do you currently reside in Lagos and is your business domiciled in Lagos?</label>
                                <div>
                                    <input type="radio" name="address" value="yes" id="">
                                    <label for="" class="mr-2">Yes</label>
                                    <input type="radio" name="address" value="no" id="">
                                    <label for="">No</label>
                                </div>

                                <label for="type" class="mt-2">What type of loan do you require?</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="asset">Asset Finance- (To purchase equipment that can be paid back within 6 months)</option>
                                    <option value="capital">Working Capital (90 day repayment cycle)</option>
                                </select>

                                <label for="existingLoan" class="mt-2">Do you currently have an existing loan facility running?</label>
                                <div>
                                    <input type="radio" name="existingLoan" value="yes" id="">
                                    <label for="" class="mr-2">Yes</label>
                                    <input type="radio" name="existingLoan" value="no" id="">
                                    <label for="">No</label>
                                </div>

                                <label for="certifyGuarantor" class="mt-2"> In the event that you as the borrower fail to make repayments and on time, the guarantor stated above takes full responsibility for repayment and liability. Do you accept?</label>
                                <div>
                                    <input type="radio" name="certifyGuarantor" value="yes" id="">
                                    <label for="" class="mr-2">Yes</label>
                                    <input type="radio" name="certifyGuarantor" value="no" id="">
                                    <label for="">No</label>
                                </div>

                                <label for="certifyDocuments" class="mt-2">Do you certify that all information contained in the loan application form and accompanying statements and documents are true?</label>
                                <div>
                                    <input type="radio" name="certifyDocuments" value="yes" id="">
                                    <label for="" class="mr-2">Yes</label>
                                    <input type="radio" name="certifyDocuments" value="no" id="">
                                    <label for="">No</label>
                                </div>

                                <label for="description" class="mt-2">What is this fund needed for?</label>
                                <textarea name="description" id="description" class="form-control" required="required" cols="30" rows="10"></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success text-center">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function runThis() {
            $('#funds').hide();
            $('#createFunds').show(100);
        }

        function runThat() {
            $('#createFunds').hide();
            $('#funds').show(100);

        }
    </script>
@stop
