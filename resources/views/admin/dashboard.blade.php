@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Categories Management</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column w-100">
                        <a class="small text-white mb-2" href="{{ route('admin.category.show') }}">View Categories</a>
                        <a class="small text-white" href="{{ route('admin.category.view') }}">Add Category</a>
                    </div>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Products Management</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column w-100">
                        <a class="small text-white mb-2" href="{{ route('admin.product.show') }}">View Products</a>
                        <a class="small text-white" href="{{ route('admin.product.view') }}">Add Product</a>
                    </div>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Orders Management</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column w-100">
                        <a class="small text-white mb-2" href="{{ route('admin.order.show') }}">View Orders</a>
                        <a class="small text-white" href="{{ route('admin.order.create') }}">Add Order</a>
                    </div>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
