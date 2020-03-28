<!DOCTYPE html>
<html lang="en">
@include('_partials.home._head') <!-- .head -->

    <body data-mobile-nav-trigger-alignment="right" data-mobile-nav-align="center" data-mobile-nav-style="minimal" data-mobile-nav-scheme="gray" data-mobile-header-scheme="gray" data-mobile-nav-breakpoint="1199">
        @yield('content')
        @include('_partials.home._footer')
        @include('_partials.home._foot')
    </body>
</html>
