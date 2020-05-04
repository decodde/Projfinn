@extends('admin.master')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-widget17">
                    <div class="kt-widget17__stats dhsco-stats">
                        <div class="kt-widget17__items">
                            <div class="kt-widget17__item dhsco-cards">
                                <span class="kt-widget17__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg>
                                    <span class="dhsco-card-value">{{$NoOfUser}}</span>
                                </span>
                                <span class="kt-widget17__subtitle">
                                    Users
                                </span>
                            </div>

                            <div class="kt-widget17__item dhsco-cards">
                                <span class="kt-widget17__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <circle id="Oval-47" fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
                                            <rect id="Rectangle-162" fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
                                            <path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" id="Combined-Shape" fill="#000000"/>
                                        </g>
                                    </svg>
                                    <span class="dhsco-card-value">{{$NoOfInvestments}}</span>
                                </span>
                                <span class="kt-widget17__subtitle">
                                    Investments
                                </span>
                            </div>

                            <div class="kt-widget17__item dhsco-cards">
                                <span class="kt-widget17__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--warning">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M15,9 L13,9 L13,5 L15,5 L15,9 Z M15,15 L15,20 L13,20 L13,15 L15,15 Z M5,9 L2,9 L2,6 C2,5.44771525 2.44771525,5 3,5 L5,5 L5,9 Z M5,15 L5,20 L3,20 C2.44771525,20 2,19.5522847 2,19 L2,15 L5,15 Z M18,9 L16,9 L16,5 L18,5 L18,9 Z M18,15 L18,20 L16,20 L16,15 L18,15 Z M22,9 L20,9 L20,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,9 Z M22,15 L22,19 C22,19.5522847 21.5522847,20 21,20 L20,20 L20,15 L22,15 Z" id="Combined-Shape" fill="#000000"/>
                                            <path d="M9,9 L7,9 L7,5 L9,5 L9,9 Z M9,15 L9,20 L7,20 L7,15 L9,15 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                            <rect id="Rectangle-200" fill="#000000" opacity="0.3" x="0" y="11" width="24" height="2" rx="1"/>
                                        </g>
                                    </svg>
                                    <span class="dhsco-card-value">{{$NoOfPortfolios}}</span>
                                </span>
                                <span class="kt-widget17__subtitle">
                                    Portfolios
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Users
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table">
                        <thead class="font-weight-bolder">
                        <tr>
                            <th>Verified</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Account Number</th>
                            <th>BVN</th>
                            <th>Bank</th>
                        </tr>
                        </thead>
                        <tbody class="text-grey">
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @if($user->verified === 1)
                                        <i class="la la-check text-success font-weight-bolder"></i>
                                    @else
                                        <i class="la la-times font-weight-bolder"></i>
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->type == 'investor')
                                        <a class="btn btn-label-success text-success">
                                            @elseif($user->type == 'business')
                                                <a class="btn btn-label-danger text-danger">
                                                    @else
                                                        <a class="btn btn-label-primary text-primary">
                                                            @endif
                                                            {{$user->type}}
                                                        </a>
                                </td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->account->accountNumber ?? "null"}}</td>
                                <td>{{$user->account->bvn ?? "null"}}</td>
                                <td>{{$user->bank->name ?? "null"}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{$users->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
