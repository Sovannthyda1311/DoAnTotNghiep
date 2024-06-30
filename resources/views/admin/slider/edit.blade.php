@extends('layouts.admin')

@section('title', 'Edit Slider')

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
                <h3>Edit Sliders
                    <a href="{{ url('admin/sliders') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-arrow-left"></i> BACK </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/sliders/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT');

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $slider->title }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $slider->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" /><br/>
                        <img src="{{ asset("$slider->image") }}" style="width: 200px; height: 100px" alt="Slider" />
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label><br/>
                        <input type="checkbox" id="status" name="status" {{ $slider->status == '1' ? 'checked':'' }} class="form-check-input" />
                        Checked = Hidden, Unchecked = Visible
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
