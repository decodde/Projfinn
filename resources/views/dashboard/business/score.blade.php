@extends('_partials.dashboard.master')
@section('content')

    <section class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-normal font-size-24px f-2 m-0">Eligibility</h2>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                @if($test == true)
                                    <a class="btn btn-sm btn-primary box-shadow-2 btn-min-width pull-right d-flex align-items-center text-white" href="#">
                                        <i class="la la-refresh"></i> <h4 class="font-size-14px text-white m-0 pl-1">Eligibility Test</h4>
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-primary box-shadow-2 btn-min-width pull-right d-flex align-items-center text-white" href="javascript:void(0);" onclick="window.alert('Eligibility score lasts a month, please wait another 30 days to retake test');">
                                        <i class="la la-refresh"></i> <h4 class="font-size-14px text-white m-0 pl-1">Eligibility Test</h4>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
{{--                <hr class="m-0">--}}
                <div class="card-content">
                    <div class="card-body px-4">
                        <div class="card-text">
                            <h1 class="display-1 text-center f-2" style="color:{{ $grade->color }}; font-size: 120px">{{ $grade->grade }}</h1>
                        </div>
                        <hr>
                        <div class="card-text">
                            <dl class="row text-black justify-content-center">
                                <dt class="col-md-5">
                                    <p class="font-size-18px">
                                        <strong>Your score</strong>
                                        <br>
                                        <a class="font-weight-normal font-size-16px">{{ $result->score }}</a>
                                    </p>
                                </dt>
                                <dd class="col-md-5">
                                    <p class="font-size-18px">
                                        <strong>Remark</strong>
                                        <br>
                                        <i class="font-weight-normal font-size-16px">{{ $grade->remark }}</i>
                                    </p>
                                </dd>
                            </dl>
                        </div>
                        <hr>
                        <div class="card-text">
                            <dl class="row text-black">
                                <dt class="col-md-9">What type of Company registration do you have?</dt>
                                <dd class="col-md-3 text-right">{{ $result->registrationStatus }}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">How long have you been in business?</dt>
                                <dd class="col-md-3 text-right">{{ $result->yearsOfRunning }}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Have you been paying or passing your business revenues in a bank account?</dt>
                                <dd class="col-md-3 text-right">{{ $result->lastBusinessRevenue }}</dd>
                            </dl>
                            <hr>
                            <dl class="row text-black">
                                <dt class="col-md-9">Was most of this money paid through a company account that can be verified?</dt>
                                <dd class="col-md-3 text-right">{{ $result->accountVerifiable }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop
