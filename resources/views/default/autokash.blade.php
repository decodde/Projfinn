@extends('_containers.default')
@section('content')
    <div class="titlebar titlebar-md scheme-light text-center bg-center pb-130" style="background: linear-gradient( rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1622210642960-0f6a2cdbdc9f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2340&h=800&q=80'); background-position-y: top !important;background-size: auto; background-repeat: no-repeat">

        @include('_containers.header')
        <!-- /.main-header -->

        <div class="titlebar-inner pt-80 pb-0">
            <div class="container titlebar-container">
                <div class="row titlebar-container">
                    <div class="titlebar-col col-md-8 col-md-offset-2">
                        <h1 data-fittext="true" data-fittext-options='{ "maxFontSize": 50, "minFontSize": 32 }' class="f-2">Autokash</h1>
                        <p class="text-white">Get up to N4 Million Loan with your car as collateral. Fast, reliable and convenient payment in 30 Minutes.</p>
                    </div><!-- /.titlebar-col -->
                </div><!-- /.titlebar-row -->
            </div><!-- /.titlebar-container -->
        </div><!-- /.titlebar-inner -->

    </div><!-- /.titlebar -->
    <style>
        body{
            color: #212529;
            overflow: hidden;
            text-justify: auto;
        }
    </style>
    <main id="content" class="content">
        <section class="vc-row">
            <div class="container">
                <hr class="m-0">
            </div>
        </section>
        <section class="vc_row pt-90 pb-90 text-center" style="background: linear-gradient(to bottom,  #f8fbff,  rgba(250, 251, 251, 0))">
            <div class="container">
                <iframe class="airtable-embed" src="https://airtable.com/embed/shr5EgNrcw6t1KvZo?backgroundColor=blue" frameborder="0" onmousewheel="" width="100%" height="1600" style="background: transparent; border: 1px solid #ccc;"></iframe>
            </div>
        </section>

        <div class="faq-question pt-30 pb-50">
            <div class="heading text-center">
                <h3 class="text-black text-center">Need help?</h3>
                <p class="text-gray mt-16 mb-0">Reach out to us for assistance at any time. If you require any assistance, one of our Support Specialists will be happy to assist you.</p>
            </div>
            <div class="row text-center d-flex flex-wrap justify-content-center mt-4">
                <div class="col-lg-4 col-md-12 col-sm-12 p-3">
                    <div class="iconbox text-center iconbox-shadow-hover iconbox-xl border-fade-black-005">
                        <div class="iconbox-icon-wrap">
                            <div class="iconbox-icon-container">
                                <img src="{{ asset('assets/assets/img/actual/phone.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="contents">
                            <h5 class="text-black text-20 m-0">+234 7044152333</h5>
                            <p class="text-gray mt-2">We are always happy to help.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 p-3">
                    <div class="iconbox text-center iconbox-shadow-hover iconbox-xl border-fade-black-005">
                        <div class="iconbox-icon-wrap">
                            <div class="iconbox-icon-container">
                                <img src="{{ asset('assets/assets/img/actual/cs.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="contents">
                            <h5 class="text-black text-20 m-0">hello@rouzo.org</h5>
                            <p class="text-gray mt-2">Alternative way to get anwser faster.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- /#content.content -->
@stop
