@extends('_containers.default')
@section('content')
    @include('_containers.header')
    <style>
        .btn-login:hover{
            background-color: #fff;
        }
        .carousel-nav-light .flickity-button{
            border-color: #181b30;
            color: #181b30;
        }
        @media (min-width: 1200px){
            .xl-h-32 {
                height: 2rem !important;
            }
        }
        .h-24 {
            height: 1.5rem;
        }
    </style>
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
                        <h1
                            class="text-white mt-0 mb-30 font-weight-normal">Peer to peer financial services for the under banked
                        </h1>

                        <p class="font-size-14 lh-175 text-fade-white-07 pr-md-9 mr-md-9 mb-50">Support small businesses to grow and contribute to economic development.</p>

                        <a href="{{URL('/sign-up')}}" class="btn btn-default btn-sm border-none btn-register box-shadow-3 f-1 font-weight-light">
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
                        <div class="d-flex mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#fff" opacity="0.3"/>
                                    <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#fff"/>
                                </g>
                            </svg>
                             <span style="color: #fff; margin-left: 10px"> The site is secure by SSID security</span>
                        </div>

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
                            <p>Here is a simple step-by-step guide explaining how Rouzo works.</p>
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
                                            <h3 class="font-weight-normal">Search For Portfolio</h3>
                                            <p>View available portfolios</p>
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
                            <a href="{{URL('/sign-up')}}" class="btn btn-default btn-sm border-none btn-register box-shadow-3">
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
                            <p class="font-size-16">Rouzo is a portfolio managed platform that allows smart individual and corporate investors invest in portfolios that are used to provide financing for small businesses. Rouzo platform is owned by Owoafara Fintech services a financial technology company that builds platforms and tools to facilitate small business financing, support and growth.
                                By investing on Rouzo, investors generate a healthy return and contribute to economic development by empowering small businesses to grow and expand.
                                Since Owoafara launched in November 2019, we have curated and verified over 300 small businesses for matching with financial institutions with our signature algorithm which we have further refined in the last 3 months.
                                With Rouzo, we are providing access to finance to these small businesses in the form of asset finance and working capital finance.
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
                            <a href="{{URL('/sign-up')}}" class="btn btn-default btn-sm border-none btn-register box-shadow-3">
                                    <span>
                                        <span class="btn-txt"> &nbsp; Sign Up Today &nbsp;</span>
                                    </span>
                            </a>
                        </div>
                    </div><!-- /.lqd-column col-md-12 -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </section>

        <section class="vc_row pt-90 pb-55 mt-60 ">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12 text-center">

                        <header class="fancy-title text-center">
                            <h2 class="font-weight-bold">Testimonials</h2>
                            <p>We support undeserved small businesses</p>
                        </header>

                    </div><!-- /.col-md-12 -->

                    <div class="lqd-column col-md-8 col-md-offset-2">

                        <div class="carousel-container carousel-nav-floated carousel-nav-center carousel-nav-middle carousel-nav-xl carousel-nav-bordered carousel-nav-circle carousel-nav-light carousel-dots-style1">

                            <div class="carousel-items row" data-lqd-flickity='{ "cellAlign":"center","prevNextButtons":true,"buttonsAppendTo":"self","pageDots":false,"groupCells":true,"wrapAround":true,"pauseAutoPlayOnHover":false,"navArrow":{"prev":"<i class=\"fa fa-angle-left\"></i>","next":"<i class=\"fa fa-angle-right\"></i>"},"navOffsets":{"prev":"-100px","next":"-100px"}}'>

                                <div class="carousel-item col-xs-12">

                                    <div class="testimonial testimonial-xl text-center testimonial-details-sm testimonial-avatar-sm">
                                        <div class="testimonial-quote">
                                            <blockquote>
                                                <p><span style="font-size: 20px; line-height: 1.25em;color: #181b30;">“My investment with Rouzo has not been difficult, although I've had difficult times navigating through the platform where I had to make calls and I got a response and these issues were solved immediately. So far so good for me investing in Rouzo has been a very good one.
I only encourage them to keep up the good work but there is still room for improvement. Especially on the site i.e doing something that makes investors have the privilege to see their due date On-The-Go, maybe a form of coloration or mails to tell investors that your investment time is almost due
I look forward to continuing investing with Rouzo and I will keep encouraging people to invest with them
”</span></p>
                                            </blockquote>
                                        </div>
                                        <div class="testimonial-details">
                                            <div class="testimonial-info">
                                                <h5>Isioma Okolo</h5>
                                                <h6 class="font-weight-normal">Investor</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.carousel-item -->
                                <div class="carousel-item col-xs-12">

                                    <div class="testimonial testimonial-xl text-center testimonial-details-sm testimonial-avatar-sm">
                                        <div class="testimonial-quote">
                                            <blockquote>
                                                <p><span style="font-size: 20px; line-height: 1.25em;color: #181b30;">“When i was applying for a loan to purchase a delivery vehicle for my small business in a tough situation, my conventional banks said they couldn't help me.Rouzo sat down with me, heard my situation and decided that I was worth taking a chance on. Not many lenders would go to that length.”</span></p>
                                            </blockquote>
                                        </div>
                                        <div class="testimonial-details">
                                            <figure class="avatar ">
                                                <img src="{{ asset('assets/assets/img/testimonials/client3.png') }}" alt="Mr Umem Eyo">
                                            </figure>
                                            <div class="testimonial-info">
                                                <h5>Mr Umem Eyo</h5>
                                                <h6 class="font-weight-normal">Custodian Biz Solutions.</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.carousel-item -->
                                <div class="carousel-item col-xs-12">

                                    <div class="testimonial testimonial-xl text-center testimonial-details-sm testimonial-avatar-sm">
                                        <div class="testimonial-quote">
                                            <blockquote>
                                                <p><span style="font-size: 20px; line-height: 1.25em;color: #181b30;">“At first, I was skeptical about joining the platform but since I have joined I have not had a reason to regret it.
