@extends('_partials.dashboard.master')
@section('content')
    <div id="crypto-stats-3" class="row">
        <div class="col-xl-4 col-md-6 col-12">
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
        </div>
        <div class="col-xl-4 col-md-6 col-12">
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
                                <h6>₦ 0.00</h6>
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
        </div>

        <div class="col-xl-4 col-md-6 col-12">
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
                                <h6>₦ 0.00</h6>
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
    </div>
@stop
