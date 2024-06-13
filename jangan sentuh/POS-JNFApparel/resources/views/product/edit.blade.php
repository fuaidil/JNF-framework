@extends('Pages.master')
@section('pages', 'Edit Product')
@section('description', 'Modify the product as you go')
@section('content')
    <main class="py-3">
        <div class="container">
            <hr>
            <form id="editProductForm" method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('storage/images/' . $product->pictures) }}" alt=""
                                class="img-fluid img-thumbnail mb-3" id="image-preview">
                            <div>
                                <label for="image" class="form-label">Product Image</label>
                                <input class="form-control" name="image" type="file" id="image" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md">
                    <div class="card">
                        <div class="card-body">
                            <h3>Product Details</h3>
                            <hr>
                            <div class="mb-3">
                                <label for="category"> Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control" value="{{ $product->stock }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" class="form-control" value="{{ $product->price }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" value="">{{ $product->description }}</textarea>
                            </div>
                            <button class="btn btn-primary" onclick="editForm()">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        function editForm() {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Product Edited Successfully',
            }).then(() => {
                document.getElementById('editProductForm').submit();
            });
        }
    </script>
@endsection
