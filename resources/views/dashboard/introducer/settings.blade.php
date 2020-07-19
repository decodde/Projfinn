@extends('_partials.dashboard.master')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Settings</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard/e')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Settings
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="row">
        <div class="col-md-12">
            <div class="card px-1 py-1">
                <div class="card-header">
                    <h2 class="font-weight-normal font-size-22px f-2 m-0">Profile Settings</h2>
                    <p class="font-size-14px pt-1 pb-0 mb-0">Edit your profile details.</p>
                </div>
                <div class="card-content">
                    <hr class="m-0 p-0">

                    <div class="card-body">
                        <form action="{{ URL('account/edit') }}" method="POST">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="userId" value="{{ $user->id }}">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="">First Name :</label>
                                    <input type="text" name="f_name" id="f_name" class="form-control" value="{{ $user->f_name }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Last Name :</label>
                                    <input type="text" name="l_name" id="l_name" class="form-control" value="{{ $user->l_name }}" required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="">Phone Number :</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
                                </div>
                            </div>
                            <button type="submit" id="BVNBtn" class="btn btn-block btn-success width-150 float-right">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card px-1  py-1">
                <div class="card-header">
                    <h2 class="font-weight-normal font-size-22px f-2 m-0">Introducer Bank Details</h2>
                </div>
                <div class="card-content">
                    <hr class="m-0 p-0">

                    <div class="card-body">
                        @if($accountDetails !== null)
                            <form action="{{ URL('account/updateIntroducer') }}" method="POST" onsubmit="return checkNumberLength(event);" id="bvnForm">
                        @else
                            <form action="{{ URL('account/accountIntroducer') }}" method="POST" onsubmit="return checkNumberLength(event);" id="bvnForm">
                        @endif
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="userId" value="{{ $user->id }}">
                            {{--@if($accountDetails !== null)
                                <input type="hidden" name="dd" value="{{ encrypt($accountDetails->id) }}">
                            @endif--}}
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="">Account Number :</label>
                                    <input type="number" name="accountNumber" id="number" class="form-control" value="{{ $accountDetails->accountNumber ?? null }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">BVN :</label>
                                    <input type="number" name="bvn" id="bvn" class="form-control" value="{{ $accountDetails->bvn ?? null }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Bank  :</label>
                                    <select name="bankId" class="form-control text-uppercase">
                                    @foreach($banks as $bank)
                                        @if($accountDetails !== null && $bank->id == $accountDetails["bankId"])
                                            <option value="{{$bank->id}}" selected>
                                        @else
                                            <option value="{{$bank->id}}">
                                                @endif
                                                {{$bank->name}}
                                            </option>
                                        @endforeach

                                        </select>
                                    </div>
                                </div>
                                <button type="submit" id="BVNBtn" class="btn btn-block btn-primary width-150 float-right"><i class="fa fa-check"></i>&nbsp; Verify</button>
                            </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        function checkNumberLength(event) {
            event.preventDefault();
            let valid = false;

            const field = document.getElementById('number');
            // const bv = document.getElementById('bvn');
            if(field.value.length === 10) {
                // if(bv.value.length === 11 && field.value.length === 10) {
                valid = true;
            }
            else if ( field.value.length !== 10){
                valid = false;
                window.alert('Account Number can\'t be more or less than 10 characters long')
            }

            if(valid) {
                document.getElementById('bvnForm').submit()
            }
        }
    </script>
@stop
