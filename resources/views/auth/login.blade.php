@extends('_containers.master')
@section('content')
    <div class="app-content content blank-page">

        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-7 col-10 box-shadow-0 p-0">
                            <div class="card border-grey box-shadow-0 bg-transparent m-0">
                                <div class="card-header bg-transparent border-0">
                                    <div class="card-title text-left height-100-per">
                                        <div class="pt-1 mb-2">
                                            <img src="http://www.owoafara.com/assets/frontend/images/logo.png" width="150px" alt="branding logo">
                                        </div>
                                    </div>
                                    <p class="font-size-27px text-black">Welcome Back,</p>
                                    <p>Login to your account.</p>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    </h6>
                                    @include("_partials.errors")
                                </div>
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <form action="{{ URL('login') }}" class="form-horizontal" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <fieldset class="form-group floating-label-form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" class="form-control" id="email" placeholder="Email Address" required>
                                            </fieldset>
                                            <fieldset class="form-group floating-label-form-group mb-1">
                                                <label for="user-password">Password</label>
                                                <input type="password" name="password" class="form-control" id="user-password" placeholder="Enter Password" required>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 float-sm-left"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-info px-3 border-radius-none"><i class="ft-unlock"></i> Login</button>

                                            <p class="mt-3">Don't have an account? <a href="{{URL('/business')}}">Register</a></p>
                                            <p class="">Register as an <a href="{{URL('/lender')}}">Investor.</a></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            </div>
        </div>

        <div class="sidebar-left">
            <div class="sidebar sidebar-fixed overflow-hidden" style="height: calc(100vh - 44px);background:linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)),url(https://images.unsplash.com/photo-1530731141654-5993c3016c77?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=675&q=80);background-size: cover;background-repeat: no-repeat;">
                <div class="card-title text-left height-100-per">
                    <div class="pt-1 pl-2 mb-3 position-relative height-90-per">
                        <p class="position-absolute position-bottom-0 text-white-0 font-size-17px">Everything is still arranged the same way you left it.<br>Jump right back</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
