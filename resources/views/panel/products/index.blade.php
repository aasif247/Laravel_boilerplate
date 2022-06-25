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
                            <li class="breadcrumb-item active">Product List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product List</h4>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('category_id', "Category") !!}
                                    {!! Form::select("category_id", ['all' => "All", $categories] , null, ["class" => "form-control", "id" => "category_id"]) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('created_by', "User") !!}
                                    {!! Form::select("created_by", ['all' => "All", $users] , null, ["class" => "form-control", "id" => "created_by"]) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('status', "Product Status") !!}
                                    {!! Form::select("status", ['all' => "All", 1 => "Active", 0 => 'Inactive'] , null, ["class" => "form-control", "id" => "product_status"]) !!}
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
                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-blue waves-effect waves-light float-end">
                            <i class="mdi mdi-plus-circle"></i> Create New Product
                        </a>
                        <h4 class="header-title mb-4">Manage Products</h4>

                        <div class="table-responsive">
                            <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="product_datatable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>SKU</th>
                                    <th>Product Price</th>
                                    <th>Status</th>
                                    <th>Created By</th>
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
    <script src="{{ asset('javascript/pages/products.js?v='. $version) }}"></script>
@endsection
