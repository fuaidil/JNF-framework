@extends('Pages.master')
@section('pages', 'Product Catalog')
@section('description', 'Here are all our product, you can add it to your cart.')
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
                                <h4 class="card-title">{{ $item->name }}</h4>
                                <span class="badge bg-light-secondary">{{ $item->category->name }}</span>
                            </div>
                            <img class="w-100 img-fluid" src="{{ asset('storage/images/' . $item->pictures) }}"
                                alt="Card image cap">
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <span>Rp {{ $item->price }}</span>
                            <form action="{{ route('cart.add') }}" method="post" id="addToCartForm{{ $item->id }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <script>
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                if (event.submitter && event.submitter.classList.contains('btn-primary')) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Product added to cart successfully!',
                    });
                }

                // Submit the form
                this.submit();
            });
        });
    </script>



@endsection
