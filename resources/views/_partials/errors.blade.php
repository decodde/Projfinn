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

<?php Session::forget('warning'); Session::forget('danger'); Session::forget('info'); Session::forget('success'); ?>


@if(isset($user) && $user->type == 'investor')
    @if($user->account() !== null)
        <div class="alert alert-warning flat">
            Please Verify Your Bank Account in your Dashboard <a href="{{'/dashboard/i/settings'}}">Settings</a>
        </div>
    @endif
@endif
