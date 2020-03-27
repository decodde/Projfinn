<!DOCTYPE html>
<html lang="en">
@include('_partials._head') <!-- .head -->

    @if(Request::is('auth*'))
        <body  class="vertical-layout vertical-content-menu 1-column menu-expanded content-right-sidebar blank-page blank-page"
               data-open="click" data-menu="vertical-content-menu" data-col="1-column">
    @else
        <body>
    @endif
    @yield('content')
    @include('_partials._footer')
    @include('_partials._foot')
    </body>
</html>
