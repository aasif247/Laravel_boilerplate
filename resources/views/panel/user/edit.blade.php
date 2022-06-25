{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}
@extends('layouts.app')

@section('title', 'Edit User')

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
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit User</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT','autocomplete' => 'off']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Html::decode(Form::label('name', "User Name", ['class' => 'required mb-1 fw-medium text-muted'])) !!}
                                @error('name')( <span class="text-danger">{{ $message }}</span> )@enderror
                                {!! Form::text("name", $user->name, ["class" => "form-control", 'id' => 'name', 'required','placeholder' => 'User Name']) !!}
                            </div>
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                </div> <!-- end card-body -->
                <div class="card-footer bg-transparent">
                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                        {!! Form::submit('Update User', ['class' => 'btn btn-primary glow mr-sm-1 mb-1', 'id' => 'user_update']) !!}
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    {!! Form::close() !!}
    <!-- end row -->

    </div> <!-- container -->
@endsection

@section('js_on_page')
    <!-- User js -->
    <script src="{{ asset('javascript/pages/user.js?v='. $version) }}"></script>
@endsection
