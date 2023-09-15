@extends('admin.layouts.login_after')
@section("title",'Edit Product')
@section('style')
@endsection

@section('content')
    <div style="margin-left: 230px;">
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title" style="margin-top: 18px;">
                    <div class="row">
                        <div class="col-6">
                            <h3>Edit Product</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid doctors_profile">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.product.update', $product_details->id) }}" method="POST" id="update_product_form" name="update_product_form" class="form-inline" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-lg-6 pe-2">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Product Name" value="{{ $product_details->name }}"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-2">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Product Price</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            placeholder="Product Price" value="{{ $product_details->price }}"/>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 pe-2">
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Product Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo" />
                                    </div>
                                </div>

                                <div class="col-lg-6 pe-2">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Product Details</label>
                                    <textarea class="form-control" placeholder="description" id="description" name="description" style="height: 100px">{{ $product_details->description }}</textarea>
                                    <label id="description-error" class="error" for="description"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 pe-2">
                                <div class="mb-3">
                                    <div class="crop-image-preview-container  show" id="edit_profile_image-container">
                                        <img id="crop-image" src="{{ asset('storage/'. $product_details->photo) }}" style="width: 250px;height: 250px;"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <a class="btn btn-secondary modelbtn" type="button"
                                        href="{{ route('admin.product.index') }}">
                                        Close
                                    </a>
                                    <button class="btn btn-primary" type="submit" title=""> Update </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin_assets/custom/product.js') }}"></script>
@endsection
