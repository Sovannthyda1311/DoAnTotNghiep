@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')


<div class="row">
    <div class="col-md-12 ">

        <div class="card">
            <div class="card-header">
                <h3>Edit category
                    <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-arrow-left"></i> BACK </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name='name' value="{{$category->name}}" class="form-control" />
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name='slug' value="{{$category->slug}}" class="form-control" />
                            @error('slug')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name='image' class="form-control" />
                            <img src="{{ asset("$category->image")}}" width="100px" height="100px"/>
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submin" class="btn btn-primary float-end text-white "><i class="fa fa-edit"></i> Update </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
