@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 py-5">
        <div class="col-md-6">
            <div class="card shadow-lg" style="border: none; border-radius: 10px;">
                <div class="card-header bg-dark text-white text-center" style="border-radius: 10px 10px 0 0;">
                    <h4>{{ __('Dashboard') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-center">{{ __('You are logged in!') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
