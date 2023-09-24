@extends('_containers.master')
@section('content')
    <style>
        body{
            background-color: #f4f5f8 !important;
        }
        html body .content.app-content{
            overflow-y: scroll;
        }
    </style>
    <div class="app-content content blank-page">

        <div class="content-wrapper">
            <div class="content-body">
                 <section class="flexbox-container d-block pt-5" style="height: 90vh">
                    <h2 class="text-center">Select Account type</h2>
                    <div class="col-12 row align-items-center justify-content-center">
                        <div class="col-md-3 col-sm-12 pt-4">

                            <div class="iconbox text-left iconbox-shadow iconbox-xl pt-40 pb-30 border-fade-black-005">
                                <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container info darken-4">
										<i class="icon-ion-ios-business"></i>
									</span>
                                </div><!-- /.iconbox-icon-wrap -->
                                <div class="contents">
                                    <h3 class="font-weight-normal">Business</h3>
                                    <p>Fund your business needs today and boost your cash flow</p>
                                    <a href="{{URL('/business')}}" class="border-thin mt-0">
										<span>
											<span class="btn btn-outline-info">Sign Up</span>
										</span>
                                    </a>
                                </div><!-- /.contents -->
                            </div><!-- /.iconbox -->

                        </div><div class="col-md-3 col-sm-12 pt-4">

                            <div class="iconbox text-left iconbox-shadow iconbox-xl pt-40 pb-30 border-fade-black-005">
                                <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container info darken-4">
										<i class="icon-ion-ios-wallet"></i>
									</span>
                                </div><!-- /.iconbox-icon-wrap -->
                                <div class="contents">
                                    <h3 class="font-weight-normal">Investor</h3>
                                    <p>Join thousands of investors earning by Investing into out Portfolios</p>
                                    <a href="{{URL('/lender')}}" class="border-thin mt-0">
										<span>
											<span class="btn btn-outline-info">Sign Up</span>
										</span>
                                    </a>
                                </div><!-- /.contents -->
                            </div><!-- /.iconbox -->

                        </div><div class="col-md-3 col-sm-12 pt-4">

                            <div class="iconbox text-left iconbox-shadow iconbox-xl pt-40 pb-30 border-fade-black-005">
                                <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container info darken-4">
										<i class="icon-ion-ios-business"></i>
										<i class="icon-ion-ios-code-working"></i>
										<i class="icon-ion-ios-business"></i>
									</span>
                                </div><!-- /.iconbox-icon-wrap -->
                                <div class="contents">
                                    <h3 class="font-weight-normal">Introducer</h3>
                                    <p>Help businesses get access to financing and earn commissions</p>
                                    <a href="{{URL('/introducer')}}" class="border-thin mt-0">
										<span>
											<span class="btn btn-outline-info">Sign Up</span>
										</span>
                                    </a>
                                </div><!-- /.contents -->
                            </div><!-- /.iconbox -->
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>
@stop