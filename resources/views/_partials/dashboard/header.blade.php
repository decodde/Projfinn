@if($user->type === 'business')
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-hide-on-scroll navbar-border navbar-shadow navbar-brand-center" style="border-bottom: 2px solid #18BE77">
@else
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-hide-on-scroll navbar-border navbar-shadow navbar-brand-center" style="border-bottom: 2px solid #FF4259">
@endif
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{URL('/')}}">
                        <img class="brand-logo" alt="modern admin logo" src="{{ asset('assets/app-assets/images/adobe/logo.png') }}" style="width: 80px;">
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            @if($user->type === 'business')
                                <p class="btn btn-success my-0" style="padding-top: 3px; padding-bottom: 3px;">Business</p>
                            @else
                                <p class="btn btn-danger my-0" style="padding-top: 3px; padding-bottom: 3px;">Investor</p>
                            @endif
                        </a>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">Hello,
                              <span class="user-name text-bold-700">{{$user->name}}</span>
                            </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{URL('logout')}}"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
