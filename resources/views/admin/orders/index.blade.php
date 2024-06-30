@extends('layouts.admin')

@section('title', 'Order')


@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3>Orders</h3>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Filter by Date</label>
                            <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Filter by Status</label>
                            <select name="status" class="form-select">
                                <option value="">Select All Status</option>
                                <option value="In progress" {{ Request::get('status') == 'in progress' }}>In Progress</option>
                                <option value="Completed" {{ Request::get('status') == 'completed' }}>Completed</option>
                                <option value="Pending" {{ Request::get('status') == 'pending' }}>Pending</option>
                                <option value="Cancelled" {{ Request::get('status') == 'cancelled' }}>Cancelled</option>
                                <option value="On the way to you" {{ Request::get('status') == 'on-the-way-to-you' }}>On The Way To You</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br/>
                            <button type="submit" class="btn btn-primary btn-sm text-white"><i class="fa fa-filter"></i> Filter </button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Tracking No</th>
                                <th>Username</th>
                                <th>Payment Mode</th>
                                <th>Ordered Date</th>
                                <th>Status Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @forelse ($orders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->fullname }}</td>
                                    <td>{{ $item->payment_mode }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($item->status_message == 'In progress')
                                            <span class="btn btn-sm btn-primary text-white">
                                                <i class="fa fa-spinner"></i>
                                                {{ $item->status_message }}
                                            </span>
                                        @elseif ($item->status_message == 'Completed')
                                            <span class="btn btn-sm btn-success text-white">
                                                <i class="fa fa-check-circle"></i>
                                                {{ $item->status_message }}
                                            </span>
                                        @elseif ($item->status_message == 'Pending')
                                            <span class="btn btn-sm btn-warning text-white">
                                                <i class="fa fa-clock-o"></i>
                                                {{ $item->status_message }}
                                            </span>
                                        @elseif ($item->status_message == 'Cancelled')
                                            <span class="btn btn-sm btn-danger text-white">
                                                <i class="fa fa-times-circle"></i>
                                                {{ $item->status_message }}
                                            </span>
                                        @elseif ($item->status_message == 'On the way to you')
                                            <span class="btn btn-sm btn-info text-white">
                                                <i class="fa fa-truck"></i>
                                                {{ $item->status_message }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/orders/'.$item->id) }}" class="btn btn-success btn-sm text-white">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No orders available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                            {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
