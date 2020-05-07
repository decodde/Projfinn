@extends('_containers.default')
@section('content')
    @include('_containers.header')

    <main id="content" class="content">
        <section
            class="vc_row py-5 py-md-0 bg-cover bg-center vh-80 d-flex flex-wrap align-items-center"
            data-slideshow-bg="true"
            data-slideshow-options='{ "effect": "slide", "imageArray": ["https://images.unsplash.com/photo-1573164574144-649081e9421a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80", "{{ asset('assets/app-assets/images/adobe/adb3.png') }}", "{{ asset('assets/app-assets/images/adobe/adb1.png') }}"] }'>

            <span class="row-bg-loader"></span>

            <div class="liquid-row-overlay bg-fade-dark-05"></div>

            <div class="container">
                <div class="row d-flex flex-wrap align-items-center">

                    <div
                        class="lqd-column col-md-7 col-xs-12 mb-7 mb-md-0"
                        data-custom-animations="true"
                        data-ca-options='{ "triggerHandler":"inview", "animationTarget":"all-childs", "duration":"1200", "delay":"150", "easing":"easeOutQuint", "direction":"forward", "initValues":{"translateY":60, "opacity":0}, "animations":{"translateY":0, "opacity":1} }'>
                        <h2
                            class="text-white mt-0 mb-30 font-weight-normal">Returns + Impact,<br>
                            Earn Healthy Returns In These Times
                        </h2>

                        <p class="font-size-14 lh-175 text-fade-white-07 pr-md-9 mr-md-9 mb-50">Support small businesses to grow and contribute to economic development.</p>

                        <a href="{{URL('/lender')}}" class="btn btn-default btn-sm border-none btn-register box-shadow-3 f-1 font-weight-light">
                            <span>
                                <span class="btn-txt"> &nbsp; Create A Free Account &nbsp;</span>
                            </span>
                        </a>
                        <p class="text-white mb-0 hidden-lg" style="margin-top: 10px !important; margin-bottom: 5px !important;">Or</p>
                        <a href="{{URL('/login')}}" class="btn btn-white btn-sm border-none btn-login box-shadow-3 f-1 hidden-lg font-weight-light mt-1">
                            <span>
                                <span class="btn-txt"> &nbsp; Login &nbsp;</span>
                                <span class="icon-ion-ios-arrow-forward"></span>
                            </span>
                        </a>

                    </div><!-- /.col-md-7 -->

                    @if(auth()->check())
                    @else
                        <div class="lqd-column col-md-5 hidden-xs col-xs-12 px-md-4 text-center">

                            <div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-40 pb-40">

                                <header class="fancy-title">
                                    <h2 class="mb-2 font-size-30 font-weight-light">Already Have an Account?</h2>
                                    <p class="mt-0">Login to your account.</p>
                                </header><!-- /.fancy-title -->

                                <div class="contact-form contact-form-inputs-filled contact-form-button-block font-size-14 mb-3">
                                    <form method="post"  action="{{ URL('login') }}"novalidate="novalidate">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input class="bg-gray text-dark" type="email" name="email" aria-required="true" aria-invalid="false" placeholder="Your email address" required>
                                            </div><!-- /.col-md-12 -->
                                            <div class="col-md-12">
                                                <input class="bg-gray text-dark" type="password" name="password" aria-required="true" aria-invalid="false" placeholder="Your Password" required>
                                            </div><!-- /.col-md-12 -->
                                            <div class="col-md-12 text-md-right">
                                                <input type="submit" value="Login">
                                            </div><!-- /.col-md-12 -->
                                            <div class="col-md-12 py-2 text-left">
                                                <a class="text-left text-black font-weight-light underlined-onhover cursor-pointer">Don't have an account? <a href="{{URL('/business')}}" class="text text-secondary underlined-onhover cursor-pointer">Register.</a></a>
                                            </div>
                                        </div><!-- /.row -->
                                    </form>
                                </div><!-- /.contact-form -->

                            </div><!-- /.lqd-column-inner -->

                        </div><!-- /.lqd-column col-md-5 -->
                    @endif

                </div><!-- /.row -->
            </div><!-- /.container -->

        </section>
        <section class="vc_row pt-25 pb-20 mb-80 bb-fade-black-005 mt-c-0 mt-sm-c-6 mt-xs-c-14">
            <div class="container">
                <div class="row d-flex flex-wrap align-items-center">

                    <div class="lqd-column col-md-3 col-xs-12 mb-4 mb-md-0 text-center text-md-left">

                        <a class="btn btn-naked btn-icon-left">
								<span>
									<span class="btn-txt">Joint Investment</span>
								</span>
                        </a>

                    </div><!-- /.lqd-column col-md-3 -->

                    <div class="lqd-column col-md-3 col-xs-12 mb-4 mb-md-0 text-center text-md-left">

                        <a class="btn btn-naked btn-icon-left">
								<span>
									<span class="btn-txt">Eligibility Scoring</span>
								</span>
                        </a>

                    </div><!-- /.lqd-column col-md-3 -->

                    <div class="lqd-column col-md-3 col-xs-12 mb-4 mb-md-0 text-center text-md-left">

                        <a class="btn btn-naked btn-icon-left">
								<span>
									<span class="btn-txt">Fast Matching Time</span>
								</span>
                        </a>

                    </div><!-- /.lqd-column col-md-3 -->

                    <div class="lqd-column col-md-3 col-xs-12 mb-4 mb-md-0 text-center text-md-left">

                        <a href="#" class="btn btn-naked btn-icon-left">
								<span>
									<span class="btn-txt">Multiple credit option</span>
								</span>
                        </a>

                    </div><!-- /.lqd-column col-md-3 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>
        <section class="vc_row pt-50 pb-70">

            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12 mb-4">

                        <header class="fancy-title text-center">
                            <h2 class="font-weight-bold">How it Works</h2>
                            <p>Here is a simple step-by-step guide explaining how owoafara works.</p>
                        </header>

                    </div><!-- /.lqd-column col-md-12 -->

                </div><!-- /.row -->
            </div><!-- /.container -->

            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12">

                            <div class="row" >

                                <div class="col-md-4 col-xs-12 py-5">

                                    <div class="iconbox text-center iconbox-shadow-hover iconbox-xl pt-40 pb-30 border-fade-black-005">
                                        <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container">
										<i class="icon-ion-ios-clipboard"></i>
									</span>
                                        </div><!-- /.iconbox-icon-wrap -->
                                        <div class="contents">
                                            <h3 class="font-weight-normal">Sign up</h3>
                                            <p>Create an account on the platform.</p>
                                            <br>
                                            <br>
                                        </div><!-- /.contents -->
                                    </div><!-- /.iconbox -->

                                </div>

                                <div class="col-md-4 col-xs-12 py-5">

                                    <div class="iconbox text-center iconbox-shadow-hover iconbox-xl pt-40 pb-30 border-fade-black-005">
                                        <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container">
										<i class="icon-ion-ios-search"></i>
									</span>
                                        </div><!-- /.iconbox-icon-wrap -->
                                        <div class="contents">
                                            <h3 class="font-weight-normal">Search For Businesses</h3>
                                            <p>View businesses and lend to your preferred business</p>
                                            <br>
                                        </div><!-- /.contents -->
                                    </div><!-- /.iconbox -->

                                </div>

                                <div class="col-md-4 col-xs-12 py-5">

                                    <div class="iconbox text-center iconbox-shadow-hover iconbox-xl pt-40 pb-30 border-fade-black-005">
                                        <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container">
										<i class="icon-ion-ios-sync"></i>
									</span>
                                        </div><!-- /.iconbox-icon-wrap -->
                                        <div class="contents">
                                            <h3 class="font-weight-normal">Match with Businesses</h3>
                                            <p>Match with SMEs easily to process loan credit</p>
                                            <br>
                                        </div><!-- /.contents -->
                                    </div><!-- /.iconbox -->

                                </div>

                            </div><!-- /.carousel-items row -->

                        <div class="col-md-12 text-center">
                            <a href="#" class="btn btn-default btn-sm border-none btn-register box-shadow-3">
                                    <span>
                                        <span class="btn-txt"> &nbsp; Sign Up Today &nbsp;</span>
                                    </span>
                            </a>
                        </div>
                    </div><!-- /.lqd-column col-md-12 -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </section>

        <section class="vc_row pt-90 pb-90">
            <div class="container">
                <div class="row d-flex flex-wrap">

                    <div class="lqd-column col-lg-7 col-md-6 mb-5 mb-md-0" data-custom-animations="true" data-ca-options='{"triggerHandler":"inview","animationTarget":"all-childs","duration":1200,"delay":160,"initValues":{"translateY":50,"opacity":0},"animations":{"translateY":0,"opacity":1}}'>

                        <header class="fancy-title mb-20">
                            <h2 class="mt-20 mb-1 font-weight-bold">About Rouzo</h2>
                            <br>
                            <p class="font-size-16">Rouzo is a portfolio managed platform that allows smart individual and corporate investors invest in portfolios that are you to provide financing for small businesses. Rouzo platform is owned by Owoafara Fintech services a financial technology company that builds platforms and tools to facilitate small business financing, support and growth
                                By investing on Rouzo, investors generate a healthy return and contribute to economic development by empowering small businesses to grow and expand.
                                Since Owoafara launched in November 2019, we have curated and verified over 300 small businesses for matching with financial institutions with our signature algorithm which we have further refined in the last 3 months.
                                With Rouzo, have are providing access to finance to these small businesses in the form of asset finance and working capital finance.
                                Our goal is to impact 1 million small businesses in the next 3 years.
                                <br><br> </p>

                        </header><!-- /.fancy-title -->

                        <a href="about.html" class="btn btn-naked btn-underlined">
                            <span>
                                <span class="btn-txt">Learn more &nbsp; <i class="icon-md-arrow-forward"></i></span>
                            </span>
                        </a>

                    </div><!-- /.col-lg-5 col-md-6 -->

                    <div class="lqd-column col-lg-5 col-md-5">

                        <div class="liquid-img-group-single stretch-to-right" data-shadow-style="4" data-roundness="4" data-inview="true" data-animate-shadow="true" data-reveal="true" data-reveal-options='{"direction":"rl","bgcolor":"rgb(25, 38, 47)"}'>
                            <div class="liquid-img-group-img-container">
                                <div class="liquid-img-container-inner">
                                    <figure>
                                        <div class="liquid-row-overlay bg-fade-dark-01 round"></div>
                                        <img src="https://images.unsplash.com/photo-1507537231947-f2ff14bc1554?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="Banner" />
                                    </figure>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.col-lg-6 col-md-5 col-md-offset-1 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>
        <section class="vc_row pt-50 pb-70">

            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12 mb-4">

                        <header class="fancy-title text-center">
                            <h2 class="font-weight-bold">Our Business loan benefits</h2>
                            <p>If you know which product you would like to apply for, choose one from below:</p>
                        </header>

                    </div><!-- /.lqd-column col-md-12 -->

                </div><!-- /.row -->
            </div><!-- /.container -->

            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12">

                        <div class="row" >

                            <div class="col-md-3 col-xs-12 py-5">

                                <div class="iconbox text-center iconbox-shadow-hover iconbox-xl pt-40 pb-30 border-fade-black-005">
                                    <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container">
										<i class="icon-ion-ios-hand"></i>
									</span>
                                    </div><!-- /.iconbox-icon-wrap -->
                                    <div class="contents">
                                        <p>Access to quality verified small businesses to lend to.</p>
                                        <br>
                                        <br>
                                    </div><!-- /.contents -->
                                </div><!-- /.iconbox -->

                            </div>

                            <div class="col-md-3 col-xs-12 py-5">

                                <div class="iconbox text-center iconbox-shadow-hover iconbox-xl pt-40 pb-30 border-fade-black-005">
                                    <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container">
										<i class="icon-ion-ios-business"></i>
									</span>
                                    </div><!-- /.iconbox-icon-wrap -->
                                    <div class="contents">
                                        <p>Multiple financial institutions in one place</p>
                                        <br>
                                        <br>
                                    </div><!-- /.contents -->
                                </div><!-- /.iconbox -->

                            </div>

                            <div class="col-md-3 col-xs-12 py-5">

                                <div class="iconbox text-center iconbox-shadow-hover iconbox-xl pt-40 pb-30 border-fade-black-005">
                                    <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container">
										<i class="icon-ion-ios-cash"></i>
									</span>
                                    </div><!-- /.iconbox-icon-wrap -->
                                    <div class="contents">
                                        <p>Best credit option for your business type.</p>
                                        <br>
                                        <br>
                                    </div><!-- /.contents -->
                                </div><!-- /.iconbox -->

                            </div>

                            <div class="col-md-3 col-xs-12 py-5">

                                <div class="iconbox text-center iconbox-shadow-hover iconbox-xl pt-40 pb-30 border-fade-black-005">
                                    <div class="iconbox-icon-wrap">
									<span class="iconbox-icon-container">
										<i class="icon-ion-ios-clock"></i>
									</span>
                                    </div><!-- /.iconbox-icon-wrap -->
                                    <div class="contents">
                                        <p>Fast and unbiased matching algorithm</p>
                                        <br>
                                        <br>
                                    </div><!-- /.contents -->
                                </div><!-- /.iconbox -->

                            </div>

                        </div><!-- /.carousel-items row -->

                        <div class="col-md-12 text-center">
                            <a href="#" class="btn btn-default btn-sm border-none btn-register box-shadow-3">
                                    <span>
                                        <span class="btn-txt"> &nbsp; Sign Up Today &nbsp;</span>
                                    </span>
                            </a>
                        </div>
                    </div><!-- /.lqd-column col-md-12 -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </section>


        <section class="vc_row pt-120 pb-90" style="background: rgba(29,30,31, 0.98);">
            <div class="container">
                <div class="row d-flex flex-wrap align-items-center">

                    <div class="lqd-column col-md-5 col-xs-12">

                        <div class="liquid-img-group-container">
                            <div class="liquid-img-group-inner">
                                <div class="liquid-img-group-single" data-roundness="6" data-reveal="true" data-reveal-options='{"direction":"tb","bgcolor":"rgb(70, 70, 70)"}'>
                                    <div class="liquid-img-group-img-container">
                                        <div class="liquid-img-group-content content-fixed-left">
                                            <p>Next-generation Investment.</p>
                                        </div><!-- /.liquid-img-group-content -->
                                        <div class="liquid-img-container-inner">
                                            <figure>
                                                <img src="https://images.unsplash.com/photo-1544725121-be3bf52e2dc8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1347&q=80" alt="Next-generation theme" />
                                            </figure>
                                        </div><!-- /.liquid-img-container-inner -->
                                    </div><!-- /.liquid-img-group-img-container -->
                                </div><!-- /.liquid-img-group-single -->
                            </div><!-- /.liquid-img-group-inner -->
                        </div><!-- /.liquid-img-group-container -->

                    </div><!-- /.lqd-column col-md-5 -->

                    <div class="lqd-column col-md-6 col-md-offset-1 col-xs-12">

                        <div class="ld-fancy-heading mb-30">
                            <h2 class="text-white font-weight-bold" data-text-rotator="true">
									<span class="ld-fh-txt">
										 Rouzo is a platform for
										<span class="txt-rotate-keywords">
											<span class="keyword active">Investors</span>
											<span class="keyword">Businesses</span>
										</span>
									</span>
                            </h2>
                        </div><!-- /.ld-fancy-heading -->

                        <div class="row">

                            <div class="lqd-column col-sm-12">

                                <p>Rouzo is a small business lending marketplace that allows smart individuals and corporates invest in portfolios that lend to micro and small businesses. They earn healthy returns while contributing to empowering small businesses and promoting economic development.

                                    These portfolios provide asset financing and working capital financing to verified small businesses that pass our eligibility criteria and pass the basic credit assessment provided by registered credit bureaus like CRC Bureau...<br><br> </p>

                            </div><!-- /.lqd-column col-sm-6 -->

                        </div><!-- /.row -->

                    </div><!-- /.lqd-column col-md-6 col-md-offset-1 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>
        <section id="contact" class="vc_row pt-130 pb-130">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-6">

                        <h2 class="h3 mt-0 mb-1">Contact us</h2>
                        <hr class="mb-40">

                        <div class="row mb-20">

                            <div class="lqd-column col-sm-6">

                                <p class="font-size-16 text-primary">Address</p>
                                <p class="font-size-15"> 7a, Milverton road, Ikoyi, <br>Lagos, Nigeria</p>

                            </div><!-- /.col-sm-6 -->

                            <div class="lqd-column col-sm-6">

                                <p class="font-size-16 text-primary">Call Us</p>
                                <p class="font-size-15"> 01-8198515, 01-8140499 <br> hello@rouzo.org</p>

                            </div><!-- /.col-sm-6 -->

                        </div><!-- /.row -->

                        <div class="ld-gmap-container" style="height: 280px;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.5615666835174!2d3.4425954153390905!3d6.450289425798251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf4e8b32cd023%3A0x7f3cfa141ea66fc7!2s7a%20Milverton%20Rd%2C%20Ikoyi%2C%20Lagos!5e0!3m2!1sen!2sng!4v1588276225326!5m2!1sen!2sng" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div><!-- /.ld-gmap-container -->

                    </div><!-- /.col-md-6 -->

                    <div class="lqd-column col-md-5 col-md-offset-1 text-center">

                        <div class="lqd-column-inner border-athens-gray pt-40 pb-35 px-5">

                            <h2 class="h3 mt-0 mb-1">Send a message</h2>
                            <p class="font-size-15 mb-35">Feel free to reach us if you need any assistance.</p>
                            @include('_partials.errors')
                            <div class="contact-form contact-form-inputs-filled contact-form-button-block">
                                <form action="{{URL('/contact')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input class="bg-athens-gray px-4" type="text" name="name" aria-required="true" aria-invalid="false" placeholder="Name" required>
                                        </div><!-- /.col-md-12 -->
                                        <div class="col-md-12">
                                            <input class="bg-athens-gray px-4" type="email" name="email" aria-required="true" aria-invalid="false" placeholder="Your Email address" required>
                                        </div><!-- /.col-md-12 -->
                                        <div class="col-md-12">
                                            <textarea class="bg-athens-gray px-4" cols="10" rows="4" name="message" aria-required="true" aria-invalid="false" placeholder="Message" value="" required></textarea>
                                        </div><!-- /.col-md-12 -->
                                        <div class="col-md-12">
                                            <input type="submit" value="SEND MESSAGE" class="font-size-14 ltr-sp-2">
                                        </div><!-- /.col-md-12 -->
                                    </div><!-- /.row -->
                                </form>
                                <div class="contact-form-result hidden"></div><!-- /.contact-form-result -->
                            </div><!-- /.contact-form -->

                        </div><!-- /.lqd-column-inner -->

                    </div><!-- /.lqd-column col-md-5 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>
    </main><!-- /#content.content -->
@stop
