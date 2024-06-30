@extends('layouts.admin')

@section('title', 'Edit Subcategory')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3>Edit Sub Category
                    <a href="{{ url('admin/subcategories') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-arrow-left"></i>
                        BACK
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/subcategories/'.$subcategory->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{$subcategory->name}}" class="form-control" placeholder="Enter Sub Category Name" />
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{$subcategory->slug}}" class="form-control" placeholder="Enter Sub Category Slug" />
                            @error('slug')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control custom-select" style="width: 100%;">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $subcategory->category_id ? 'selected' : ''}}>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary float-end btn-sm text-white"><i class="fa fa-edit"></i> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
