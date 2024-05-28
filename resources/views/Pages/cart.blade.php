@extends('Pages.master')
@section('pages', 'Cart')
@section('description', 'Here are all your shopping cart')
@section('content')
    <main class="py-3">
        <div class="container">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        @if ($cart)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart->cart_item as $cartItem)
                                        <tr>
                                            <td><img src="{{ asset('storage/images/' . $cartItem->product->pictures) }}"
                                                    alt="" width="100" class="rounded"></td>
                                            <td>{{ $cartItem->product->name }}</td>
                                            <td>{{ $cartItem->quantity }}</td>
                                            <td>
                                                <a href="{{ route('cart.delete', $cartItem->id) }}" class="btn btn-danger"
                                                    onclick="confirmDelete('{{ route('cart.delete', $cartItem->id) }}')">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>Total Items: {{ $cart->total_product }}</td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="{{ route('checkout-page') }}" class="btn btn-success">Checkout</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p>Your cart is empty.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <script>
            function confirmDelete(deleteUrl) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this action!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Removed Successfully!'
                        });
                    }
                });
            }
        </script>
    </main>
@endsection
