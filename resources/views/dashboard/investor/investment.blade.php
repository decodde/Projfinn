@extends('_partials.dashboard.master')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Investments</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard/i')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Investment
                        </li>
                    </ol>
                </div>
            </div>
            <p class="m-0">Invest into portfolios of your choice.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row py-1" style="flex-wrap: nowrap; overflow-x: auto">
                @foreach($portfolios as $portfolio)
                    <div class="col-md-4 col-9">
                        <div class="card" style="border-radius: 10px">
                            <div class="card-header d-flex justify-content-between pb-0" style="border-radius: 10px">
                                <h4 class="card-title grey-blue font-weight-bold lighten-2">
                                    {{$portfolio->name}}
                                </h4>
                                <div class="float-right">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a>
                                                <i style="padding: 3px 5px !important;">
                                                    @if(strtolower($portfolio->name) !== "asset finance portfolio")
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <polygon fill="#d2081f" opacity="0.3" points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168"/>
                                                            <polygon fill="#d2081f" points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447"/>
                                                            <path d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866" fill="#d2081f" opacity="0.3"/>
                                                            <path d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z" fill="#d2081f" opacity="0.3"/>
                                                        </g>
                                                    </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#0f7bd4" opacity="0.3"/>
                                                                <polygon fill="#0f7bd4" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                                                            </g>
                                                        </svg>
                                                    @endif
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="card-text">
                                    <div class="d-flex">
                                        <div class="pr-1 grey-blue lighten-2">
                                            Annual Interest
                                            <i class="icon-ion-ios-trending-up "></i> :
                                        </div>
                                        <div class="font-size-14px font-weight-bold">
                                            <a class="font-size-16px font-weight-bold info darken-2">{{$portfolio->returnInPer}} % </a>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="pr-1 grey-blue lighten-2">Risk Level
                                            <i class="icon-ion-ios-warning"></i> :
                                        </div>
                                        <div class="font-size-14px font-weight-bold">
                                            <a class="font-size-15px font-weight-normal grey-blue lighten-2 text-capitalize">{{$portfolio->riskLevel}}</a>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="font-size-14px font-weight-bold grey-blue lighten-2">
                                            <a class="font-size-20px font-weight-bold success ">₦ {{App\Http\Helpers\Formatter::MoneyConvert($portfolio->amountPerUnit, "full")}} </a> per Unit
                                        </div>
                                    </div>
                                    <hr>
                                    @if($portfolio->isOpen == true)
                                        @if($portfolio->sizeRemaining == 0)
                                            <a class="btn btn-outline-blue-grey blue-grey float-right" disabled="disabled" style="cursor: not-allowed">Sold Out <i class="icon-ion-ios-close-circle-outline"></i></a>
                                        @else
                                            <a href="{{URL('/dashboard/i/investment/'.encrypt($portfolio->id))}}" class="btn btn-outline-info info float-right">Invest Now<i class="ft-arrow-right position-relative" style="top: 2px;margin-left: 6px; font-size: 15px"></i></a>
                                        @endif
                                    @else
                                        <a class="btn btn-outline-danger danger float-right" disabled="disabled" style="cursor: not-allowed">Closed <i class="icon-ion-ios-close-circle-outline"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card pb-1" style="border-radius: 10px">
                <div class="card-header" style="border-radius: 10px">
                    <h4 class="card-title">Investments</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if(count($investments) !== 0 )
                            <p>Clcik on the <code>View Full Details</code> button for complete information of a specific investment</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="borderless">
                                        <th>Portfolio Name</th>
                                        <th>Units Bought</th>
                                        <th>Interest So far</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="borderless">
                                    @foreach($investments as $investment)
                                        @php
                                        $i = 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <a class="grey-blue font-weight-bold lighten-2">{{$investment->portfolio->name}}</a>
                                            </td>
                                            <td>{{$investment->unitsBought}}</td>
                                            <td class="font-size-16px success darken-4">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->interstSofar, "full")}}</td>
                                            <td>{{App\Http\Helpers\Formatter::dataTime($investment->transaction->created_at)}} </td>
                                            <td>
                                                @if($investment->isOpen === "true")
                                                    @if($investment->isReady === false)
                                                    <a class="btn btn-blue border-0 box-shadow-2 text-white" href="javascript:void(0);" onclick="window.alert('Your invest will be matured after {{$investment->period}} months from Investment');">
                                                        @else
                                                    <a class="btn btn-blue border-0 box-shadow-2  text-white" href="javascript:void(0);" onclick="withdrawInv({{$investment}})">
                                                    @endif
                                                        Withdraw Funds
                                                    </a>
                                                @else
                                                        Investment Closed
                                                @endif
                                                <a class="btn btn-outline-info info ml-2" data-toggle="modal" data-target="#details{{$i}}">
                                                    View Full Details
                                                </a>
                                                <div id="details{{$i}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content px-2" style="border: none">
                                                            <div class="modal-header text-center align-items-center px-0" style="justify-content: normal; border-bottom: 1px solid #c6d4df">
                                                                <a>
                                                                    <i style="padding: 3px 5px !important;">
                                                                        @if(strtolower($portfolio->name) !== "asset finance portfolio")
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                                    <polygon fill="#d2081f" opacity="0.3" points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168"/>
                                                                                    <polygon fill="#d2081f" points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447"/>
                                                                                    <path d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866" fill="#d2081f" opacity="0.3"/>
                                                                                    <path d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z" fill="#d2081f" opacity="0.3"/>
                                                                                </g>
                                                                            </svg>
                                                                        @else
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                                    <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#0f7bd4" opacity="0.3"/>
                                                                                    <polygon fill="#0f7bd4" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                                                                                </g>
                                                                            </svg>
                                                                        @endif
                                                                    </i>
                                                                </a>
                                                                <div>
                                                                    <h6 class="font-size-16px grey-blue font-weight-bold lighten-2">{{$investment->portfolio->name}}</h6>
                                                                    <a class="info">{{App\Http\Helpers\Formatter::dataTime($investment->transaction->created_at)}}</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Amount: </dt>
                                                                    <dd class="success ml-1">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->amount, "full")}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Units Bought: </dt>
                                                                    <dd class="ml-1">{{$investment->unitsBought}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Lock Period: </dt>
                                                                    <dd class="ml-1"> {{$investment->period}} Months</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Payment Method: </dt>
                                                                    <dd class="ml-1"> {{$investment->paymentMethod}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Interest So Far: </dt>
                                                                    <dd class="success ml-1">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->interstSofar, "full")}}</dd>
                                                                </dl>
                                                                <dl class="row">
                                                                    <dt class="blue-grey darken-1">Return On Investment: </dt>
                                                                    <dd class="success ml-1">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->roi, "full")}}</dd>
                                                                </dl>
                                                            </div>
                                                            <div class="modal-footer" style="border-top: 1px solid #c6d4df">
                                                                <a data-dismiss="modal" class="text-center m-auto info" style="text-decoration: underline">Dismiss</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($investment->isCompleted == false)
                                                    <a class="btn btn-outline-warning warning ml-2" data-toggle="modal" data-target="#update{{$i}}">
                                                        Update Lock Period
                                                    </a>
                                                    <div id="update{{$i}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content px-2" style="border: none">
                                                            <div class="modal-header text-center align-items-center px-0" style="justify-content: normal; border-bottom: 1px solid #c6d4df">
                                                                <a>
                                                                    <i style="padding: 3px 5px !important;">
                                                                        @if(strtolower($portfolio->name) !== "asset finance portfolio")
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                                    <polygon fill="#d2081f" opacity="0.3" points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168"/>
                                                                                    <polygon fill="#d2081f" points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447"/>
                                                                                    <path d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866" fill="#d2081f" opacity="0.3"/>
                                                                                    <path d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z" fill="#d2081f" opacity="0.3"/>
                                                                                </g>
                                                                            </svg>
                                                                        @else
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                                    <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#0f7bd4" opacity="0.3"/>
                                                                                    <polygon fill="#0f7bd4" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                                                                                </g>
                                                                            </svg>
                                                                        @endif
                                                                    </i>
                                                                </a>
                                                                <div>
                                                                    <h6 class="font-size-16px grey-blue font-weight-bold lighten-2">{{$investment->portfolio->name}}</h6>
                                                                    <a class="info">{{App\Http\Helpers\Formatter::dataTime($investment->transaction->created_at)}}</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{URL('/investment/update')}}" method="POST" class="form-horizontal">
                                                                    <input name="_token" value="{{csrf_token()}}" type="hidden">
                                                                    <input type="hidden" name="investmentId" value="{{$investment->id}}">
                                                                    <p>Update the amount of months your investment is to be locked.</p>
                                                                    <div class="form-group">
                                                                        <label class="blue-grey darken-1" for="months">Lock Period(Months): </label>
                                                                        <select name="months" id="months" class="form-control">
                                                                            <option value="3">3 Months</option>
                                                                            <option value="6">6 Months</option>
                                                                            <option value="9">9 Months</option>
                                                                            <option value="12">12 Months</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <button class="btn btn-blue border-0 "><i class="icon-ion-ios-save"></i> Update Investment</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer" style="border-top: 1px solid #c6d4df">
                                                                <a data-dismiss="modal" class="text-center m-auto info" style="text-decoration: underline">Dismiss</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $i += 1;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center dotted-btn width-550">
                                You haven't Invested in any Portfolio yet
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="payOut" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="font-size-18px font-weight-bold">Withdrawal Option</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('/investment/transfer') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="investmentId" id="investmentId" value="">
                        <label for="int" class="mb-2">
                            <input type="radio" name="withdrawalOption" id="int" class="rads" value="interest">
                            Withdraw
                            <a class="text-blue">Interest</a>
                        </label>
                        <br>
                        <label for="int+inv">
                            <input type="radio" name="withdrawalOption" id="int+inv" class="rads" value="int+inv">
                            Withdraw
                            <a class="text-blue">Interest + Investment</a>
                        </label>

                        <div  class="dotted-btn width-90-per">
                            <p class="success mb-0 font-size-20px">₦ <a class="success font-size-20px" id="withAmt"> 0</a></p>
                        </div>
                    </div>
                    <p class="mx-1"><code>Note:</code> The money will be transfer to your <a href="{{URL('/dashboard/i/stash')}}">Stash</a> where it can be withdrawn from </p>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-sm btn-success">Confirm Withdrawal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
