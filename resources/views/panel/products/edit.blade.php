{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}
@extends('layouts.app')

@section('title', 'Edit Product')

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
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => ['products.update', $product->id], 'method' => 'PUT', 'files' => 'true', 'enctype'=>'multipart/form-data', 'autocomplete' => 'off']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Html::decode(Form::label('product_category_id', "Category", ['class' => 'required mb-1 fw-medium text-muted'])) !!}
                                @error('product_category_id')( <span class="text-danger">{{ $message }}</span> )@enderror
                                {!! Form::select("category_id", $categories , $product->category_id, ["class" => "form-control", 'required', "id" => "product_category_id", 'placeholder' => 'Please Select a category']) !!}
                            </div> <!-- end col -->
                            <div class="col-md-4">
                                {!! Html::decode(Form::label('product_name', "Product Name", ['class' => 'required mb-1 fw-medium text-muted'])) !!}
                                @error('product_name')( <span class="text-danger">{{ $message }}</span> )@enderror
                                {!! Form::text("product_name", $product->product_name, ["class" => "form-control", "id" => "product_name", 'required', 'autofocus', 'placeholder' => 'Product Name']) !!}
                            </div> <!-- end col -->
                            <div class="col-md-4">
                                {!! Html::decode(Form::label('product_price', "Product Price", ['class' => 'required mb-1 fw-medium text-muted'])) !!}
                                @error('mobile_number')( <span class="text-danger">{{ $message }}</span> )@enderror
                                {!! Form::number("product_price", $product->product_price, ["class" => "form-control", 'id' => 'product_price', 'required', 'min' => 0.01, 'step' => 0.01, 'placeholder' => 'Product Price']) !!}
                            </div>
                        </div> <!-- end col -->
                        <div class="col-md-12 mt-2">
                            {!! Html::decode(Form::label('product_photo_path', "Product Photo", ['class' => 'mb-1 fw-medium text-muted'])) !!}
                            @error('product_photo_path')( <span class="text-danger">{{ $message }}</span> )@enderror
                            {!! Form::file('product_photo_path', ['class' => 'dropify', 'id' => 'product_photo_path', 'accept' => 'image/png,image/jpg,image/jpeg', 'data-default-file' => asset($product->product_photo_path)]) !!}
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div> <!-- end card-body -->
                <div class="card-footer bg-transparent">
                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                        {!! Form::submit('Update Product', ['class' => 'btn btn-primary glow mr-sm-1 mb-1', 'id' => 'product_update']) !!}
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
    <script src="{{ asset('javascript/pages/products.js?v='. $version) }}"></script>
@endsection
