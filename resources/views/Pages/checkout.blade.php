@extends('Pages.master')
@section('pages', 'Checkout')
@section('description', 'Get ready to have your own product')
@section('content')
    <main class="py-3">
        <div class="container">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($cartItem->isNotEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItem as $cartItem)
                                        <tr>
                                            <td>{{ $cartItem->product->name }}</td>
                                            <td>{{ $cartItem->quantity }}</td>
                                            <td>Rp {{ $cartItem->product->price }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Total:</strong></td>
                                        <td><strong>{{ $totalQuantity }}</strong></td>
                                        <td><strong>Rp {{ $totalPrice }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- <h1>Your Address</h1> --}}
                            <form id="checkOutForm" action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="address"><strong>Please input your address</strong></label>
                                    <input type="text" id="address" name="address" class="form-control" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button onclick="checkOutForm()" type="submit" class="btn btn-success">Confirm Order</button>
                                </div>
                            </form>
                        @else
                            <p>Your cart is empty. Cannot proceed with checkout.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <script>
            function checkOutForm() {
                event.preventDefault();
                Swal.fire({
                    icon: 'success',
                    title: 'Checkout Product Successfully',
                    text: 'Your order will deliver to your address, as soon as possible!',
                }).then(() => {
                    document.getElementById('checkOutForm').submit();
                });
            }
        </script>
    </main>
@endsection
