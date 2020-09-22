@extends('_containers.master')
@section('content')
    <div class="app-content content">

        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <div class="col-md-8 offset-1 col-10 box-shadow-0 p-0">
                                <section id="number-tabs">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card border-grey box-shadow-0 bg-transparent m-0">
                                                <div class="card-header bg-transparent border-0 pt-0">
                                                    <div class="card-title text-left height-100-per">
                                                        <div class="pt-0 mb-2">
                                                            <img src="{{ asset('assets/app-assets/images/adobe/logo.png') }}" width="150px" alt="branding logo">
                                                        </div>
                                                    </div>
                                                    @if($r_user !== null)

                                                        <p class="font-size-24px text-black f-2"><a class="blue">{{$r_user["name"]}}</a> has invited you to boost your cash flow with Rouzo </p>
                                                        <p>Help Businesses Thrive</p>
                                                    @else
                                                        <p class="font-size-24px text-black">Let's Get Started</p>
                                                        <p>Fund your business needs today</p>
                                                    @endif

                                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2 mb-0"></h6>
                                                    @include("_partials.errors")
                                                </div>
                                                <div class="card-content collapse show">
                                                    <div class="card-body pt-0">
                                                        <form action="{{ URL('/business/createBusiness') }}" class="number-tab-steps wizard-notification" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="type" value="business">
                                                            @if($r_user !== null)
                                                                <input type="hidden" name="rCode" value="{{$r_user["code"]}}">
                                                                @if($r_user["email"] == 'nomail')
                                                                    <input type="hidden" name="nomail" value="true">
                                                            @endif
                                                            @endif

                                                            <!-- Step 1 -->
                                                            <h6>&nbsp;Eligibility Test</h6>
                                                            <fieldset class="mt-5">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="registrationStatus">What type of company registration do you have ? <span class="red">*</span> :</label>
                                                                            <select name="registrationStatus" id="registrationStatus" class="form-control" required="required">
                                                                                <option disabled selected>Please choose an option</option>
                                                                                @foreach($eligibilityOptions->registrationStatus as $key => $status)
                                                                                    <option value="{{ $status->id }}">{{ ucfirst($status->name) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="yearsOfRunning">How long have you been in business ? <span class="red">*</span> :</label>
                                                                            <select name="yearsOfRunning" id="yearsOfRunning" class="form-control" required="required">
                                                                                <option disabled selected>Please choose an option</option>
                                                                                @foreach($eligibilityOptions->yearsOfRunning as $key => $year)
                                                                                    <option value="{{ $year->id }}">{{ ucfirst($year->name) }}</option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="lastBusinessRevenue">Have you been paying or passing your business in a bank account ? <span class="red">*</span> :</label>
                                                                            <br>
                                                                            @foreach($eligibilityOptions->lastBusinessRevenue as $key => $revenue)
                                                                                <label for="Revenue{{$revenue->id}}" class="light-font"><input type="radio" {{ $key == 0 ? 'required="required"' : null }} name="lastBusinessRevenue" id="Revenue{{$revenue->id}}" value="{{ $revenue->id }}"> {{ ucfirst($revenue->name) }} </label>
                                                                                <br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="accountVerifiable">Was most of this money been paid through a company account that can be verified ? :</label>
                                                                            <br>
                                                                            @foreach($eligibilityOptions->accountVerifiable as $key => $accountVerifiable)
                                                                                <label for="accountVerifiable{{$accountVerifiable->id}}" class="light-font"><input type="radio" name="accountVerifiable" id="accountVerifiable{{$accountVerifiable->id}}" {{ $key == 0 ? 'required="required"' : null }} value="{{ $accountVerifiable->id }}"> {{ ucfirst($accountVerifiable->name) }} </label>
                                                                                <br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <!-- Step 2 -->
                                                            <h6>Registration</h6>
                                                            <fieldset class="mt-5">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="o_name">Organization Name <span style="color:red;">*</span>:</label>
                                                                            <input name="o_name" id="o_name" class="form-control" required="required" value="{{ old('o_name') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Organization Address <span style="color:red;">*</span>:</label>
                                                                            <textarea name="address" id="address" class="form-control" required="required" value=""></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="email">Email Address <span class="red">*</span> :</label>
                                                                            @if($r_user !== null)
                                                                                @if($r_user["email"] !== 'nomail')
                                                                                    <input type="email" class="form-control" name="email" id="email" value="{{ $r_user['email'] }}" readonly>
                                                                                @else
                                                                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                                                                @endif
                                                                            @else
                                                                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="phone">Phone Number  <span class="red">*</span> :</label>
                                                                            <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for="name">Full name <span class="red">*</span> :</label>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="text" id="f_name" class="form-control" placeholder="First Name" name="f_name" value="{{ old('f_name') }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="text" id="l_name" class="form-control" placeholder="Last Name" name="l_name" value="{{ old('l_name') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2 mt-0"></h6>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="password">Password <span class="red">*</span> :</label>
                                                                            <input type="password" class="form-control" id="password" name="password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="confirmation_password">Confirm Password <span class="red">*</span> :</label>
                                                                            <input type="password" class="form-control" id="confirmation_password" name="password_confirmation">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <p class="mt-0 mb-2">Already have an Account? <a href="{{URL('/login')}}">Login.</a></p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="sidebar-left">
            <div class="sidebar sidebar-fixed overflow-hidden" style="height: calc(100vh - 44px);background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{ asset('https://images.unsplash.com/photo-1573162915851-0af01102b7be?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80') }});background-size: cover;background-repeat: no-repeat;background-position-x: left ">
                <div class="card-title text-left height-100-per">
                    <div class="pt-2 pl-2 mb-3 position-relative height-90-per">
                        <p class="position-absolute position-bottom-0 text-white font-size-17px">We are here to support you and we help businesses of all time take their next step.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="businessTerms" tabindex="-1" role="dialog" aria-labelledby="businessTermsTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="businessTermsTitle">Business Loan Requirements</h5>
                    </div>
                    <div class="modal-body text-black">
                        <p>1. CAC document.</p>
                        <p>2. Utility bill bearing business address.</p>
                        <p>3. Current business account statement for the last 6 months.</p>
                        <p>4. No existing loan facility.</p>
                        <p>5. 1 Guarantor(including address and Bank Verification Number bearing guarantor's name).</p>
                        <p>6. Domiciled in Lagos, Nigeria.</p>
                        <label>
                            <input type="checkbox" name="riqu" id="riqu">
                            <a class="blue" style="text-decoration: underline; padding-left: 5px">
                                I have read the requirements listed above and my business meets all requirements listed above.
                            </a>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="rqContinue" data-dismiss="modal" disabled="disabled">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
