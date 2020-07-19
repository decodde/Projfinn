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
                                                    <p class="font-size-30px text-black">Let's Get Started</p>
                                                    <p>Stand in for businesses</p>
                                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2 mb-0"></h6>
                                                    @include("_partials.errors")
                                                </div>
                                                <div class="card-content collapse show">
                                                    <div class="card-body pt-0">
                                                        <form action="{{ URL('/introducer') }}" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="type" value="introducer">
                                                        <!-- Step 1 -->
                                                            <h5>Introducer Profile</h5>
                                                            <fieldset class="mt-2 pb-2">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="address">Organization Name <span style="color:red;">*</span>:</label>
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
                                                                            <label for="firstName1">Email Address <span class="red">*</span> :</label>
                                                                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="lastName1">Phone Number  <span class="red">*</span> :</label>
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
                                                            <button type="submit" class="btn btn-info px-3 border-radius-none"><i class="ft-unlock"></i> Create Account</button>
                                                            <p class="mt-1">Register as a <a href="{{URL('/business')}}">Business.</a></p>
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
