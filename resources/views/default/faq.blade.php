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
                            <h1 class="font-weight-bold">Investors</h1>
                        </header>

                        <div class="accordion accordion-tall accordion-body-underlined accordion-expander-lg accordion-active-color-primary" id="accordion-2" role="tablist">

                            <div class="accordion-item panel  active">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-1">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-panel-1" aria-expanded="true" aria-controls="accordion-collapse-panel-1">
                                            What is Rouzo?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-panel-1" class="accordion-collapse collapse in" role="tabpanel" aria-labelledby="accordion-collapse-heading-1">
                                    <div class="accordion-content">
                                        <p>The word Rouzo means Pathway.

                                            Rouzo is a small business lending marketplace that allows smart individuals and corporates invest in portfolios that lend to micro and small businesses. They earn healthy returns while contributing to empowering small businesses and promoting economic development.

                                            These portfolios provide asset financing and working capital financing to verified small businesses that pass our eligibility criteria and pass the basic credit assessment provided by registered credit bureaus like CRC Bureau.

                                            Rouzo only lends to small businesses that have been in existence for at least 2 years with a good business model and traceable cash flow. Rouzo will primarily lend for Asset finance and working capital finance from its portfolios designated for each item.

                                            As an investor on the Rouzo platform, your money is spread across a number of businesses to spread the risk in your chosen portfolio.

                                            Rouzo then manages the monthly repayments from the borrowers back to the investors. Rouzo also provides account management and reporting tools for investors. If payments are missed Rouzo's in-house collections and recoveries team will chase borrowers.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-2">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-2" aria-expanded="false" aria-controls="accordion-collapse-collapse-2">
                                            Who can invest in Rouzo?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-2" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-2">
                                    <div class="accordion-content">
                                        <p>You can lend through Rouzo as an individual and/or a corporate organization.

                                            <br>
                                            <p class="font-weight-bold">
                                                To lend as an individual, you must:
                                            </p>
                                            Be at least 18 years of age
                                            Have the legal rights to invest within Nigeria
                                            Have a bank account domiciled in Nigeria

                                            <p class="font-weight-bold">
                                                To lend as a corporate organization, you must:
                                            </p>
                                            Be a duly registered company in Nigeria
                                            Have an office presence in Nigeria
                                            Have a company account in Nigeria with all signatories based in country.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-2">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-2" aria-expanded="false" aria-controls="accordion-collapse-collapse-2">
                                            How secure is my information on the platform?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-2" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-2">
                                    <div class="accordion-content">
                                        <p>We ensure the protection of your information through recognized security procedures by the Data Protections Act.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-2">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-2" aria-expanded="false" aria-controls="accordion-collapse-collapse-2">
                                            Can I invest alongside other investors?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-2" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-2">
                                    <div class="accordion-content">
                                        <p>Yes you can, you may also invite others to benefit from the investment opportunities offered on Rouzo platform. You can take advantage of our referral program and earn when the people you referred with your code create an account and make their first investment.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            How do I monitor businesses I invest into?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>You can monitor your investment activities through your personalized dashboard on your registered account.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            How much interest can I earn from an investment?

                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>Depending on the portfolio type you’re investing in, you earn between 25% - 40% interest p.a.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            How does my interest accrue?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>You accrue interest on a monthly basis on Rouzo platform and you can view the summary of accumulated interest on your dashboard.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            When is my interest paid?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>Your accrued return can be seen monthly on your dashboard. You will get a payout of accumulated returns on a quarterly basis.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            What is the minimum and maximum investment period?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>The minimum investment period is 90days and the maximum is 360days. The longer your investment period the higher your returns.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            What is the minimum and maximum number of units I can invest in?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>The minimum number of units to invest in a portfolio is (1) and you can invest in as many units as you desire as long as there are units available in the portfolio. We usually limit units available for each portfolio per month to enable proper management of the portfolio.
                                        </p>
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
                                        <p>You can fund your wallet as soon as you create an account and invest in the portfolio of your choice. You will be notified of investment opportunities as soon as the portal opens monthly. You should always check your dashboard regularly for this information due to high demand.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            How safe is my money?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>Rouzo only lends to small businesses that have been in existence for at least 2 years with a good business model and traceable cash flow. We have an active in-house collections and recovery team to chase borrowers that default in repayment.

                                            We also, co-own the assets purchased for the businesses as collateral until loan is fully disbursed.

                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-22 font-weight-bold text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-2" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            What are the next steps after creating an account on the platform?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>Once you accept our terms and condition, you indicate your preference by purchasing as many units in a portfolio as you require, your investment journey begins immediately.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->
                        </div><!-- /.accordion -->

                    </div><!-- /.lqd-column col-md-8 col-md-offset-2 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>

{{--        <section class="vc_row pt-50 pb-100">
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
</section>--}}
    </main><!-- /#content.content -->
@stop
