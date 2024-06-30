@extends('layouts.admin')

@section('title', 'Users List')

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
                <h3>Users List
                    <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-plus"></i> Add User </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->role_as == '0')
                                        <label class="badge btn-primary"><i class="fa fa-user"></i> User </label>
                                    @elseif($user->role_as == '1')
                                        <label class="badge btn-success">Admin</label>
                                    @else
                                    <label class="badge btn-primary">none</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/users/'.$user->id.'/edit')}}" class="btn btn-sm btn-success text-white"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="{{url('admin/users/'.$user->id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this User?')" class="btn btn-sm btn-danger text-white">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan='5'>No user available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

