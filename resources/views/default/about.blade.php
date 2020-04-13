@extends('_containers.default')
@section('content')
    <div class="titlebar titlebar-md scheme-light text-center bg-center" style="background: linear-gradient( rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1573497491208-6b1acb260507?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80'); background-position-y: top !important;background-size: auto; background-repeat: no-repeat">

        @include('_containers.header')

        <div class="titlebar-inner pt-120 pb-120">
            <div class="container titlebar-container">
                <div class="row titlebar-container">
                    <div class="titlebar-col col-md-8 col-md-offset-2">
                        <h1 data-fittext="true" data-fittext-options='{ "maxFontSize": 50, "minFontSize": 32 }' class="f-2">How it Works.</h1>
                        <a class="titlebar-scroll-link" href="#content" data-localscroll="true"><i class="fa fa-angle-down"></i></a>
                    </div><!-- /.titlebar-col -->
                </div><!-- /.titlebar-row -->
            </div><!-- /.titlebar-container -->
        </div><!-- /.titlebar-inner -->

    </div><!-- /.titlebar -->

    <main id="content" class="content">
        <section class="vc_row pt-100 pb-100">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-6">

                        <h2 class="lh-125 pr-4 f-2 font-weight-normal" data-fittext="true" data-fittext-options='{ "compressor":0.5, "maxFontSize":"60" }'>Get Your Money Working</h2>

                        <div class="row">

                            <div class="lqd-column col-md-3">
                                <hr class="border-color-primary">
                            </div><!-- /.lqd-column col-md-3 -->

                            <div class="lqd-column col-md-9">

                                <p class="font-size-15 lh-2 mb-40">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation</p>

                                <a href="{{URL('/lender')}}" class="btn btn-default btn-sm round border-thin btn-register">
                                    <span>
                                        <span class="btn-txt">Invest Now</span>
                                    </span>
                                </a>

                            </div><!-- /.lqd-column col-md-9 -->

                        </div><!-- /.row -->

                    </div><!-- /.col-md-5 -->

                    <div class="lqd-column col-md-5 col-md-offset-1">

                        <div class="lqd-parallax-images-5">

                            <figure class="hidden-xs hidden-sm" data-parallax="true" data-parallax-from='{"translateY":125}' data-parallax-to='{"translateY":-95}' data-parallax-options='{"overflowHidden":false,"easing":"linear"}'>
                                <img src="https://images.unsplash.com/photo-1573496528013-454181200d92?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" alt="Parallax Image">
                            </figure>
                            <div class="txt-container bg-white py-4 px-md-3" data-parallax="true" data-parallax-from='{"translateY": -46}' data-parallax-to='{"translateY": -114}' data-parallax-options='{"overflowHidden":false, "ease":"linear","reverse":true,"triggerHook":"onEnter"}'>
                                <h2 class="my-0 font-size-35 lh-11">All you need to do is <span class="text-primary">investment</span></h2>
                            </div><!-- /.py-2 px-2 -->

                        </div><!-- /.lqd-parallax-images-5 -->

                    </div><!-- /.lqd-column col-md-5 col-md-offset-1 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

        <section class="pt-100 pb-50">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-sm-4 text-center">

                        <div class="liquid-counter liquid-counter-default liquid-counter-lg">
                            <div class="liquid-counter-element font-weight-light text-black" data-enable-counter="true" data-counter-options='{"targetNumber":"150,000+","blurEffect":true}' data-fittext="true" data-fittext-options='{"compressor": 0.65, "minFontSize": 50}'>
                                <span>150,000+</span>
                            </div><!-- /.liquid-counter-element -->
                            <span class="liquid-counter-text liquid-text-bottom font-size-20 text-black">Transactions</span>
                        </div><!-- /.liquid-counter -->

                    </div><!-- /.col-sm-4 -->

                    <div class="lqd-column col-sm-4 text-center">

                        <div class="liquid-counter liquid-counter-default liquid-counter-lg">
                            <div class="liquid-counter-element font-weight-light text-black" data-enable-counter="true" data-counter-options='{"targetNumber":"₦5 billion","blurEffect":true}' data-fittext="true" data-fittext-options='{"compressor": 0.65, "minFontSize": 50}'>
                                <span>₦5 billion+</span>
                            </div><!-- /.liquid-counter-element -->
                            <span class="liquid-counter-text liquid-text-bottom font-size-20 text-black">Lent</span>
                        </div><!-- /.liquid-counter -->

                    </div><!-- /.col-sm-4 -->

                    <div class="lqd-column col-sm-4 text-center">

                        <div class="liquid-counter liquid-counter-default liquid-counter-lg">
                            <div class="liquid-counter-element font-weight-light text-black" data-enable-counter="true" data-counter-options='{"targetNumber":"24","blurEffect":true}' data-fittext="true" data-fittext-options='{"compressor": 0.65, "minFontSize": 50}'>
                                <span>24</span>
                            </div><!-- /.liquid-counter-element -->
                            <span class="liquid-counter-text liquid-text-bottom font-size-20 text-black">Countries</span>
                        </div><!-- /.liquid-counter -->

                    </div><!-- /.col-sm-4 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

        <section class="vc_row pt-50 pb-65">
            <div class="container">
                <div class="row d-flex flex-wrap align-items-center">

                    <div class="lqd-column col-lg-6 col-md-6">

                        <div class="liquid-img-group-single stretch-to-left pr-md-7" data-shadow-style="4" data-roundness="2" data-inview="true" data-animate-shadow="true">
                            <div class="liquid-img-group-img-container">
                                <div class="liquid-img-container-inner">
                                    <figure>
                                        <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" class="opacity-1">
                                    </figure>
                                </div><!-- /.liquid-img-container-inner -->
                            </div><!-- /.liquid-img-group-img-container -->
                        </div><!-- /.liquid-img-group-single -->

                    </div><!-- /.col-lg-7 col-md-6 -->

                    <div
                        class="lqd-column col-lg-6 col-md-6 pt-2"
                        data-custom-animations="true"
                        data-ca-options='{"triggerHandler":"inview","animationTarget":"all-childs","duration":"1200","startDelay":"350","delay":"150","easing":"easeOutQuint","direction":"forward","initValues":{"translateY":28,"opacity":0},"animations":{"translateY":0,"opacity":1}}'
                    >

                        <header class="fancy-title mb-50">

                            <h2 class="mb-30" data-fittext="true" data-fittext-options='{ "compressor": 0.65, "maxFontSize": 60 }'>
                                <span class="f-2 font-weight-normal" style="color: #3d3d3d">A better financial pathway</span>
                            </h2>
                            <h3 class="font-size-18 lh-185 pr-7 mr-3"> Ut enim ad minim veniam, quis nostrud exercitation </h3>

                        </header><!-- /.fancy-title -->

                        <a href="{{URL('/lender')}}" class="btn btn-default btn-sm round border-thin btn-register">
                                    <span>
                                        <span class="btn-txt">Invest Now</span>
                                    </span>
                        </a>

                    </div><!-- /.col-lg-5 col-md-6 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

        <section class="vc_row pt-60 pb-65">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12 text-center mb-35">

                        <h3 class="mt-0"><span class="font-size-50 f-2">We got people talking</span></h3>

                    </div><!-- /.lqd-column col-md-12 -->
                    <div class="lqd-column col-md-6">

                        <div class="testimonial testimonial-quote-filled text-left testimonial-details-lg testimonial-quote-shadowed">
                            <div class="testimonial-quote">
                                <blockquote>
                                    <p class="font-size-16 lh-2">“I loved the customer service you guys provided me. That was very nice and patient with questions I had. I would really like definitely come back here”</p>
                                </blockquote>
                            </div><!-- /.testimonial-quote -->
                            <div class="testimonial-details">
                                <div class="testimonial-info">
                                    <h5>Tale Alimi</h5>
                                    <h6 class="font-weight-normal">Business Loan</h6>
                                </div><!-- /.testimonial-info -->
                            </div><!-- /.testimonial-details -->
                        </div><!-- /.testimonial -->

                    </div><!-- /.lqd-column col-md-6 -->

                    <div class="lqd-column col-md-6">

                        <div class="testimonial testimonial-quote-filled text-left testimonial-details-lg testimonial-quote-shadowed">
                            <div class="testimonial-quote">
                                <blockquote>
                                    <p class="font-size-16 lh-2">“I had a good experience with Owoafara Services. I am thankful to Owoafara for the help you guys gave my business. My loan was easy and fast. thank you”</p>
                                </blockquote>
                            </div><!-- /.testimonial-quote -->
                            <div class="testimonial-details">
                                <div class="testimonial-info">
                                    <h5>Jide Agbabiaka</h5>
                                    <h6 class="font-weight-normal">Business Loan</h6>
                                </div><!-- /.testimonial-info -->
                            </div><!-- /.testimonial-details -->
                        </div><!-- /.testimonial -->

                    </div><!-- /.lqd-column col-md-6 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

        <section class="vc_row pt-25 pb-80">

            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12 text-center mb-60">

                        <h3 class="mt-0"><span class="font-size-50 f-2">Our Partners</span></h3>

                    </div><!-- /.lqd-column col-md-12 -->

                    <div class="lqd-column col-md-12">
                        <div class="row">

                            <div class="lqd-column carousel-item col-md-12 text-center">
                                <div class="text-center">
                                    <img src="https://armtrustees.com/wp-content/uploads/2015/12/ARM-trustees.png" class="w-30 text-center" alt="Client">
                                </div>
                            </div>

                        </div><!-- /.carousel-items row -->

                    </div><!-- /.col-md-12 -->

                </div><!-- /.row -->
            </div><!-- /.container -->

        </section>

    </main><!-- /#content.content -->
@stop
