@extends('Pages.master')
@section('pages', 'Product Catalog')
@section('description', 'Berikut ini merupakan produk-produk kami, anda bisa menambahkannya ke dalam keranjang.')
@section('content')

    <section class="section">
        <div class="row">

            <form method="get" action="{{ route('catalog') }}">
                <label for="category">Select Category:</label>
                <div class="row">
                    <div class="col-8">
                        <select name="category" id="category" class="form-select">
                            <option value="" {{ empty($categoryId) ? 'selected' : '' }}>All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </div>
                <hr>
            </form>
        
            @foreach ($products as $item)
                <div class="col-4">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h4 class="card-title">{{ $item->name }}</h4>
                                    </div>
                                    <div class="col-3">
                                        <span class="badge bg-light-secondary">{{ $item->category->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <img class="w-100 img-fluid" style="height: 200px;" src="{{ asset('storage/images/' . $item->pictures) }}"
                                alt="Card image cap">
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <span>Rp {{ $item->price }}</span>
                            <form action="{{ route('cart.add') }}" method="post" id="addToCartForm{{ $item->id }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal" data-product-id="{{ $item->id }}">Order Now</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="orderForm" action="{{ route('order.add') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel">Enter Your Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="product_id" id="modalProductId">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>

    <script>
        document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Check if the form is the add to cart form
            if (event.submitter && event.submitter.classList.contains('btn-primary') && !event.submitter.closest('#orderModal')) {
                Swal.fire({
                    icon: 'success',
                    title: 'Product added to cart successfully!',
                });
            }

            // Check if the form is the order form
            if (event.submitter && event.submitter.closest('#orderModal')) {
                Swal.fire({
                    icon: 'success',
                    title: 'Order Product Successfully',
                    text: 'Your order will deliver to your address, as soon as possible!',
                });
            }

            // Submit the form
            this.submit();
        });
    });

    var orderModal = document.getElementById('orderModal');
    orderModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productId = button.getAttribute('data-product-id');
        var modalProductId = document.getElementById('modalProductId');
        modalProductId.value = productId;
    });
    </script>



@endsection
