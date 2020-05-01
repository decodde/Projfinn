@extends('_partials.dashboard.master')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Home</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Home
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div id="crypto-stats-3" class="row">
        <div class="col-md-12">
        <div class="carousel"
             data-flickity='{ "groupCells": true, "freeScroll": true, "cellAlign": "left", "randomVerOffset":true, "prevNextButtons":true,"buttonsAppendTo":"self","pageDots":false,"pauseAutoPlayOnHover":false}'>
            <div class="carousel-cell col-md-6">
                <div class="card bg-success bg-lighten-4" title="This is the total money you have in your stash. click on the 'credit your wallet button to credit your stash for investment' ">
                    <div class="card-content" style="border-radius: 10px;">
                        <div class="card-body pb-1 pt-0" style="padding-top: 12px !important;">
                            <h5 class="card-title" style="font-size: 18px !important; margin-bottom: 10px !important;">Credit Wallet </h5>
                            <div>
                                Top up the money in your stash
                                <br>
                                <a href="{{URL('dashboard/i/stash')}}" class="btn btn-success mr-1 btn-md mt-2">Credit your wallet <i class="la la-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-cell col-md-6">
                <div class="card bg-blue bg-lighten-4" title="This is the total money you have in your stash. click on the 'credit your wallet button to credit your stash for investment' ">
                    <div class="card-content" style="border-radius: 10px;">
                        <div class="card-body pb-1 pt-0" style="padding-top: 12px !important;">
                            <h5 class="card-title" style="font-size: 18px !important; margin-bottom: 10px !important;">Start Earning </h5>
                            <div>
                                Invest into our existing portfolios
                                <br>
                                <a href="{{URL('dashboard/i/investments')}}" class="btn btn-blue mr-1 btn-md mt-2">Invest now <i class="la la-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-header">
                        <h4 class="card-title">Profile</h4>
                    </div>
                    <hr class="mt-0 mx-1 p-0">
                    <div class="card-body pt-0">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-12 text-center">
                                <h4 class="text-bold-400 text-left"><a class="blue-grey">Net Worth</a></h4>
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card crypto-card-3 pull-up" title="This is the total money you have in your stash. You can transfer it to invest in a fund">
                <div class="card-content">
                    <div class="card-body position-relative" style="padding-bottom: 5px;">
                        <div class="row">
                            <div class="col-2">
                                <h1 style="margin-top: -10px"><i class="fa fa-money success darken-4 font-size-40px" title="Wallet"></i></h1>
                            </div>
                            <div class="col-4 pl-1">
                                <h6 class="font-weight-normal pt-0 success darken-4" style="margin-top: 6px">Stash</h6>
                            </div>
                            <div class="col-6 text-right">
                                <h6>₦ {{$balance}}</h6>
                            </div>
                        </div>
                        <div class="float-right bg-transparent position-absolute position-bottom-0">
                            <h7 class="text-muted mt-2">Available Money</h7>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas id="btc-chartjs" class="height-75"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card crypto-card-3 pull-up" title="This is the total money you have invested into portfolios">
                <div class="card-content">
                    <div class="card-body position-relative" style="padding-bottom: 5px;">
                        <div class="row">
                            <div class="col-2">
                                <h1 style="margin-top: -10px"><i class="fa fa-money blue-grey lighten-1 font-size-40px" title="Fund"></i></h1>
                            </div>
                            <div class="col-4 pl-1">
                                <h6 class="font-weight-normal pt-0 blue-grey darken-1" style="margin-top: 6px">Funds</h6>
                            </div>
                            <div class="col-6 text-right">
                                <h6>₦ {{$funds}}</h6>
                            </div>
                        </div>
                        <div class="float-right bg-transparent position-absolute position-bottom-0">
                            <h7 class="text-muted mt-2">Invested Money</h7>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas id="eth-chartjs" class="height-75"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card crypto-card-3 pull-up" title="This is the total return on investment you are to receive from your investments">
                <div class="card-content">
                    <div class="card-body position-relative" style="padding-bottom: 5px;">
                        <div class="row">
                            <div class="col-2">
                                <h1 style="margin-top: -10px"><i class="fa fa-money info lighten-1 font-size-40px" title="ROI"></i></h1>
                            </div>
                            <div class="col-4 pl-1">
                                <h6 class="font-weight-normal pt-0 info" style="margin-top: 6px">ROI</h6>
                            </div>
                            <div class="col-6 text-right">
                                <h6>₦ {{$roi}}</h6>
                            </div>
                        </div>
                        <div class="float-right bg-transparent position-absolute position-bottom-0">
                            <h7 class="text-muted mt-2">Return on Investment</h7>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas id="xrp-chartjs" class="height-75"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p style="opacity: 0" id="percentStash">{{$percents["stash"]}}</p>
        <p style="opacity: 0" id="percentFunds">{{$percents["funds"]}}</p>
    </div>
    <script>

        var percentFunds = document.getElementById('percentFunds').innerHTML;
        var percentStash = document.getElementById('percentStash').innerHTML;

        var options = {
            series: [parseInt(percentStash), parseInt(percentFunds)],
            colors: ["#1E9FF2", "#78909C"],
            labels: ['Stash', 'Investment'],
            dataLabels:{
                style: {
                    fontSize: '14px',
                    fontFamily: 'Nunito, sans-serif',
                    fontWeight: 100,
                    colors: ['#fff', '#fff']
                },
            },
            legend: {
                show: true,
                showForSingleSeries: false,
                showForNullSeries: true,
                showForZeroSeries: true,
                position: 'bottom',
                horizontalAlign: 'center',
                floating: false,
                fontSize: '14px',
                fontFamily: 'Nunito, sans-serif',
                fontWeight: 100,
                formatter: undefined,
                inverseOrder: false,
                width: undefined,
                height: undefined,
                tooltipHoverFormatter: undefined,
                offsetX: 0,
                offsetY: 0,
                labels: {
                    colors: undefined,
                    useSeriesColors: false
                },
                markers: {
                    width: 12,
                    height: 12,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 12,
                    customHTML: undefined,
                    onClick: undefined,
                    offsetX: 0,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 5,
                    vertical: 0
                },
                onItemClick: {
                    toggleDataSeries: true
                },
                onItemHover: {
                    highlightDataSeries: true
                },
            },
            chart: {
                type: 'donut',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 400
                    },
                    legend: {
                        position: 'right'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();



    </script>
@stop
