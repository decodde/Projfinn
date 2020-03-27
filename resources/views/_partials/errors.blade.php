@foreach($errors->all() as $error)
    @if(Session::has('warning'))
        <div class="alert alert-warning alert-dismissable flat">
            @elseif(Session::has('danger'))
                <div class="alert alert-danger alert-dismissable flat">
                    @elseif(Session::has('info'))
                        <div class="alert alert-info alert-dismissable flat">
                            @elseif(Session::has('success'))
                                <div class="alert alert-success alert-dismissable flat">
                                    @else
                                        <div class="alert alert-success alert-dismissable flat">
                                            @endif
                                            <div class="container">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                {!! ucfirst($error) !!}
                                            </div>
                                        </div>
                                        @endforeach

                                        @if(isset($user) && $user->type == 'business')
                                            @if(!$user->business->cac)
                                                <div class="alert alert-warning flat">
                                                    Please upload your certificate of incorporation (CAC document) in the "edit bio" section of the dashboard to allow you match for borrowing.
                                                </div>
                                            @endif

                                            @if(\Session::has('completeProfilePrompt'))
                                                <div class="alert alert-warning flat">
                                                    Kindly complete your profile in the "edit bio" section of the dashboard to allow you match for borrowing.
                                                </div>
                                            @endif

                                            @if(\Session::has('eligibilityTestPrompt'))
                                                <div class="alert alert-info flat">
                                                    Please take your loan eligibility test to complete your profile.
                                                    <a href="{{ URL('dashboard/eligibility/'.\Crypt::encrypt($user->business->id)) }}" class="btn btn-xs btn-primary pull-right">Take test now</a>
                                                </div>
                                            @endif

                                            @if(\Session::has('creditAssessmentPrompt'))
                                                <div class="alert alert-info flat">
                                                    Please complete your credit assessments profile, to allow easy loan access with MFIs.
                                                    <a href="{{ URL('dashboard/credit-assessments/'.\Crypt::encrypt($user->business->id)) }}" class="btn btn-xs btn-primary pull-right">Credit assessment</a>
                                                    <br>
                                                </div>
                                            @endif

                                            @if(!Request::is('dashboard'))
                                                @if(\Session::has('profileCompletedPrompt'))
                                                    <div class="alert alert-info flat">
                                                        All credit assessment requirements are complete, you will be notified when you have been approved to be matched or documents complete <br> go back to the dashboard
                                                        <a href="{{ URL('dashboard/') }}" class="btn btn-xs btn-primary pull-right">Go to Dashboard</a>
                                                        <br>
                                                    </div>
                                            @endif
                                        @endif
    @endif
