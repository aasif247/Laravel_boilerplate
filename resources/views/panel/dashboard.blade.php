{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="card" id="tooltip-container">
                        <div class="card-body">
                            <h4 class="mt-0 font-24 text-center">Total Active Products</h4>
                            <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ $active_product }}</span></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="card" id="tooltip-container1">
                        <div class="card-body">
                            <h4 class="mt-0 font-24 text-center">Total Inactive Products</h4>
                            <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ $inactive_product }}</span></h2>
                        </div>
                    </div>
                </div>

            </div> <!-- end row -->

    </div>
    <!-- container -->
@endsection
