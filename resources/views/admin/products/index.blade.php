@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="row">
    <div class="col-md-12 ">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Products
                    <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-plus"></i> Add Products</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Brand</th>
                                <th>Original Price</th>
                                <th>Selling Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->subcategory->name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->original_price }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <a href="{{url('admin/products/'.$product->id.'/edit')}}" class="btn btn-sm btn-success text-white"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="{{url('admin/products/'.$product->id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this Product?')" class="btn btn-sm btn-danger text-white">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan='10'>No Products Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


