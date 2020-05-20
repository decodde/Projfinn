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
    <div class="carousel"
         data-flickity='{ "groupCells": true, "freeScroll": true, "cellAlign": "left", "randomVerOffset":true, "prevNextButtons":true,"buttonsAppendTo":"self","pageDots":false,"pauseAutoPlayOnHover":false}'>
        @foreach($portfolios as $portfolio)
            <div class="carousel-cell col-md-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">
                            <a>
                                @if(strtolower($portfolio->name) !== "asset finance portfolio")
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
                                @else
                                    <i class="btn btn-icon btn-info btn-lighten-4 border-0" style="padding: 5px 8px !important;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34px" height="34px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#0f7bd4" opacity="0.3"/>
                                                <polygon fill="#0f7bd4" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                                            </g>
                                        </svg>
                                    </i>
                                @endif
                                <br>
                            </a>
                        </h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a>
                                        @if($portfolio->riskLevel == "low")
                                            <i class="position-relative info"  style="top: 5px;">
                                        @else
                                            <i class="position-relative yellow"  style="top: 5px;">
                                        @endif
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" fill-rule="nonzero"/>
                                                    <path d="M19.5,10.5 L21,10.5 C21.8284271,10.5 22.5,11.1715729 22.5,12 C22.5,12.8284271 21.8284271,13.5 21,13.5 L19.5,13.5 C18.6715729,13.5 18,12.8284271 18,12 C18,11.1715729 18.6715729,10.5 19.5,10.5 Z M16.0606602,5.87132034 L17.1213203,4.81066017 C17.7071068,4.22487373 18.6568542,4.22487373 19.2426407,4.81066017 C19.8284271,5.39644661 19.8284271,6.34619408 19.2426407,6.93198052 L18.1819805,7.99264069 C17.5961941,8.57842712 16.6464466,8.57842712 16.0606602,7.99264069 C15.4748737,7.40685425 15.4748737,6.45710678 16.0606602,5.87132034 Z M16.0606602,18.1819805 C15.4748737,17.5961941 15.4748737,16.6464466 16.0606602,16.0606602 C16.6464466,15.4748737 17.5961941,15.4748737 18.1819805,16.0606602 L19.2426407,17.1213203 C19.8284271,17.7071068 19.8284271,18.6568542 19.2426407,19.2426407 C18.6568542,19.8284271 17.7071068,19.8284271 17.1213203,19.2426407 L16.0606602,18.1819805 Z M3,10.5 L4.5,10.5 C5.32842712,10.5 6,11.1715729 6,12 C6,12.8284271 5.32842712,13.5 4.5,13.5 L3,13.5 C2.17157288,13.5 1.5,12.8284271 1.5,12 C1.5,11.1715729 2.17157288,10.5 3,10.5 Z M12,1.5 C12.8284271,1.5 13.5,2.17157288 13.5,3 L13.5,4.5 C13.5,5.32842712 12.8284271,6 12,6 C11.1715729,6 10.5,5.32842712 10.5,4.5 L10.5,3 C10.5,2.17157288 11.1715729,1.5 12,1.5 Z M12,18 C12.8284271,18 13.5,18.6715729 13.5,19.5 L13.5,21 C13.5,21.8284271 12.8284271,22.5 12,22.5 C11.1715729,22.5 10.5,21.8284271 10.5,21 L10.5,19.5 C10.5,18.6715729 11.1715729,18 12,18 Z M4.81066017,4.81066017 C5.39644661,4.22487373 6.34619408,4.22487373 6.93198052,4.81066017 L7.99264069,5.87132034 C8.57842712,6.45710678 8.57842712,7.40685425 7.99264069,7.99264069 C7.40685425,8.57842712 6.45710678,8.57842712 5.87132034,7.99264069 L4.81066017,6.93198052 C4.22487373,6.34619408 4.22487373,5.39644661 4.81066017,4.81066017 Z M4.81066017,19.2426407 C4.22487373,18.6568542 4.22487373,17.7071068 4.81066017,17.1213203 L5.87132034,16.0606602 C6.45710678,15.4748737 7.40685425,15.4748737 7.99264069,16.0606602 C8.57842712,16.6464466 8.57842712,17.5961941 7.99264069,18.1819805 L6.93198052,19.2426407 C6.34619408,19.8284271 5.39644661,19.8284271 4.81066017,19.2426407 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                </g>
                                            </svg>
                                        </i>
                                        <span>
                                            @if($portfolio->riskLevel == "low")
                                                Low Risk
                                            @else
                                                Medium Risk
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title blue-grey font-weight-bold darken-3">{{$portfolio->name}}</h4>
                            <div class="card-text">
                                <hr>
                                <dl class="row pt-1">
                                    <dt class="col-md-6 text-muted font-weight-normal" >Amount per Unit</dt>
                                    <dd class="col-md-6 text-right font-size-16px font-weight-bold success darken-2">₦ {{App\Http\Helpers\Formatter::MoneyConvert($portfolio->amountPerUnit, "full")}}</dd>
                                </dl>
                                <dl class="row pb-1">
                                    <dt class="col-md-6 text-muted font-weight-normal" >Average Returns (%)</dt>
                                    <dd class="col-md-6 text-right font-size-16px font-weight-bold success darken-2">{{$portfolio->returnInPer}} %</dd>
                                </dl>
                                <hr class="pb-1">
                            </div>
                            @if($portfolio->sizeRemaining == 0)
                                <a class="btn btn-outline-info info" disabled="">Sold Out</a>
                            @else
                                <a href="{{URL('/dashboard/i/investment/'.encrypt($portfolio->id))}}" class="btn btn-outline-info info ">Invest Now<i class="ft-arrow-right position-relative" style="top: 2px;margin-left: 6px; font-size: 15px"></i></a>
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
            <div class="card pb-1">
                <div class="card-header">
                    <h4 class="card-title">Investments</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if(count($investments) !== 0 )
                            <p class="card-text">The <code>Payment Method</code> field shows the mode of payment that was done.<br>
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="borderless">
                                        <th>Portfolio Name</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Units Bought</th>
                                        <th>Return On Investment(P.A)</th>
                                        <th>Date</th>
                                        <th>Withdraw</th>
                                    </tr>
                                    </thead>
                                    <tbody class="borderless">
                                    @foreach($investments as $investment)
                                        <tr>
                                            <td>
                                                {{$investment->portfolio->name}}
                                            </td>
                                            <td>
                                                <p class="font-size-17px success darken-4">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->amount, "full")}}</p>
                                            </td>
                                            <td>
                                                @if($investment->paymentMethod === "bank")
                                                    <button type="button" class="btn mr-1 mb-1 btn-outline-danger btn-lighten-4 btn-sm">Bank</button>
                                                @else
                                                    <button type="button" class="btn mr-1 mb-1 btn-outline-success btn-sm">Stash</button>
                                                @endif

                                            </td>
                                            <td>{{$investment->unitsBought}}</td>
                                            <td class="font-size-17px success darken-4">₦ {{App\Http\Helpers\Formatter::MoneyConvert($investment->roi, "full")}}</td>

                                            <td>{{App\Http\Helpers\Formatter::dataTime($investment->transaction->created_at)}} </td>
                                            <td>
                                                @if($investment->isReady === false)
                                                <a class="btn btn-primary box-shadow-2 text-white" href="javascript:void(0);" onclick="window.alert('Your invest will be matured after 90days from Investment');">
                                                    @else
                                                <a class="btn btn-primary box-shadow-2  text-white">
                                                @endif
                                                        Withdraw Funds
                                                </a>

                                            </td>
                                        </tr>
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

@stop
