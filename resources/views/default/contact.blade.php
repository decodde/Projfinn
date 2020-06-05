@extends('_containers.default')
@section('content')
    <div class="titlebar titlebar-md scheme-light text-center bg-center pb-120" style="background: linear-gradient( rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1573497491208-6b1acb260507?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80'); background-position-y: top !important;background-size: auto; background-repeat: no-repeat">

        @include('_containers.header')
        <!-- /.main-header -->

        <div class="titlebar-inner pt-120 pb-120">
            <div class="container titlebar-container">
                <div class="row titlebar-container">
                    <div class="titlebar-col col-md-8 col-md-offset-2">
                        <h1 data-fittext="true" data-fittext-options='{ "maxFontSize": 50, "minFontSize": 32 }' class="f-2">Let's Talk.</h1>
                        <a class="titlebar-scroll-link" href="#content" data-localscroll="true"><i class="fa fa-angle-down"></i></a>
                    </div><!-- /.titlebar-col -->
                </div><!-- /.titlebar-row -->
            </div><!-- /.titlebar-container -->
        </div><!-- /.titlebar-inner -->

    </div><!-- /.titlebar -->

    <main id="content" class="content">

        <section class="vc_row">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-12 px-4 pt-45 pb-30 bg-white box-shadow-1 pull-up">

                        <div class="row d-flex flex-wrap align-items-center">

                            <div class="lqd-column col-md-6 col-md-offset-1">

                                <header class="fancy-title">
                                    <h2>Drop us a line</h2>
                                    <p>We are here to answer any question you may have</p>
                                </header><!-- /.fancy-title -->

                            </div><!-- /.lqd-column col-md-6 col-md-offset-1 -->

                            <div class="lqd-column col-md-4 hidden-sm hidden-xs text-right">

                                <div class="iconbox text-right iconbox-xl" data-animate-icon="true" data-plugin-options='{"resetOnHover":true,"color":"rgb(216, 219, 226)","hoverColor":"rgb(0, 0, 0)"}'>
                                    <div class="iconbox-icon-wrap">
											<span class="iconbox-icon-container">
												<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"> <polygon stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" points="1,30 63,1 23,41" /> <polygon stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" points="34,63 63,1 23,41" /> </svg>
											</span>
                                    </div><!-- /.iconbox-icon-wrap -->
                                </div><!-- /.iconbox -->
                            </div><!-- /.lqd-column col-md-4 hidden-sm hidden-xs -->

                        </div><!-- /.row -->

                        <div class="row">
                            @include('_partials.errors')
                            <div class="lqd-column col-md-10 col-md-offset-1">

                                <div class="contact-form contact-form-inputs-underlined contact-form-button-circle">
                                    <form action="{{URL('/contact')}}" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <div class="row d-flex flex-wrap">
                                            <div class="lqd-column col-md-6 mb-20">
                                                <input class="lh-25 mb-30" type="text" name="name" aria-required="true" aria-invalid="false" placeholder="Name" required>
                                                <input class="lh-25 mb-30" type="email" name="email" aria-required="true" aria-invalid="false" placeholder="Your email address" required>
                                            </div><!-- /.col-md-6 -->
                                            <div class="lqd-column col-md-6 mb-20">
                                                <textarea cols="10" rows="6" name="message" aria-required="true" aria-invalid="false" placeholder="Message" value="" required></textarea>
                                            </div><!-- /.col-md-12 -->
                                            <div class="lqd-column col-md-6">
                                                <p class="font-size-16 opacity-07"><em>We all know how important your information is. They are always safe with us.</em></p>
                                            </div><!-- /.col-md-6 -->
                                            <div class="lqd-column col-md-6 text-md-right">
                                                <input type="submit" value="Send message" class="font-size-13 ltr-sp-1 font-weight-bold">
                                            </div><!-- /.col-md-6 -->
                                        </div><!-- /.row -->
                                    </form>
                                    <div class="contact-form-result hidden"></div><!-- /.contact-form-result -->
                                </div><!-- /.contact-form -->

                            </div><!-- /.col-md-10 col-md-offset-1 -->

                        </div><!-- /.row -->

                    </div><!-- /.lqd-column col-md-12 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

        <section class="vc_row pt-90 pb-60">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-10 col-md-offset-1">

                        <div class="row">

                            <div class="lqd-column col-md-12 col-sm-12">

                                <h2 class="font-size-24 font-weight-bold"><small><i class="icon-liquid_map_pin mr-2 fa-1x"></i></small> Lagos</h2>
                                <p class="font-size-14"> 7a, Milverton road, Ikoyi, <br>Lagos, Nigeria</p>
                                <hr class="w-30 ml-0 border-color-primary">
                                <p class="font-size-14"> 07044152333 <br> hello@rouzo.org</p>

                                <div class="ld-gmap-container" style="height: 450px;">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.5615666835174!2d3.4425954153390905!3d6.450289425798251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf4e8b32cd023%3A0x7f3cfa141ea66fc7!2s7a%20Milverton%20Rd%2C%20Ikoyi%2C%20Lagos!5e0!3m2!1sen!2sng!4v1588276225326!5m2!1sen!2sng" height="450" frameborder="0" style="border:0; width: 100%" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div><!-- /.ld-gmap-container -->
                            </div><!-- /.lqd-column col-md-3 col-sm-8 -->

                        </div><!-- /.row -->

                    </div><!-- /.lqd-column col-md-10 col-md-offset-1 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

    </main><!-- /#content.content -->
@stop
