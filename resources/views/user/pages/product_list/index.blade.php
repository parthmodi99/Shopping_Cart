@extends('user.layouts.login_after')
@section("title",'Product List')
@section('style')
@endsection

@section('content')
<div >
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title" style="margin-top: 18px;">
                <div class="row">
                    <div class="col-6">
                        <h2>Product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive big tableinsidetable">
                            <table class="display product_table" id="user_product_table">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Product Image</th>
                                        <th>name</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('user_assets/custom/user_product.js') }}"></script>
@endsection
