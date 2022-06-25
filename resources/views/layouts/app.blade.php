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
    <!-- Laravel CSRF Meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(sd_application_setting('favicon')) }}">

    @include('layouts.partials.css')

</head>

<!-- body start -->
<body style="font-family: 'Lora', sans-serif;" class="loading" data-layout-mode="detached" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>

<!-- Begin page -->
<div id="wrapper">

    @include('layouts.partials.topbar')

    @include('layouts.partials.sidebar')



    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            @yield('content')

        </div> <!-- content -->


        @include('layouts.partials.footer')

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    @if(sd_application_setting('notification_sound') == 1)
        <audio id="successToast">
            <source src="{{ asset('audio/success.ogg?v=' . $version) }}" type="audio/ogg">
            <source src="{{ asset('audio/success.mp3?v=' . $version) }}" type="audio/mpeg">
        </audio>
        <audio id="errorToast">
            <source src="{{ asset('audio/error.ogg?v=' . $version) }}" type="audio/ogg">
            <source src="{{ asset('audio/error.mp3?v=' . $version) }}" type="audio/mpeg">
        </audio>
        <audio id="warningToast">
            <source src="{{ asset('audio/warning.ogg?v=' . $version) }}" type="audio/ogg">
            <source src="{{ asset('audio/warning.mp3?v=' . $version) }}" type="audio/mpeg">
        </audio>
        <audio id="infoToast">
            <source src="{{ asset('audio/info.ogg?v=' . $version) }}" type="audio/ogg">
            <source src="{{ asset('audio/info.mp3?v=' . $version) }}" type="audio/mpeg">
        </audio>
        <audio id="sureAudio">
            <source src="{{ asset('audio/are_you_sure.mp3?v=' . $version) }}" type="audio/mpeg">
        </audio>
    @endif
</div>
<!-- END wrapper -->

@include('layouts.partials.js')

</body>
</html>
