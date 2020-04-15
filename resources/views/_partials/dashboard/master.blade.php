<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('_partials.dashboard.head')

<body class="vertical-layout vertical-content-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
    @include('_partials.dashboard.header')

    <div class="app-content content">

        <div class="content-wrapper">

            <div class="content-header row">
                @include('_partials.errors')
            </div>

            @if($user->type === 'business')
              @include('_partials.dashboard.sidebar')
            @else
               @include('_partials.dashboard.in_sidebar')
            @endif

            <div class="content-body">
                @yield('content')
            </div>

        </div>

    </div>

@include('_partials.dashboard.foot')
</body>
</html>
