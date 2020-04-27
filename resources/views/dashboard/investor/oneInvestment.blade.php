@extends('_partials.dashboard.master')
@section('content')
    <style>
        .borderless th{
            border: none !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card px-2">
                <div class="card-header py-1 pt-3">
                    <h4 class="card-title d-flex align-items-center">
                        <a>
                            <i class="btn btn-icon btn-danger btn-lighten-4 border-0" style="padding: 5px 8px !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <polygon fill="#d2081f" opacity="0.3" points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168"/>
                                        <polygon fill="#d2081f" points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447"/>
                                        <path d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866" fill="#d2081f" opacity="0.3"/>
                                        <path d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z" fill="#d2081f" opacity="0.3"/>
                                    </g>
                                </svg>
                            </i>
                            <br>
                        </a>
                        <a class="blue-grey font-weight-bold darken-3 ml-2 font-size-20px">Working Capital Portfolio</a>
                    </h4>
                    <div class="heading-elements">

                        <ul class="list-inline mb-0 mt-2">
                            <li>
                                <a class="btn btn-info btn-lg font-size-14px text-white font-weight-bold btn-darken-3" style="padding: 14px 24px">Invest Now</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr class="borderless">
                                    <th class="text-light lighten-2 font-size-16px">Status</th>
                                    <th class="text-light lighten-2 font-size-16px">Reference</th>
                                </tr>
                                </thead>
                                <tbody class="borderless">
                                </tbody>
                            </table>
                        </div>
                        <div class="card-text">
                            <hr>
                            <dl class="row py-1">
                                <dt class="col-md-9 text-muted font-weight-normal" >Amount per Unit</dt>
                                <dd class="col-md-3 text-right font-size-16px font-weight-bold success darken-2">₦ 100, 000</dd>
                            </dl>
                            <dl class="row pb-1">
                                <dt class="col-md-9 text-muted font-weight-normal" >Return (%)</dt>
                                <dd class="col-md-3 text-right font-size-16px font-weight-bold success darken-2">10 %</dd>
                            </dl>
                            <hr class="pb-1">
                        </div>
                        <a href="#" class="btn btn-link info float-right">More Details <i class="ft-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
