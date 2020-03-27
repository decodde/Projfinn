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
                                                            <img src="http://www.owoafara.com/assets/frontend/images/logo.png" width="150px" alt="branding logo">
                                                        </div>
                                                    </div>
                                                    <p class="font-size-37px font-weight-bold text-black f-2">Sign up as a Business</p>
                                                    <p>It takes two simple steps</p>
                                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2 mb-0"></h6>
                                                    @include("_partials.errors")
                                                </div>
                                                <div class="card-content collapse show">
                                                    <div class="card-body pt-0">
                                                        <form action="{{ URL('/business/createBusiness') }}" class="number-tab-steps wizard-notification" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="type" value="business">
                                                            <!-- Step 1 -->
                                                            <h6>&nbsp;</h6>
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
                                                                    <div class="col-md-6">
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
                                                            <h6>&nbsp;</h6>
                                                            <fieldset class="mt-5">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Organization Name <span style="color:red;">*</span>:</label>
                                                                            <input name="o_name" id="address" class="form-control" required="required" value="{{ old('o_name') }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Organization Address <span style="color:red;">*</span>:</label>
                                                                            <textarea name="address" id="address" class="form-control" required="required">
                                                                                {{ old('address') }}
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="firstName1">Email Address <span class="red">*</span> :</label>
                                                                            <input type="email" class="form-control" name="email" id="firstName1" value="{{ old('email') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="lastName1">Phone Number  <span class="red">*</span> :</label>
                                                                            <input type="tel" class="form-control" name="phone" id="lastName1" value="{{ old('phone') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for="name">Full name <span class="red">*</span> :</label>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="text" id="name" class="form-control" placeholder="First Name" name="f_name" value="{{ old('f_name') }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="text" id="name" class="form-control" placeholder="Last Name" name="l_name" value="{{ old('l_name') }}">
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
                                <p class="mt-0 mb-2">Already have an Account? <a href="/">Login.</a></p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="sidebar-left">
            <div class="sidebar sidebar-fixed overflow-hidden" style="height: calc(100vh - 44px);background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{ asset('assets/app-assets/images/adobe/adb2.png') }});background-size: cover;background-repeat: no-repeat;background-position: center ">
                <div class="card-title text-left height-100-per">
                    <div class="pt-1 pl-2 mb-3 position-relative height-90-per">
                        <p class="position-absolute position-bottom-0 text-white font-size-17px">Everything is still arranged the same way you left it.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
