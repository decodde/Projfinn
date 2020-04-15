@extends('_partials.dashboard.master')
@section('content')
    <div id="crypto-stats-3" class="row">
        <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
                <div class="card-content">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-2">
                                <h1><i class="fa fa-money success darken-4" title="BTC"></i></h1>
                            </div>
                            <div class="col-5 pl-1">
                                <h5 class="font-weight-normal pt-0 success darken-4" style="margin-top: 10px;">Wallet</h5>
                                <h7 class="text-muted">Stash</h7>
                            </div>
                            <div class="col-5 text-right">
                                <h4>₦900,980</h4>
                            </div>
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
        <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
                <div class="card-content">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-2">
                                <h1><i class="fa fa-money blue-grey lighten-1" title="Fund"></i></h1>
                            </div>
                            <div class="col-5 pl-1">
                                <h5 class="font-weight-normal pt-0 blue-grey darken-1" style="margin-top: 10px;">Funds</h5>
                                <h7 class="text-muted">Invested Money</h7>
                            </div>
                            <div class="col-5 text-right">
                                <h4>₦1,460,000</h4>
                            </div>
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

        <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
                <div class="card-content">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-2">
                                <h1><i class="fa fa-money info lighten-1" title="ROI"></i></h1>
                            </div>
                            <div class="col-5 pl-1">
                                <h5 class="font-weight-normal pt-0 info" style="margin-top: 10px;">Total ROI</h5>
                                <h7 class="text-muted">Total return on Investment</h7>
                            </div>
                            <div class="col-5 text-right">
                                <h4>₦10,460,000</h4>
                            </div>
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
