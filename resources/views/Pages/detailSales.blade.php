@extends('Pages.master')
@section('pages', 'Order Detail')
@section('description', 'Below here is all the specific information about orders')
@section('content')
    <main class="py-3">
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <h3>Order Information</h3>
                    <p><strong>ID:</strong> {{ $order->id }}</p>
                    <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                    <p><strong>Total Price:</strong> {{ $order->total_price }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3>User Information</h3>

                    @foreach ($order->user_order as $userOrder)
                        <p><strong>User Name:</strong> {{ $userOrder->user->name }}</p>
                        <p><strong>User Email:</strong> {{ $userOrder->user->email }}</p>
                        @break
                    @endforeach
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3>Product Information</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->product_order as $productOrder)
                                <tr>
                                    <td>{{ $productOrder->product->name }}</td>
                                    <td>{{ $productOrder->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
