@extends('_containers.default')
@section('content')
    <div class="titlebar titlebar-md scheme-light text-center bg-center" style="background: linear-gradient( rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1573497491208-6b1acb260507?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80'); background-position-y: top !important;background-size: auto; background-repeat: no-repeat">

        @include('_containers.header')

        <div class="titlebar-inner pt-120 pb-120">
            <div class="container titlebar-container">
                <div class="row titlebar-container">
                    <div class="titlebar-col col-md-8 col-md-offset-2">
                        <h1 data-fittext="true" data-fittext-options='{ "maxFontSize": 50, "minFontSize": 32 }' class="f-2">Frequently Asked Questions.</h1>
                        <a class="titlebar-scroll-link" href="#content" data-localscroll="true"><i class="fa fa-angle-down"></i></a>
                    </div><!-- /.titlebar-col -->
                </div><!-- /.titlebar-row -->
            </div><!-- /.titlebar-container -->
        </div><!-- /.titlebar-inner -->

    </div><!-- /.titlebar -->

    <main id="content" class="content">
        <section class="vc_row pt-50 pb-50 bb-gray">
            <div class="container">
                <div class="row">

                    <div class="lqd-column col-md-8 col-md-offset-2">

                        <header class="fancy-heading mb-5">
                            <h2>Investors</h2>
                        </header>

                        <div class="accordion accordion-tall accordion-body-underlined accordion-expander-lg accordion-active-color-primary" id="accordion-2" role="tablist">

                            <div class="accordion-item panel  active">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-1">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-panel-1" aria-expanded="true" aria-controls="accordion-collapse-panel-1">
                                            How secure is my information on the platform?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-panel-1" class="accordion-collapse collapse in" role="tabpanel" aria-labelledby="accordion-collapse-heading-1">
                                    <div class="accordion-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-2">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-2" aria-expanded="false" aria-controls="accordion-collapse-collapse-2">
                                            Can I invest along side other investors?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-2" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-2">
                                    <div class="accordion-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-2">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-2" aria-expanded="false" aria-controls="accordion-collapse-collapse-2">
                                            How do I monitor businesses I invest into?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-2" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-2">
                                    <div class="accordion-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-2">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-2" aria-expanded="false" aria-controls="accordion-collapse-collapse-2">
                                            How much interest can I earn from an investment?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-2" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-2">
                                    <div class="accordion-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            Does my investment earn interest daily?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            How fast can I invest in a Business?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                             <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            How safe is my Money?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->
                        </div><!-- /.accordion -->

                    </div><!-- /.lqd-column col-md-8 col-md-offset-2 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

        <section class="vc_row pt-50 pb-100">
    <div class="container">
        <div class="row">

            <div class="lqd-column col-md-8 col-md-offset-2">

                <header class="fancy-heading mb-5">
                    <h2>Businesses</h2>
                </header>

                <div class="accordion accordion-md accordion-title-bordered accordion-expander-right accordion-active-color-primary" id="accordion-6" role="tablist">

                    <div class="accordion-item panel active">
                        <div class="accordion-heading" role="tab" id="accordion-6-heading-1">
                            <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                <a class="" data-toggle="collapse" data-parent="#accordion-6" href="#accordion-6-panel-1" aria-expanded="true" aria-controls="accordion-6-panel-1">
                                    How fast can I get funding for my Business?
                                    <span class="accordion-expander">
													<i class="icon-arrows_circle_plus"></i>
													<i class="icon-arrows_circle_plus"></i>
												</span>
                                </a>
                            </h4>
                        </div><!-- /.accordion-heading -->
                        <div id="accordion-6-panel-1" class="accordion-collapse collapse in" role="tabpanel" aria-labelledby="accordion-6-heading-1">
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris niesi ut aliquip ex ea commodo consequat.sed do eiusmod tempor incididunt ut quis  labore et doliore magna aliqua.</p>
                            </div><!-- /.accordion-content -->
                        </div><!-- /.collapse -->
                    </div><!-- /.accordion-item -->

                    <div class="accordion-item panel">
                        <div class="accordion-heading" role="tab" id="accordion-6-heading-2">
                            <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-6" href="#accordion-6-collapse-2" aria-expanded="false" aria-controls="accordion-6-collapse-2">
                                    What next do I do if I am not Eligible on the Platform?
                                    <span class="accordion-expander">
													<i class="icon-arrows_circle_plus"></i>
													<i class="icon-arrows_circle_plus"></i>
												</span>
                                </a>
                            </h4>
                        </div><!-- /.accordion-heading -->
                        <div id="accordion-6-collapse-2" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-6-heading-2">
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris niesi ut aliquip ex ea commodo consequat.sed do eiusmod tempor incididunt ut quis  labore et doliore magna aliqua.</p>
                            </div><!-- /.accordion-content -->
                        </div><!-- /.collapse -->
                    </div><!-- /.accordion-item -->

                    <div class="accordion-item panel">
                        <div class="accordion-heading" role="tab" id="accordion-6-heading-3">
                            <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-6" href="#accordion-6-collapse-3" aria-expanded="false" aria-controls="accordion-6-collapse-3">
                                    Can Businesses Outside Nigeria also Invest?
                                    <span class="accordion-expander">
													<i class="icon-arrows_circle_plus"></i>
													<i class="icon-arrows_circle_plus"></i>
												</span>
                                </a>
                            </h4>
                        </div><!-- /.accordion-heading -->
                        <div id="accordion-6-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-6-heading-3">
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris niesi ut aliquip ex ea commodo consequat.sed do eiusmod tempor incididunt ut quis  labore et doliore magna aliqua.</p>
                            </div><!-- /.accordion-content -->
                        </div><!-- /.collapse -->
                    </div><!-- /.accordion-item -->

                </div><!-- /.accordion -->

            </div><!-- /.lqd-column col-md-8 col-md-offset-2 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
    </main><!-- /#content.content -->
@stop
