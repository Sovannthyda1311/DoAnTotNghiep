@extends('layouts.app')

@section('title', 'My Orders Details')


@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i> My Odrers Details
                        <a href="{{ url('orders') }}" class="btn btn-danger btn-sm float-end"><i class="fa fa-arrow-left"></i> BACK </a>
                    </h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <hr>
                            <h6>Order Id: {{ $order->id }}</h6>
                            <h6>Tracking No: {{ $order->tracking_no }}</h6>
                            <h6>Ordered Date: {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
                            <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                            <h6 class="border p-2 text-success">
                                Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>Full Name: {{ $order->fullname }}</h6>
                            <h6>Email: {{ $order->email }}</h6>
                            <h6>Phone: {{ $order->phone }}</h6>
                            <h6>Full Address: {{ $order->address }}, {{ $order->ward }}, {{ $order->district }}, {{ $order->city }}</h6>
                        </div>
                    </div>

                    <br/>
                    <h5>Order Items</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td width="10%">{{ $orderItem->id }}</td>
                                    <td width="10%">
                                        @if ($orderItem->product->productImages)
                                            <img src="{{asset($orderItem->product->productImages[0]->image)}}"
                                            style="width: 50px; height: 67px" alt="{{ $orderItem->product->name}}">
                                        @else
                                            <img src="" style="width: 50px; height: 67px" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $orderItem->product->name}}
                                        @if ($orderItem->productColor)
                                            - color: {{$orderItem->productColor->color->name}}
                                            @if ($orderItem->productSize)
                                                and size: {{$orderItem->productSize->size->name}}
                                            @endif
                                        @elseif ($orderItem->productSize)
                                            with size: {{$orderItem->productSize->size->name}}
                                        @endif
                                    </td>
                                    <td width="10%">${{ $orderItem->price }}</td>
                                    <td width="10%">{{ $orderItem->quantity }}</td>
                                    <td width="10%" class="fw-bold">${{ $orderItem->quantity * $orderItem->price }}</td>
                                    @php
                                        $totalPrice += $orderItem->quantity * $orderItem->price;
                                    @endphp
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"  class="fw-bold">Total Amount</td>
                                    <td colspan="1"  class="fw-bold">${{ $totalPrice }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
