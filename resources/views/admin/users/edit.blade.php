@extends('layouts.admin')

@section('title', 'Edite User')

@section('content')

<div class="row">
    <div class="col-md-12 ">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
                <h3>Edit Users Infomation
                    <a href="{{ url('admin/users') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-arrow-left"></i> BACK </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/users/'.$user->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$user->name}}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="{{$user->email}}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <input type="hidden" name="role_as" value="0"> <!-- Add the hidden field for role_as -->
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-edit"></i> Update </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
