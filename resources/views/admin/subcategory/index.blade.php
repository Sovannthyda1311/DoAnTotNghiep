@extends('layouts.admin')

@section('title', 'Subcategory')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Sub Category
                    <a href="{{ url('admin/subcategories/create') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-plus"></i> Add Subcategory </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-borered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subcategories->sortBy('id') as $subcategory)
                        <tr>
                            <td>{{ $subcategory->id }}</td>
                            <td>{{ $subcategory->name }}</td>
                            <td>{{ $subcategory->category->name}}</td>
                            <td>
                                <a href="{{ url('admin/subcategories/'.$subcategory->id.'/edit')}}" class="btn btn-sm btn-success text-white"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="{{url('admin/subcategories/'.$subcategory->id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this data?')" class="btn btn-sm btn-danger text-white">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Sub Category Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
