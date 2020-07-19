@extends('_partials.dashboard.master')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Home</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Home
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div id="crypto-stats-3" class="row">
        <div class="col-md-4">
            <div class="card crypto-card-3 pull-up" title="This is the total money you have in your stash. You can transfer it to invest in a fund">
                <div class="card-content">
                    <div class="card-body position-relative" style="padding-bottom: 0;">
                        <div class="row">
                            <div class="col-2">
                                <h1 style="margin-top: -10px"><i class="icon-ion-ios-business success darken-4 font-size-40px" title="Wallet"></i></h1>
                            </div>
                            <div class="col-8 pl-1">
                                <h6 class="font-weight-normal pt-0 success darken-4" style="margin-top: 6px">Businesses</h6>
                                <p>Businesses that have signed up with your link</p>
                            </div>
                            <div class="col-2 text-right">
                                <h6>{{$invitesAccepted}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas id="btc-chartjs" class="height-50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card crypto-card-3 pull-up" title="This is the total money you have in your stash. You can transfer it to invest in a fund">
                <div class="card-content">
                    <div class="card-body position-relative" style="padding-bottom: 0;">
                        <div class="row">
                            <div class="col-2">
                                <h1 style="margin-top: -10px"><i class="icon-ion-ios-share blue-grey lighten-1 font-size-40px" title="Wallet"></i></h1>
                            </div>
                            <div class="col-8 pl-1">
                                <h6 class="font-weight-normal pt-0 blue-grey lighten-1" style="margin-top: 6px">Pending Invites</h6>
                                <p>Invites sent that are still pending </p>
                            </div>
                            <div class="col-2 text-right">
                                <h6>{{$invitesPending}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas id="eth-chartjs" class="height-50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card crypto-card-3 pull-up" title="This is the total money you have in your stash. You can transfer it to invest in a fund">
                <div class="card-content">
                    <div class="card-body position-relative" style="padding-bottom: 0;">
                        <div class="row">
                            <div class="col-2">
                                <h1 style="margin-top: -10px"><i class="icon-ion-ios-cash info lighten-1 font-size-40px" title="Wallet"></i></h1>
                            </div>
                            <div class="col-6 pl-1">
                                <h6 class="font-weight-normal pt-0 info lighten-1" style="margin-top: 6px">Earnings</h6>
                                <p>Earnings made from businesses </p>
                            </div>
                            <div class="col-4 text-right">
                                <h6 class="text-success">₦ 0.00 </h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas id="xrp-chartjs" class="height-50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="row">
        <div class="col-md-12">
            <div class="card px-1">
                <div class="card-header">
                    <h2 class="font-weight-normal font-size-22px f-2 m-0">Businesses</h2>
                </div>
                <div class="card-content">
                    <hr class="p-0 m-0">
                    <div class="card-body">
                        @if(count($invites) !== 0 )
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="borderless">
                                        <th>#</th>
                                        <th>Business Name</th>
                                        <th>Business Email Address</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="borderless">
                                    <?php $i=1 ?>
                                    @foreach($invites as $key => $invite)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$invite->businessName}}</td>
                                            <td>{{$invite->email}}</td>
                                            <td>
                                                @if($invite->hasSignUp)
                                                    <a class="btn btn-outline-success success btn-sm">
                                                        Confirmed
                                                    </a>
                                                @else
                                                    <a class="btn btn-outline-warning warning btn-sm">
                                                        Pending
                                                    </a>
                                                @endif
                                            </td>

                                            <td>{{App\Http\Helpers\Formatter::dataTime($invite->created_at)}}</td>

                                            <td>
                                                @if($invite->hasSignUp)
                                                    <a class="btn btn-primary white">View Details</a>
                                                @else
                                                    <a class="btn btn-danger white" href="javascript:void(0);" data-toggle="modal" data-target="#deleteInvite{{ $key + 1 }}">Delete Invitation</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <div id="deleteInvite{{ $key + 1 }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-sm">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <center>
                                                            <h5>Are you sure?</h5>
                                                            <p>This action can't be reversed.</p>

                                                            <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal">No</a>
                                                            <a href="{{ URL('introducer/invite/delete/'.\Crypt::encrypt($invite->id)) }}" class="btn btn-sm btn-primary">Yes</a>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++ ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$invites->links()}}
                            </div>
                        @else
                            <div class="text-center dotted-btn width-550">
                                None of the businesses you referred has created an account.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
