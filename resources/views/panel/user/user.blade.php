{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}

@extends('layouts.app')

@section('title', 'Product List')

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
                            <li class="breadcrumb-item active">User List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">User List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-title"><h4>Filter</h4></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('userDateRange', 'Date Range') !!}
                                    <div class="input-group">
                                        {!! Form::text("userDateRange", null, ["class" => "form-control showCalRanges"]) !!}
                                        <div class="form-control-position">
                                            <i class='bx bx-calendar'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Manage Users</h4>

                        <div class="table-responsive">
                            <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="user_datatable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>User Name</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('js_on_page')
    <!-- User js -->
    <script src="{{ asset('javascript/pages/user.js?v='. $version) }}"></script>
@endsection

