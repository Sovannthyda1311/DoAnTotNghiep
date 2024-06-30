@extends('layouts.admin')

@section('title', 'Color')

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
                <h3>Colors List
                    <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm text-white float-end"><i class="fa fa-plus"></i> Add Colors </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Color Name</th>
                            <th>Color code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->code}}</td>
                                <td>
                                    <a href="{{url('admin/colors/'.$item->id.'/edit')}}" class="btn btn-sm btn-success text-white"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="{{ url('admin/colors/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this color?')" class="btn btn-sm btn-danger text-white">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$colors->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
