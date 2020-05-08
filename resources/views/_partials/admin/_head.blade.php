<head>
    <meta charset="utf-8"/>
    <title>{{ isset($title) ? env('APP_NAME') .' - '. $title : env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/app-assets/images/adobe/logo.png') }}" />
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="{{ asset('assets/webfont.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="{{ asset('assets/admin/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .dhsco-cards{
            border-radius: 6px;
            box-shadow: 0px 1px 3px 1px rgba(69, 65, 78, 0.19);
            padding: 1.5rem !important;
            margin: 1rem !important;
        }
        .dhsco-cards .kt-widget17__icon svg{
            width: 46px !important;
            height: 46px !important;
        }
        .dhsco-stats{
            width: 100% !important;
        }
        .dhsco-card-value{
            float: right;
            font-size: 24px;
            margin-top: 5px;
        }
        .text-grey{
            color: #6c7293;
        }
        .dotted-btn{
            padding: 20px 30px;
            border: 1px dashed #c4c4c4;
            margin: 0 auto;
        }
        .yellow {
            color: #FFEB3B !important; }


        .info {
            color: #1E9FF2 !important; }

        body{
            font-weight: 500;
        }
        .kt-portlet .kt-portlet__body{
            overflow-x: auto !important;
        }
    </style>
</head>
