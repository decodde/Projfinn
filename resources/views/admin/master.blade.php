<!DOCTYPE html>
<html lang="en" >
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
@include('_partials.admin._head')

<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- Header -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " >
    <div class="kt-header-mobile__logo">
        <a href="{{URL('/admin/rouzz')}}">
            Rouzo Admin
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>
<!-- End Header -->

<!-- Body -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        @include('_partials.admin._aside')

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- Header -->
            @include('_partials.admin._header')
            @include('_partials.errors')
            @yield('content')

            @include('_partials.admin._footer')
        </div>
    </div>
</div>

<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

@include('_partials.admin._foot')
</body>
</html>
