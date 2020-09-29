@extends('_containers.default')
@section('content')
    @include('_containers.header')
    <style>
        body{
            color: #212529;
        }
    </style>
    <main id="content" class="content">
        <section class="vc_row d-flex flex-wrap align-items-center bg-cover pt-120 pb-20" data-parallax="true" data-parallax-options='{ "parallaxBG": true }'>

            <div class="container">
                <div class="row">

                    <div
                        class="lqd-column col-md-6"
                        data-custom-animations="true"
                        data-ca-options='{ "triggerHandler":"inview", "animationTarget":"all-childs", "duration":"1200", "delay":"150", "easing":"easeOutQuint", "direction":"forward", "initValues":{"translateY":60, "opacity":0}, "animations":{"translateY":0, "opacity":1} }'>
                        <div>
                            <div class="heading mb-0">
                                <span class="badge badge-success badge-pill">growth + impact</span>
                            </div>
                            <h1 class="pr-md-5 mt-0 mb-40" data-split-text="true" data-split-options='{"type":"lines"}'>Rouzo Empowering Women</h1>
                            <p class="font-size-16 lh-185 pr-md-7 mb-60" data-split-text="true" data-split-options='{"type":"lines"}'>At Owoafara, women businesses are important to us because we recognize the role of women in contributing to developing families and growing the economy</p>
                            <a href="{{URL('/business')}}" class="btn btn-default btn-sm border-none btn-register box-shadow-3 f-1 font-weight-light">
                            <span>
                                <span class="btn-txt"> &nbsp; Create A Business Account &nbsp;</span>
                            </span>
                            </a>
                        </div>


                    </div><!-- /.col-md-6 -->

                    <div class="lqd-column col-md-6 hidden-xs hidden-sm">
                        <ul class="collaborate-pic">
                            <li class=" wow fadeInUp">
                                <img src="https://images.unsplash.com/photo-1573496528013-454181200d92?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&h=800&q=80" alt="">
                            </li>
                            <li class=" wow fadeInUp">
                                <img src="https://images.unsplash.com/photo-1501633159663-1836f82ceaf0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1267&q=80" alt="">
                            </li>
                            <li class=" wow fadeInUp">
                                <img src="https://images.unsplash.com/photo-1527525443983-6e60c75fff46?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=632&q=80" alt="Join Other Investors" title="Join Other Investors">
                            </li>
                            <li class=" wow fadeInUp">
                                <img src="https://images.unsplash.com/photo-1573164573938-c9a3db2e84ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="">
                            </li>
                            <li class="pattern wow fadeInUp">
                                <img src="{{ asset('assets/assets/img/actual/desktop-pattern.svg') }}" alt="">
                            </li>
                        </ul>

                    </div><!-- /.col-md-6 hidden-xs hidden-sm -->

                </div><!-- /.row -->
            </div><!-- /.container -->

        </section>
        <section class="vc-row">
            <div class="container">
                <hr class="m-0">
            </div>
        </section>
        <section class="vc_row pt-90 pb-90 text-center" style="background: linear-gradient(to bottom,  #f8fbff,  rgba(250, 251, 251, 0))">
            <div class="container">
                <div class="heading wow fadeInUp">
                    <span class="badge badge-success badge-pill wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">why women?</span>
                    <h3 class="mt-0 font-weight-bold">We support women businesses</h3>
                </div>
                    <div class="row pb-40 pt-40">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="features-photos mt-3">
                                <div class="travel-about-ill-1">
                                    <img src="https://images.unsplash.com/photo-1573496267526-08a69e46a409?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1349&h=1300&q=80" class="border-radius-4" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-5 mt-md-0 col-md-offset-1">
                            <div class="text-left">
                                <h4 class="mt-0 mb-1 font-size-24 font-weight-bold">Did you say HOW?</h4>
                                <br>
                                <p class="font-size-16">At Owoafara, women businesses are important to us because we recognize the role of
                                    women in contributing to developing families and growing the economy.
                                    <br>
                                    <br>
                                    In Nigeria alone, over 49% of the population are female and there is a rising number of
                                    women who are female bread winners, single parent and single income families. 26% of
                                    these women are in the service sector and are involved in varying trades which is makes up
                                    about 25million woman in Nigeria alone.
                                    <br>
                                    <br>
                                    We want to fuel the entrepreneurial spirit of the African woman.
                                    <br>
                                    <br>
                                    As a female founded Company, we also understand how women relate with finance and we
                                    are especially committed to helping women who are majorly underserved get access to
                                    loans and business support to grow.
                                   </p>
                                <a href="{{URL('/business')}}" class="btn btn-default btn-sm round border-thin btn-register">
                                    <span>
                                        <span class="btn-txt">Sign Up as a Business</span>
                                        <span class="icon-arrow-right-material pl-2"></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row content-bottom text-left pt-60">
                        <div class="col-desc col-lg-6 col-md-8 col-sm-12">
                            <div class="">
                                <h3 class="font-size-24 font-weight-bold">Our Women Trader Program</h3>
                                <p class="text-gray">Most women traders fall in the under-served and under-banked segment of the SME
                                    economy because they are semi-illiterate. They are also not very technology savvy.
                                    However they are hard working women who are fuelling our informal economy by
                                    providing essential goods and services.
                                    <br>
                                    <br>
                                    This program will bring access to finance closer to them working with the women leaders
                                    in the over 1000 major community markets in the country.
                                    <br>
                                    <br>
                                    If you are a woman leader in a market location or offer complimentary products to women
                                    traders, you are welcome to sign up as an introducer to help women traders get access to
                                    working capital to grow their business.
                                </p>
                                <a href="{{URL('/introducer')}}" class="btn btn-default btn-sm round border-thin btn-register">
                                    <span>
                                        <span class="btn-txt">Sign Up as an Introducer</span>
                                        <span class="icon-arrow-right-material pl-2"></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="col-ill col-lg-6 col-md-6 mt-5 mt-md-0 col-sm-12">
                            <div class="features-photos wow fadeInUp">
                                <div class="travel-about-ill-2">
                                    <img src="{{ asset('assets/assets/img/actual/Nigerian-Market.jpg') }}" class="border-radius-5" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="vc_row pt-60 pb-65">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12 text-center mb-35">

                        <h3 class="mt-0 font-weight-bold">Testimonials</h3>

                    </div><!-- /.lqd-column col-md-12 -->
                    <div class="lqd-column col-md-6">

                        <div class="testimonial testimonial-quote-filled text-left testimonial-details-lg testimonial-quote-shadowed">
                            <div class="testimonial-quote">
                                <blockquote>
                                    <p class="font-size-16 lh-2">“I loved the customer service you guys provided me. That was very nice and patient with questions I had. I would really like definitely come back here”</p>
                                </blockquote>
                            </div><!-- /.testimonial-quote -->
                            <div class="testimonial-details">
                                <figure class="avatar ">
                                    <img src="assets/demo/testimonials/testi-11.jpg" alt="Caleb Cruz">
                                </figure>
                                <div class="testimonial-info">
                                    <h5>Yewande Oyewo</h5>
                                    <h6 class="font-weight-normal">Famous Five Caterers</h6>
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

        <section class="vc_row pt-50 pb-65">
            <div class="container">
                <div class="row d-flex flex-wrap align-items-start">

                    <div class="lqd-column col-lg-7 col-md-7">

                        <div class="liquid-img-group-single pr-md-7">
                            <figure>
                                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" class="border-radius-5" >
                            </figure>
                        </div><!-- /.liquid-img-group-single -->

                    </div><!-- /.col-lg-7 col-md-6 -->

                    <div
                        class="lqd-column col-lg-5 col-md-5 mt-5 mt-md-0 "
                        data-custom-animations="true"
                        data-ca-options='{"triggerHandler":"inview","animationTarget":"all-childs","duration":"1200","startDelay":"350","delay":"150","easing":"easeOutQuint","direction":"forward","initValues":{"translateY":28,"opacity":0},"animations":{"translateY":0,"opacity":1}}'
                    >
                        <h2 class="font-weight-bold mt-0"> Get a free business assessment on SUPPOTR </h2>
                        <p class="text-gray">
                            As a woman, you need to be on top of your business performance. Take our free business
                            assessment quiz on suppotr and get to know how your business is doing.
                            <br>
                            <br>
                        </p>
                        <a href="https://suppotr.owoafara.com" target="_blank" class="btn btn-default btn-sm round border-thin btn-register">
                            <span>
                                <span class="btn-txt">Take a free business assessment</span>
                                <span class="icon-arrow-right-material pl-2"></span>
                            </span>
                        </a>
                    </div><!-- /.col-lg-5 col-md-6 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

        <div class="faq-question pt-30 pb-50">
            <div class="heading text-center">
                <h3 class="text-black text-center">Need help making a credit decision?</h3>
                <p class="text-gray mt-16 mb-0">Let us guide you on how much your business needs.</p>
            </div>
            <div class="row text-center d-flex flex-wrap justify-content-center mt-4">
                <div class="col-lg-2 col-md-12 col-sm-12 p-3">
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
                <div class="col-lg-2 col-md-12 col-sm-12 p-3">
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
