{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}

@extends('layouts.app')

@section('title', auth()->user()->name . "'s Profile")

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ asset(auth()->user()->profile_photo_path) }}" class="rounded-circle avatar-lg img-thumbnail"
                             alt="{{ auth()->user()->name }}">

                        <h4 class="mb-0">{{ auth()->user()->name }}</h4>

                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{ auth()->user()->name }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2">{{ auth()->user()->email }}</span></p>
                        </div>
                    </div>
                </div> <!-- end card -->

            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'profile', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        {!! Html::decode(Form::label('name', "Full Name", ['class' => 'required mb-1 fw-medium text-muted'])) !!}
                                        @error('name')( <span class="text-danger">{{ $message }}</span> )@enderror
                                        {!! Form::text("name", auth()->user()->name, ["class" => "form-control", 'id' => 'name', 'required', 'placeholder' => 'Full Name']) !!}
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Security Update</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        {!! Html::decode(Form::label('password', "Password", ['class' => 'mb-1 fw-medium text-muted'])) !!}
                                        @error('password')( <span class="text-danger">{{ $message }}</span> )@enderror
                                        {!! Form::password("password", ["class" => "form-control", 'id' => 'password', 'placeholder' => 'Choose a password']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        {!! Html::decode(Form::label('password_confirmation', "Confirm Password", ['class' => 'mb-1 fw-medium text-muted'])) !!}
                                        @error('password_confirmation')( <span class="text-danger">{{ $message }}</span> )@enderror
                                        {!! Form::password("password_confirmation", ["class" => "form-control", 'id' => 'password_confirmation', 'placeholder' => 'Confirm Password']) !!}
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="text-end">
                                {!! Form::submit('Update Profile', ['class' => 'btn btn-success waves-effect waves-light mt-2', 'id' => 'profile_update']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection
