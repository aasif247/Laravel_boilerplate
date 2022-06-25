{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{ sd_application_setting('app_name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(sd_application_setting('favicon')) }}">

    <!-- App css -->
    <link href="{{ asset('admin_panel/css/config/modern/bootstrap.min.css?v='. $version) }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('admin_panel/css/config/modern/app.min.css?v='. $version) }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <!-- Dark App css -->
    <link href="{{ asset('admin_panel/css/config/modern/bootstrap-dark.min.css?v='. $version) }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('admin_panel/css/config/modern/app-dark.min.css?v='. $version) }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('admin_panel/css/icons.min.css?v='. $version) }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt text-white-50">
    &copy;Copyright {{ \Carbon\Carbon::now()->format('Y') }} | Developed By <a href="{{ config('admin.developer_url') }}" class="text-white-50 link_confirmation" target="_blank">{{ config('admin.developer_by') }}</a> | All right Reserved
</footer>

<!-- Vendor js -->
<script src="{{ asset('admin_panel/js/vendor.min.js?v='. $version) }}"></script>

<!-- App js -->
<script src="{{ asset('admin_panel/js/app.min.js?v='. $version) }}"></script>

</body>
</html>
