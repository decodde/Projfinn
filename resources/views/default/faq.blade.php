@extends('_containers.default')
@section('content')
    <style>
        .accordion-title{
            font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
    </style>
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

                    <div class="lqd-column col-md-9 col-md-offset-2">

                        <header class="fancy-heading mb-5">
                            <h1 class="font-weight-bold">Investors</h1>
                        </header>

                        <div class="accordion accordion-tall accordion-body-underlined accordion-expander-lg accordion-active-color-primary" id="accordion-2" role="tablist">

                            <div class="accordion-item panel  active">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-1">
                                    <h4 class="accordion-title font-size-24 text-blue">
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
                                            <br/>
                                            <br/>

                                            These portfolios provide asset financing and working capital financing to verified small businesses that pass our eligibility criteria and pass the basic credit assessment provided by registered credit bureaus like CRC Bureau.
                                            <br/>
                                            <br/>
                                            Rouzo only lends to small businesses that have been in existence for at least 2 years with a good business model and traceable cash flow. Rouzo will primarily lend for Asset finance and working capital finance from its portfolios designated for each item.
                                            <br/>
                                            <br/>
                                            As an investor on the Rouzo platform, your money is spread across a number of businesses to spread the risk in your chosen portfolio.
                                            <br/>
                                            <br/>
                                            Rouzo then manages the monthly repayments from the borrowers back to the investors. Rouzo also provides account management and reporting tools for investors. If payments are missed Rouzo's in-house collections and recoveries team will chase borrowers.
                                            <br/>
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-2">
                                    <h4 class="accordion-title font-size-24 text-blue">
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
                                            - Be at least 18 years of age
                                            <br/>
                                            - Have the legal rights to invest within Nigeria
                                            <br/>
                                            - Have a bank account domiciled in Nigeria
                                            <br/>
                                            <p class="font-weight-bold">
                                                To lend as a corporate organization, you must:
                                            </p>
                                            - Be a duly registered company in Nigeria
                                            <br/>
                                            - Have an office presence in Nigeria
                                            <br/>
                                            - Have a company account in Nigeria with all signatories based in country.
                                            <br/>
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-3">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-3" href="#accordion-collapse-collapse-3" aria-expanded="false" aria-controls="accordion-collapse-collapse-3">
                                            How secure is my information on the platform?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-3" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-3">
                                    <div class="accordion-content">
                                        <p>We ensure the protection of your information through recognized security procedures by the Data Protections Act.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-4">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-4" href="#accordion-collapse-collapse-4" aria-expanded="false" aria-controls="accordion-collapse-collapse-4">
                                            Can I invest alongside other investors?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-4" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-4">
                                    <div class="accordion-content">
                                        <p>Yes you can, you may also invite others to benefit from the investment opportunities offered on Rouzo platform. You can take advantage of our referral program and earn when the people you referred with your code create an account and make their first investment.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-5">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-5" href="#accordion-collapse-collapse-5" aria-expanded="false" aria-controls="accordion-collapse-collapse-5">
                                            How do I monitor businesses I invest into?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-5" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-5">
                                    <div class="accordion-content">
                                        <p>You can monitor your investment activities through your personalized dashboard on your registered account.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-7">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-7" href="#accordion-collapse-collapse-7" aria-expanded="false" aria-controls="accordion-collapse-collapse-7">
                                            How much interest can I earn from an investment?

                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-7" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-7">
                                    <div class="accordion-content">
                                        <p>Depending on the portfolio type you’re investing in, you earn between 20% - 30% interest p.a.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-8">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-8" href="#accordion-collapse-collapse-8" aria-expanded="false" aria-controls="accordion-collapse-collapse-8">
                                            How does my interest accrue?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-8" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-8">
                                    <div class="accordion-content">
                                        <p>You accrue interest on a daily basis on Rouzo platform and you can view the summary of accumulated interest on your dashboard.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-9">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-9" href="#accordion-collapse-collapse-9" aria-expanded="false" aria-controls="accordion-collapse-collapse-9">
                                            When is my interest paid?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-9" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-9">
                                    <div class="accordion-content">
                                        <p>Your accrued return can be seen monthly on your dashboard. You will get a payout of accumulated returns into your wallet when your investment duration is complete. You can transfer the money from your wallet to your bank account.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-10">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-10" href="#accordion-collapse-collapse-10" aria-expanded="false" aria-controls="accordion-collapse-collapse-10">
                                            What is the minimum and maximum investment period?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-10" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-10">
                                    <div class="accordion-content">
                                        <p>The minimum investment period is 90days and the maximum is 360days. The longer your investment period the higher your returns. You can lock your investment for a specific duration i.e. 3 months, 6 months, 9 months and 12 months.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-11">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-11" href="#accordion-collapse-collapse-11" aria-expanded="false" aria-controls="accordion-collapse-collapse-11">
                                            What is the minimum and maximum number of units I can invest in?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-11" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-11">
                                    <div class="accordion-content">
                                        <p>The minimum number of units to invest in a portfolio is (1) and you can invest in as many units as you desire as long as there are units available in the portfolio. We usually limit units available for each portfolio per month to enable proper management of the portfolio.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-15">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-15" href="#accordion-collapse-collapse-15" aria-expanded="false" aria-controls="accordion-collapse-collapse-15">
                                            Can I break my investment before my due lock date?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-15" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-15">
                                    <div class="accordion-content">
                                        <p>You can apply to break your investment before your due lock date by sending an email to hello@rouzo.org with the headline break investment. When the email is received, the investment committee will meet and based on available cash flow, we will communicate when you can get your funds within1 week.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-15">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-15" href="#accordion-collapse-collapse-15" aria-expanded="false" aria-controls="accordion-collapse-collapse-15">
                                            Will I be penalized for breaking my investment?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-15" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-15">
                                    <div class="accordion-content">
                                        <p>There are no fees charged for breaking your investment, but your interest will revert back to the last quarter returns. What this means is if you invest your money for 12 months, but break it on the 10th month, your ROI will revert back to the 9th month. If you invest for 3 months and want to break it before then, you get no interest as the minimum investment duration is 3 months (90 days).
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-12">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-12" href="#accordion-collapse-collapse-12" aria-expanded="false" aria-controls="accordion-collapse-collapse-12">
                                            How fast can I invest in a Business?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-12" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-12">
                                    <div class="accordion-content">
                                        <p>You can fund your wallet as soon as you create an account and invest in the portfolio of your choice. You will be notified of investment opportunities as soon as the portal opens monthly. You should always check your dashboard regularly for this information due high demand.
                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-13">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-13" href="#accordion-collapse-collapse-13" aria-expanded="false" aria-controls="accordion-collapse-collapse-13">
                                            How safe is my money?
                                            <span class="accordion-expander">
                                                            <i class="icon-arrows_circle_plus"></i>
                                                            <i class="icon-arrows_circle_minus"></i>
                                                        </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-13" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-13">
                                    <div class="accordion-content">
                                        <p>Rouzo only lends to small businesses that have been in existence for at least 2 years with a good business model and traceable cash flow. We have an active in-house collections and recovery team to chase borrowers that default in repayment. <br><br>We also, co-own the assets purchased for the businesses as collateral until loan is fully disbursed.

                                        </p>
                                    </div><!-- /.accordion-content -->
                                </div><!-- /.collapse -->
                            </div><!-- /.accordion-item -->

                            <div class="accordion-item panel">
                                <div class="accordion-heading" role="tab" id="accordion-collapse-heading-14">
                                    <h4 class="accordion-title font-size-24  text-blue">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion-14" href="#accordion-collapse-collapse-14" aria-expanded="false" aria-controls="accordion-collapse-collapse-14">
                                            What are the next steps after creating an account on the platform as an Investor?
                                            <span class="accordion-expander">
                                                <i class="icon-arrows_circle_plus"></i>
                                                <i class="icon-arrows_circle_minus"></i>
                                            </span>
                                        </a>
                                    </h4>
                                </div><!-- /.accordion-heading -->
                                <div id="accordion-collapse-collapse-14" class="accordion-collapse collapse" role="tabpanel" aria-labelledby="accordion-collapse-heading-14">
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
    </main><!-- /#content.content -->
@stop
