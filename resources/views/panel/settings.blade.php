{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}

@extends('layouts.app')

@section('title', "Application Settings")

@section('content')
<div class="content-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Application Settings</li>
                    </ol>
                </div>
                <h4 class="page-title">Application Settings</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                {!! Form::open(['route' => 'application.settings', 'method' => 'POST', 'files' => 'true', 'enctype'=>'multipart/form-data', 'autocomplete' => 'off']) !!}
                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#logo_settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Logo and Favicon
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#common_settings" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                            General Settings
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="logo_settings">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('logo_light', 'Light Logo', ['class' => 'required mb-1 fw-medium text-muted'])); !!}
                                    {!! Form::file('logo_light', ['class' => 'dropify', 'id' => 'logo_light', 'data-default-file' => asset(sd_application_setting('logo_light')), 'accept' => 'image/png']) !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('favicon', 'Favicon', ['class' => 'required mb-1 fw-medium text-muted'])); !!}
                                    {!! Form::file('favicon', ['class' => 'dropify', 'id' => 'favicon', 'data-default-file' => asset(sd_application_setting('favicon')), 'accept' => 'image/png']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('logo_sm', 'Logo small', ['class' => 'required mb-1 fw-medium text-muted'])); !!}
                                    {!! Form::file('logo_sm', ['class' => 'dropify', 'id' => 'logo_sm', 'data-default-file' => asset(sd_application_setting('logo_sm')), 'accept' => 'image/png']) !!}
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('no_image', 'No Image', ['class' => 'required mb-1 fw-medium text-muted'])); !!}
                                    {!! Form::file('no_image', ['class' => 'dropify', 'id' => 'no_image', 'data-default-file' => asset(sd_application_setting('no_image')), 'accept' => 'image/png']) !!}
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('logo_dark', 'Dark Logo', ['class' => 'required mb-1 fw-medium text-muted'])); !!}
                                    {!! Form::file('logo_dark', ['class' => 'dropify', 'id' => 'logo_dark', 'data-default-file' => asset(sd_application_setting('logo_dark')), 'accept' => 'image/png']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="common_settings">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('app_name', "Application Name", ['class' => 'required mb-1 fw-medium text-muted'])); !!}
                                    {!! Form::text('app_name', sd_application_setting('app_name'), ['class' => 'form-control', 'id' => 'app_name', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('notification_sound', 'Notification Sound', ['class' => 'required mb-1 fw-medium text-muted'])); !!}
                                    {!! Form::select('notification_sound', [1 => 'Yes', 0 => "No"], sd_application_setting('notification_sound'), ['class' => 'form-control', 'id' => 'notification_sound', 'required', 'placeholder' => 'Please Select']) !!}
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('display_record_per_page', 'Display Table Record Per Page', ['class' => 'required mb-1 fw-medium text-muted'])); !!}
                                    {!! Form::number('display_record_per_page', sd_application_setting('display_record_per_page'), ['class' => 'form-control', 'id' => 'display_record_per_page', 'min' => 10, 'step' => 1, 'required', 'placeholder' => 'Display Table Record Per Page']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                        {!! Form::submit("Change Settings", ['class' => 'btn btn-primary glow mr-sm-1 mb-1', 'id' => 'app_setting_submit']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection

@section('page_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_panel/libs/dropify/css/dropify.min.css?v=' . $version) }}">
@endsection

@section('page_js')
    <script src="{{ asset('admin_panel/libs/dropify/js/dropify.min.js?v='. $version) }}"></script>
    <script>
        // default Dropify
        $('.dropify').dropify({
            messages: {
                default: "Drop File Here",
                replace: "Replace File",
                remove: "Remove File",
                error: "Error File"
            }
        });
    </script>
@endsection

@section('js_on_page')
    <script>
        // select2
        $('#notification_sound, #shurjopay_test').select2({
            placeholder: "Please Select",
            width: '100%'
        });
    </script>
@endsection
