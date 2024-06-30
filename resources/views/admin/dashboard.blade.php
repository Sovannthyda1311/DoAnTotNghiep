@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="me-md-3 me-xl-5">
            <h2>Dashboard</h2>
            <p class="mb-md-0">Your analytics dashboard template.</p>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <i class="fa fa-shopping-cart fa-3x"></i>
                    <label>Total Orders</label>
                    <h1>{{$totalOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View Orders</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <i class="fa fa-shopping-cart fa-3x"></i>
                    <label>Today Orders</label>
                    <h1>{{$todayOrder}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View Orders</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <i class="fa fa-shopping-cart fa-3x"></i>
                    <label>This Month Orders</label>
                    <h1>{{$ThisMonthOrder}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View Orders</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <i class="fa fa-calendar fa-3x"></i>
                    <label>This Year Orders</label>
                    <h1>{{$ThisYearOrder}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View Orders</a>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <i class="fa fa-tags fa-3x"></i>
                    <label>Total Brands</label>
                    <h1>{{$totalBrands}}</h1>
                    <a href="{{url('admin/brands')}}" class="text-white">View Brands</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <i class="fa fa-cube fa-3x"></i>
                    <label>Total Products</label>
                    <h1>{{$totalProducts}}</h1>
                    <a href="{{url('admin/products')}}" class="text-white">View Products</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <i class="fa fa-folder fa-3x"></i>
                    <label>Total Subcategories</label>
                    <h1>{{$totalSubcategories}}</h1>
                    <a href="{{url('admin/subcategories')}}" class="text-white">View Subcategories</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <i class="fa fa-list fa-3x"></i>
                    <label>Total Categories</label>
                    <h1>{{$totalCategories}}</h1>
                    <a href="{{url('admin/category')}}" class="text-white">View Categories</a>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <i class="fa fa-users fa-3x"></i>
                    <label>All Users</label>
                    <h1>{{$totalUsers}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">View Users</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
