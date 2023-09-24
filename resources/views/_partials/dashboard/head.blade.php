<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ isset($title) ? env('APP_NAME') .' - '. $title : env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/app-assets/images/adobe/logo.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/fonts/meteocons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/core/menu/menu-types/vertical-content-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/fonts/simple-line-icons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/pages/timeline.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/liquid-icon/liquid-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/themes/opus-2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/flickity/flickity.min.css') }}" />
    <script async src="{{ asset('assets/assets/vendors/modernizr.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app-assets/css/plugins/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.4/numeral.min.js" ></script>
    <script src="{{ asset('assets/assets/vendors/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/assets/vendors/flickity/flickity.pkgd.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-71302918-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-71302918-3');
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2794217997524780');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=2794217997524780&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    <script data-ad-client="ca-pub-9913184668842151" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<style>
    .nav-item .kt-svg-icon g [fill]{
        fill: #8688b6;
    }

    .nav-item.open .kt-svg-icon g [fill]{
        fill: #2193dd;
    }
    .nav-item span{
        margin-top: 1px;
    }
    .green .kt-svg-icon g [fill]{
        fill: #28D094;
    }
    .info .kt-svg-icon g [fill]{
        fill: #2193dd;
    }
    .yellow .kt-svg-icon g [fill]{
        fill: #FF8942;
    }

</style>
