<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-hide-on-scroll navbar-border navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="index.html">
                        <img class="brand-logo" alt="modern admin logo" src="https://tvcnews.tv/wp-content/uploads/2019/10/ARCON.jpg">
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
                                <p class="btn btn-danger my-0">Investor</p>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="mr-1">Hello,
                              <span class="user-name text-bold-700">{{$user->name}}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
