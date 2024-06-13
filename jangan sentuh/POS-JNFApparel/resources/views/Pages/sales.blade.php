@extends('Pages.master')
@section('pages', 'Sales')
@section('description', 'Here are all the list of sales data')
@section('content')
    <main class="py-3">
        <div class="container">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order Date</th>
                                    <th>User</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        @foreach ($order->user_order as $userOrder)
                                            <td>{{ $userOrder->user->name }}</td>
                                            @break
                                        @endforeach
                                        <td>{{ $order->total_price }}</td>
                                        <td>
                                            <a href="{{ route('sales.detail', $order->id) }}" class="btn btn-primary">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="container">
            <h1>Sales Details</h1>

            @foreach ($orders as $order)
                <div class="card mb-3">
                    <div class="card-header">
                        Order ID: {{ $order->id }}
                    </div>
                    <div class="card-body">
                        <p>Order Address: {{ $order->order_address }}</p>
                        <p>Order Date: {{ $order->order_date }}</p>
                        <p>Total Price: {{ $order->total_price }}</p>

                        <h4>User Order Details</h4>
                        <ul>
                            @php
                                $displayedUserIds = [];
                            @endphp

                            @foreach ($order->user_order as $userOrder)
                                @if (!in_array($userOrder->user_id, $displayedUserIds))
                                    <li>Name: {{ $userOrder->user->name }}, Ordered At: {{ $userOrder->order_at }}</li>
                                    @php
                                        $displayedUserIds[] = $userOrder->user_id;
                                    @endphp
                                @endif
                            @endforeach
                        </ul>


                        <h4>Product Order Details</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
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
            @endforeach
        </div> --}}
    </main>
    
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
    
@endsection
