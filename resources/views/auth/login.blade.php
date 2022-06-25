@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card bg-pattern">

            <div class="card-body p-4">

                <div class="text-center w-75 m-auto">
                    <div class="auth-logo">
                        <a href="{{ url('/') }}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{ asset(sd_application_setting('logo_dark')) }}"
                                                     alt="{{ config('app.name', 'Quizbuzz BD') }}"
                                                     height="22">
                                            </span>
                        </a>

                        <a href="{{ url('/') }}" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{ asset(sd_application_setting('logo_light')) }}"
                                                     alt="{{ config('app.name', 'Quizbuzz BD') }}"
                                                     height="22">
                                            </span>
                        </a>
                    </div>
                    @if (session('status'))
                        <div class="mb-4 mt-3 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                </div>

                {!! Form::open(['route' => 'login', 'method' => 'POST', 'autocomplete' => 'off']) !!}

                <div class="mb-3">
                    {!! Form::label('email', 'Email Address'); !!}
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email Address', 'id' => 'email', 'required', 'autofocus']) !!}
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    {!! Form::label('password', 'Password'); !!}
                    <div class="input-group input-group-merge">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'password', 'required']) !!}
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            {!! Form::checkbox('remember', true, 1, ['class' => 'form-check-input', 'id' => 'remember']) !!}
                            {!! Form::label('remember', 'Remember Me', ['class' => 'form-check-label']); !!}
                        </div>
                    </div>
                </div>

                <div class="text-center d-grid">
                    {!! Form::submit('Login', ['class' => 'btn btn-primary', 'id' => 'login']) !!}
                </div>

                {!! Form::close() !!}

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

{{--        <div class="row mt-3">--}}
{{--            <div class="col-12 text-center">--}}
{{--                @if (Route::has('password.request') && config('app.env', 'production') != 'demo')--}}
{{--                    <p>--}}
{{--                        <a href="{{ route('password.request') }}"--}}
{{--                           class="text-white-50 ml-1">Forget Password?</a>--}}
{{--                    </p>--}}
{{--                @endif--}}
{{--            </div> <!-- end col -->--}}
{{--        </div>--}}
{{--        <!-- end row -->--}}

    </div> <!-- end col -->

@endsection
