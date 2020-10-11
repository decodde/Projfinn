@extends('_containers.default')
@section('content')
    <div class="titlebar titlebar-md scheme-light text-center bg-center" style="background: linear-gradient( rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1528123778681-01e39b42808e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80'); background-position-y: top !important;background-size: auto; background-repeat: no-repeat">

        @include('_containers.header')

        <div class="titlebar-inner pt-120 pb-120">
            <div class="container titlebar-container">
                <div class="row titlebar-container">
                    <div class="titlebar-col col-md-8 col-md-offset-2">
                        <h1 data-fittext="true" data-fittext-options='{ "maxFontSize": 50, "minFontSize": 32 }' class="f-2">Wealth Builders Club.</h1>
                        <p style="opacity: 0.8">Join our wealth builders club; and get access to learning resources, impact- driven community of young <br>people and profit Yielding Investment options.</p>
                        <a class="titlebar-scroll-link" href="#content" data-localscroll="true"><i class="fa fa-angle-down"></i></a>
                    </div><!-- /.titlebar-col -->
                </div><!-- /.titlebar-row -->
            </div><!-- /.titlebar-container -->
        </div><!-- /.titlebar-inner -->

    </div><!-- /.titlebar -->
    <main id="content" class="content">
        <section class="vc_row pt-90 pb-20 text-center" style="background: linear-gradient(to bottom,  #f8fbff,  rgba(250, 251, 251, 0))">
            <div class="container">
                <div class="heading wow fadeInUp">
                    <span class="badge badge-success badge-pill wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Do you have financial goals?</span>
                    <h3 class="mt-0 font-weight-bold">We can help you achieve them!</h3>
                </div>
                <div class="text-center pb-30">
                    <p class="font-size-16">For most young people, Building wealth is usually not at the top of their mind because of the feeling that they have their entire lives ahead of them, therefore they still have plenty of time. However, this is the wrong kind of thinking, when it comes to building wealth, it’s never too early to start. In fact, the earlier you start the higher your chances of being really great at it.
                    </p>
                    <a href="{{URL('/r/cSpOpdArrT')}}" class="btn btn-default btn-sm round border-thin btn-register">
                                    <span>
                                        <span class="btn-txt">Start Saving Using Rouzo</span>
                                        <span class="icon-arrow-right-material pl-2"></span>
                                    </span>
                    </a>
                </div>

                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScidqj2kjzODG7AOFivAMQpxWBnA8Z7an0_6zkuQPWsAADxZQ/viewform?embedded=true" width="100%" height="1450px" frameborder="0" marginheight="0" marginwidth="0" onload="loaded()">Loading…</iframe>
            </div>
        </section>
    </main><!-- /#content.content -->

@stop
