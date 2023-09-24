
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#3ed2a7">

    <link rel="shortcut icon" href="{{ asset('assets/app-assets/images/adobe/logo.png') }}" />
    <title>{{ isset($title) ? "Rouzo - ".$title : "Rouzo" }}</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto%7cRubik:300,400" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/liquid-icon/liquid-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/theme-vendors.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/themes/mobile.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/themes/opus-2.css') }}" />

    <!-- Head Libs -->
    <script async  href="{{ asset('assets/vendors/modernizr.min.js') }}"></script>
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
        <script>
        var loadCounter = 0;
        var loaded = function() {
            loadCounter += 1;
            if (loadCounter === 2) {
                $("iframe").attr("height", "500px");
                $(window).scrollTo(315,0)
            }
        }
    </script>
    <!-- End Facebook Pixel Code -->
    <script data-ad-client="ca-pub-9913184668842151" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
