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
                                Share your Referral Code with friends
                                <div class="row">
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="copyLink" value="{{$user->referralLink.$user->referralSlug}}" disabled="disabled">
                                    </div>
                                    <div class="col-2 px-0">
                                        <button type="button" class="btn btn-icon btn-secondary mr-1" onclick="copyLink()"><i class="fa fa-copy"></i></button>
                                    </div>
                                </div>
                                <p>Or Share through social Media</p>
                                <div class="addthis_inline_share_toolbox" data-url="{{$user->referralLink.$user->referralSlug}}" data-title="Join Rouzo Now and Invest alongside Thousands of Investors" data-description="Hey friend, check out this cool new platform that allows you to invest in portfolios that finance small businesses and get healthy return" data-media="THE IMAGE"></div>
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
                                <h6 class="text-bold-400"><a class="blue-grey">₦ 1,000.00</a></h6>
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
                                This is the list of people you referred
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="borderless">
                                        <th>#</th>
                                        <th>Users name</th>
                                        <th>Made Payment</th>
                                        <th>Signed Up</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody class="borderless">
                                        <?php $i=1 ?>
                                        @foreach($referrals as $payedReferral)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$payedReferral->user->name}}</td>
                                                <td>
                                                    @if(@$payedReferral->hasPayed)
                                                        <p class="font-size-17px success darken-4">
                                                            This user has made a payment
                                                        </p>
                                                    @else
                                                        <p class="font-size-17px danger darken-4">
                                                            This user hasn't made a payment yet
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(@$payedReferral->hasSignUp)
                                                        <p class="font-size-17px success darken-4">
                                                            This user has singed up
                                                        </p>
                                                    @else
                                                        <p class="font-size-17px danger darken-4">
                                                            This user hasn't singed up
                                                        </p>
                                                    @endif
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
                                None of the people you referred has created an account.
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
