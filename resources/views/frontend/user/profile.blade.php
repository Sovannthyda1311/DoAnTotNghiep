@extends('layouts.app')

@section('title', 'My Profile')


@section('content')

<div class="py-5 ">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-10">
                    <h4>My Profile
                        <a href="{{url('change-password')}}" class="btn btn-warning float-end"><i class="fa fa-lock"></i> Change Password ? </a>
                    </h4>
                <div class="underline mb-4"></div>
            </div>

            <div class="col-md-10">

                @if (session('message'))
                    <p class="alert alert-success">{{ (session('message')) }}</p>
                @endif

                @if ($errors->any())
                <ul class="alert alert-dander">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{$error}}</li>
                    @endforeach
                </ul>

                @endif

                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">My Profile Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('profile')}}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Username</label>
                                        <input type="text" name="username" value="{{Auth::user()->name}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Email Address</label>
                                        <input type="text" readonly value="{{Auth::user()->email}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" value="{{Auth::user()->userDetail->phone ?? ''}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>City</label>
                                        <input type="text" name="city" value="{{Auth::user()->userDetail->city ?? ''}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>District</label>
                                        <input type="text" name="district" value="{{Auth::user()->userDetail->district ?? ''}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Ward</label>
                                        <input type="text" name="ward" value="{{Auth::user()->userDetail->ward ?? ''}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Address</label>
                                        <textarea name="address"  class="form-control" rows="3">{{Auth::user()->userDetail->address ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-save"></i> Save Data </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
