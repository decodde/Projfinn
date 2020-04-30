@extends('_containers.master')
@section('content')
    <div class="app-content content">

        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <div class="offset-md-1 offset-sm-0 col-sm-12 col-md-8 box-shadow-0 p-0">
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

                                                        <p class="font-size-24px text-black f-2"><a class="text-blue">{{$r_user["name"]}}</a> has invited you to Invest into Businesses </p>
                                                        <p>Help Businesses Thrive</p>
                                                     @else
                                                        <p class="font-size-24px text-black f-2">Start Investing Into Portfolios</p>
                                                        <p>Help Businesses Thrive</p>
                                                    @endif
                                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2 mb-0"></h6>
                                                    @include("_partials.errors")
                                                </div>
                                                <div class="card-content collapse show">
                                                    <div class="card-body pt-0">
                                                        <form action="{{ URL('/lender') }}" class="number-tab-steps wizard-notification" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="type" value="investor">
                                                            @if($r_user !== null)
                                                                <input type="hidden" name="rCode" value="{{$r_user["code"]}}">
                                                            @endif
                                                            <!-- Step 1 -->
                                                            <h6>&nbsp;Investor Profile</h6>
                                                            <fieldset class="mt-5 pb-2">

                                                                {{-- ROw --}}

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="firstName1">Email Address <span class="red">*</span> :</label>
                                                                            <input type="email" class="form-control" name="email" id="firstName1" value="{{ old('email') }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="lastName1">Phone Number  <span class="red">*</span> :</label>
                                                                            <input type="tel" class="form-control" name="phone" id="lastName1" value="{{ old('phone') }}" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- ROw --}}

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">What type of Investor best describes you <span class="red">*</span> :</label>
                                                                            <div class="card collapse-icon accordion-icon-rotate">

                                                                                @for($i = 0; $i<count($l_category); $i++)
                                                                                <div id='{{"headingCollapse1".$i}}' class="card-header">
                                                                                    <input type="radio" name="lenderCategoryId" value="{{$l_category[$i]["id"]}}" required>

                                                                                    @if($i === 0)
                                                                                        <a data-toggle="collapse" href='{{"#collapse1".$i}}' aria-expanded="true" aria-controls='{{"#collapse1".$i}}' class="text-blue f-2 font-weight-bold card-title lead collapsed pl-1">{{$l_category[$i]["name"]}}</a>
                                                                                    @else
                                                                                        <a data-toggle="collapse" href='{{"#collapse1".$i}}' aria-expanded="false" aria-controls='{{"#collapse1".$i}}' class="text-blue f-2 font-weight-bold card-title lead collapsed pl-1">{{$l_category[$i]["name"]}}</a>
                                                                                    @endif
                                                                                </div>

                                                                                    @if($i === 0)
                                                                                        <div id='{{"collapse1".$i}}' role="tabpanel" aria-labelledby='{{"headingCollapse1".$i}}' class="collapse show" aria-expanded="true">
                                                                                    @else
                                                                                        <div id='{{"collapse1".$i}}' role="tabpanel" aria-labelledby='{{"headingCollapse1".$i}}' class="collapse" aria-expanded="false">
                                                                                    @endif
                                                                                    <div class="card-content">
                                                                                        <div class="card-body pt-0 pl-4">
                                                                                            {{$l_category[$i]["description"]}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @endfor

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </fieldset>
                                                            <!-- Step 2 -->
                                                            <h6>&nbsp;Personal Details</h6>
                                                            <fieldset class="mt-5">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label for="name">Full name <span class="red">*</span> :</label>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="text" id="name" class="form-control" placeholder="First Name" name="f_name" value="{{ old('f_name') }}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="text" id="name" class="form-control" placeholder="Last Name" name="l_name" value="{{ old('l_name') }}" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Address <span style="color:red;">*</span>:</label>
                                                                            <textarea name="address" id="address" class="form-control" required="required" value=""></textarea>
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
                                                                    <div class="col-md-12">
                                                                        <label for="">
                                                                            <input type="checkbox" name="terms" required>
                                                                            I agree to the <a href="{{ asset('assets/docs/Rouzo-Investors-Terms-and-Conditions.pdf') }}">Terms & Conditions</a>
                                                                        </label>
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
            <div class="sidebar sidebar-fixed overflow-hidden" style="height: calc(100vh - 44px);background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url(https://images.unsplash.com/photo-1573164574572-cb89e39749b4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjF9&auto=format&fit=crop&w=1350&q=80);background-size: cover;background-repeat: no-repeat;background-position: center ">
                <div class="card-title text-left height-100-per">
                    <div class="pt-1 pl-2 mb-3 position-relative height-90-per">
                        <p class="position-absolute position-bottom-0 text-white font-size-17px">Join thousands of investors earning by Investing into businesses.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
