
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#3ed2a7">

    <link rel="shortcut icon" href="{{ asset('assets/app-assets/images/adobe/logo.png') }}" />
    <title>{{ isset($title) ? "Projfinn - ".$title : "Projfinn" }}</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto%7cRubik:300,400" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/liquid-icon/liquid-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/theme-vendors.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/themes/opus-2.css') }}" />

    <!-- Head Libs -->
    <script async  href="{{ asset('assets/vendors/modernizr.min.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-169217379-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-169217379-1');
    </script>

</head>
