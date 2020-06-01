@extends('_partials.dashboard.master')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Referrals</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard/i')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Referrals
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header py-1">
                    <h5 class="card-title" style="font-size: 14px !important;">Referral Code</h5>
                </div>
                <hr class="mx-2 my-0">
                <div class="card-content" style="border-radius: 10px;">
                    <div class="card-body pb-1 pt-0" style="padding-top: 12px !important;">
                        @if($payedIn === false)
                            <div class="text-center dotted-btn">
                                Credit your wallet to refer friends
                                <br>
                                <a href="{{URL('dashboard/i/stash')}}" class="btn btn-success mr-1 btn-md mt-2">credit your wallet <i class="fa fa-plus"></i></a>
                            </div>
                        @else

                        <div class="row">
                            <div class="col-12">
                                <h5 class="font-weight-bold">{{$user->referralSlug}}</h5>
                                copy this code and share with your friends to register
                                <div class="row">
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="copyLink" value="{{$user->referralLink.$user->referralSlug}}" disabled="disabled">
                                    </div>
                                    <div class="col-2 px-0">
                                        <button type="button" class="btn btn-icon btn-secondary mr-1" onclick="copyLink()"><i class="fa fa-copy"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header py-1">
                    <h4 class="card-title"  style="font-size: 14px !important;">Referral Performance</h4>
                </div>
                <hr class="mx-2 mt-0">
                <div class="card-content collapse show">
                    <div class="card-body pb-2">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <p class="blue-grey lighten-2 mb-0">Amount Per Referral (Naira)</p>
                                <h6 class="text-bold-400"><a class="blue-grey">₦ 2,000.00</a></h6>
                            </div>
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <p class="blue-grey lighten-2 mb-0">Number Of Referrals</p>
                                <h6 class="text-bold-400"><a class="blue-grey">{{count($signReferral)}} / 20</a></h6>
                            </div>
                            <div class="col-md-4 col-12 text-center">
                                <p class="blue-grey lighten-2 mb-0">Referral Payout</p>
                                <h6 class="text-bold-400"><a class="blue-grey">{{count($payedReferrals)}}</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card pb-1">
                <div class="card-header">
                    <h4 class="card-title">Payout</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if(count($payedReferrals) !== 0 )
                                This is the amount you have gained through referring friends.
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="borderless">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Amount Gained</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody class="borderless">
                                        <?php $i=1 ?>
                                        @foreach($payedReferrals as $payedReferral)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$payedReferral->user->name}}</td>
                                                <td>
                                                    <p class="font-size-17px success darken-4">
                                                        ₦ 2,000
                                                    </p>
                                                </td>

                                                <td>{{App\Http\Helpers\Formatter::dataTime($payedReferral->updatedAt)}}</td>

                                            </tr>
                                            <?php $i++ ?>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center dotted-btn width-550">
                                None of the people you referred has credited their wallets.
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyLink() {
            let copyText = document.querySelector("#copyLink");
            copyText.removeAttribute("disabled");
            copyText.select();
            document.execCommand("copy");
            copyText.setAttribute("disabled", true);
            // Messages.flashSuccess("Link Copied!");
            toastr.success('Link Copied');
        }
    </script>
@stop
