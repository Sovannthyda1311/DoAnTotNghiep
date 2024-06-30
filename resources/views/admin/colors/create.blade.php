@extends('layouts.admin')

@section('title', 'Add Color')

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
                <h3>Add Colors
                    <a href="{{ url('admin/colors') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-arrow-left"></i> BACK </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/colors/create')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="colorInput" class="form-label">Color</label>
                        <div class="input-group">
                            <input type="color" id="colorInput" name="code" class="form-control form-control-lg" style="border-radius: 5px; border: 1px solid #ccc; padding: 5px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-save"></i> Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