Over the years of investing with Rouzo, has been eventful and wonderful although there have been times when there were disappointments but one thing I like about the Rouzo team is their quick response to client’s needs.
There was this one time where I was having issues with my stash balance it was annoying but upon putting a call to Tale the CEO, the issue was resolved immediately.
I encourage others to invest.
”</span></p>
                                            </blockquote>
                                        </div>
                                        <div class="testimonial-details">
                                            <div class="testimonial-info">
                                                <h5>Miss Sarah Ikekhua</h5>
                                                <h6 class="font-weight-normal">Investor</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.carousel-item -->
                                <div class="carousel-item col-xs-12">

                                    <div class="testimonial testimonial-xl text-center testimonial-details-sm testimonial-avatar-sm">
                                        <div class="testimonial-quote">
                                            <blockquote>
                                                <p><span style="font-size: 20px; line-height: 1.25em;color: #181b30;">“It was a very fast process, Immediately you meet all requirements that's all.”</span></p>
                                            </blockquote>
                                        </div>
                                        <div class="testimonial-details">
                                            <figure class="avatar ">
                                                <img src="{{ asset('assets/assets/img/testimonials/client2.jpg') }}" alt="Mr Ebenizer Olushola">
                                            </figure>
                                            <div class="testimonial-info">
                                                <h5>Mr Ebenizer Olushola</h5>
                                                <h6 class="font-weight-normal">Caris Megale</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.carousel-item -->
                                <div class="carousel-item col-xs-12">

                                    <div class="testimonial testimonial-xl text-center testimonial-details-sm testimonial-avatar-sm">
                                        <div class="testimonial-quote">
                                            <blockquote>
                                                <p><span style="font-size: 20px; line-height: 1.25em;color: #181b30;">“I got my rouzo loan so fast after meeting all the requirements, i was disbursed the same day my guarantor sent her details.”</span></p>
                                            </blockquote>
                                        </div>
                                        <div class="testimonial-details">
                                            <figure class="avatar ">
                                                <img src="{{ asset('assets/assets/img/testimonials/client1.jpg') }}" alt="Mrs Oyibo Yewande">
                                            </figure>
                                            <div class="testimonial-info">
                                                <h5>Mrs Oyibo Yewande</h5>
                                                <h6 class="font-weight-normal">Famous5 Caterers</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.carousel-item -->
                                <div class="carousel-item col-xs-12">

                                    <div class="testimonial testimonial-xl text-center testimonial-details-sm testimonial-avatar-sm">
                                        <div class="testimonial-quote">
                                            <blockquote>
                                                <p><span style="font-size: 20px; line-height: 1.25em;color: #181b30;">“I am impressed with the services Owoafara is providing I have not had any difficulties, challenges, or disappointments using the platform or investing in Rouzo.
I will continue investing with Rouzo and I encourage people to invest with them.”</span></p>
                                            </blockquote>
                                        </div>
                                        <div class="testimonial-details">
                                            <div class="testimonial-info">
                                                <h5>Mrs. Abiodun Tukuru</h5>
                                                <h6 class="font-weight-normal">Investor</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.carousel-item -->


                            </div><!-- /.carousel-items -->

                        </div><!-- /.carousel-container -->

                    </div><!-- /.col-md-12 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>
        <section id="sponsor" class="vc_row pt-50 pb-70">
            <div class="container">
                <div class="row">
                    <div class="lqd-column col-md-12 text-center">

                        <header class="fancy-title text-center">
                            <h2 class="font-weight-bold">You are in good hands</h2>
                            <p>Some companies we partner with</p>
                        </header>

                    </div><!-- /.col-md-12 -->
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <ul class="list-unstyled d-flex flex-wrap xl-flex-no-wrap align-items-center justify-content-around">
                            <li class="w-50p xl-w-auto text-center mb-24 xl-mb-0 wow fadeInUp">
                                <a href="https://paystack.com/" target="_blank" title="Paystack">
                                    <img src="{{ asset('assets/assets/img/paystack.svg') }}" alt="Paystack" class="h-24 xl-h-32">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
                                <p class="font-size-15"> 07044152333 <br> hello@rouzo.org</p>

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
