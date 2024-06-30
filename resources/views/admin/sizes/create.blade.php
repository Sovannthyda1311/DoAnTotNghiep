@extends('layouts.admin')

@section('title', 'Create Size')

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
                <h3>Add Sizes
                    <a href="{{ url('admin/sizes') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-arrow-left"></i> BACK </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/sizes/create')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Size</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br/>
                        <input type="checkbox" name="status" style="width: 100; height:100;" /> Checked = Hidden , UnChecked = Visible.
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
