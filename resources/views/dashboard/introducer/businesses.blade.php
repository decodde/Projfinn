
@extends('_partials.dashboard.master')
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h5 class="content-header-title">Businesses</h5>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL('/dashboard/e')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Businesses
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
                    <h5 class="card-title" style="font-size: 14px !important;">Invite Code</h5>
                </div>
                <hr class="mx-2 my-0">
                <div class="card-content" style="border-radius: 10px;">
                    <div class="card-body pb-1 pt-0" style="padding-top: 12px !important;">
                        <div class="row">
                            <div class="col-12">
                                Share your invite Code with businesses
                                <div class="row">
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="copyLink" value="{{$inviteCode}}" disabled="disabled">
                                    </div>
                                    <div class="col-2 px-0">
                                        <button type="button" class="btn btn-icon btn-secondary mr-1" onclick="copyLink()"><i class="fa fa-copy"></i></button>
                                    </div>
                                </div>
                                <p>Or Share through social Media</p>
                                <div class="addthis_inline_share_toolbox" data-url="{{$inviteCode}}" data-title="Join Rouzo Now to Boost your Cash flow" data-description="Hey friend, check out this cool new platform that allows you boost your business cash flow" data-media="THE IMAGE"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header py-1">
                    <h4 class="card-title"  style="font-size: 14px !important;">Invite Performance</h4>
                </div>
                <hr class="mx-2 mt-0">
                <div class="card-content collapse show">
                    <div class="card-body pb-2">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <p class="blue-grey lighten-2 mb-0">Number Of Invites</p>
                                <h6 class="text-bold-400"><a class="blue-grey">{{count($invites)}}</a></h6>
                            </div>
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <p class="blue-grey lighten-2 mb-0">Invites Accepted</p>
                                <h6 class="text-bold-400"><a class="blue-grey">{{$invitesAccepted}}</a></h6>
                            </div>
                            <div class="col-md-4 col-12 text-center">
                                <p class="blue-grey lighten-2 mb-0">Invite Payout</p>
                                <h6 class="text-bold-400"><a class="blue-grey">₦ 0.00</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#inviteBusiness" class="btn btn-success mr-1 btn-md mb-2 float-right">Invite Business <i class="fa fa-plus"></i></a>
        </div>
    </div>
    <section class="row">
        <div class="col-md-12">
            <div class="card px-1">
                <div class="card-header">
                    <h2 class="font-weight-normal font-size-22px f-2 m-0">Invites</h2>
                    <p class="font-size-14px p-0 m-0 pt-1"><a class="font-size-14px pb-0 mb-0">Businesses you have invited</a></p>
                </div>
                <div class="card-content">
                    <hr class="p-0 m-0">
                    <div class="card-body">
                        @if(count($invites) !== 0 )
                            <p>
                            This is the list of people you referred
                            </p>
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
    <div id="inviteBusiness" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Invite Business</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ URL('introducer/invite') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="introducerId" value="{{ $introducer->id }}">

                        <div class="form-group">
                            <label for="businessName">Business Name</label>
                            <input type="text" name="businessName" id="businessName" class="form-control" required="required">
                        </div>

                        <div class="form-group">
                            <label for="email">Business Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-sm btn-success">Send Invite</button>
                    </div>
                </form>

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