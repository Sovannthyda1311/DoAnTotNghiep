@extends('layouts.admin')

@section('title', 'Edit Size')

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
                <h3>Edit Sizes
                    <a href="{{ url('admin/sizes') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-arrow-left"></i> BACK </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/sizes/'.$size->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Size</label>
                        <input type="text" name="name" value="{{$size->name}}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br/>
                        <input type="checkbox" name="status" {{ $size->status ? 'checked':''}} style="width:50;height:50;" /> Checked = Hidden , UnChecked = Visible.
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
