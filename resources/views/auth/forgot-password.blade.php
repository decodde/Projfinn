@extends('_containers.master')
@section('content')
    <div class="app-content content blank-page">

        <div class="content">
            <div class="content-wrapper">
                <div class="content-body">
                    <section class="pt-5 mt-5">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="col-md-6 col-10 box-shadow-0 p-0">
                                <div class="card border-grey box-shadow-0 bg-transparent m-0">
                                    <div class="card-header bg-transparent border-0">
                                        <div class="card-title text-left height-100-per">
                                            <div class="pt-1 mb-2">
                                                <img src="{{ asset('assets/app-assets/images/adobe/logo.png') }}" width="150px" alt="branding logo">
                                            </div>
                                        </div>
                                        <p class="font-size-27px text-black">Forgot your password?</p>
                                        <p>I will send reset instructions to your email address..</p>
                                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        </h6>
                                        @include("_partials.errors")
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body pt-0">
                                            <form action="{{ URL('reset') }}" class="form-horizontal" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <fieldset class="form-group floating-label-form-group">
                                                    <label for="email">Your Email</label>
                                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email Address" required>
                                                </fieldset>
                                                <button type="submit" class="btn btn-info px-3 border-radius-none"> Send</button>

                                                <p class="mt-3">Don't have an account? <a href="{{URL('/lender')}}">Register</a></p>
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
    </div>
@stop
