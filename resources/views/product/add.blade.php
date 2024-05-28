@extends('Pages.master')
@section('pages', 'Add Product')
@section('description', 'Add the newest products & stay up to date')
@section('content')
    <main class="py-3">
        <div class="container">
            <form id="addProductForm" action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/product.jpg') }}" alt=""
                                class="img-fluid img-thumbnail mb-3" id="image-preview">
                            <div>
                                <label for="image" class="form-label">Product Image</label>
                                <input class="form-control" name="image" type="file" id="image">
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
                                <label for="category">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary"  onclick="submitForm()">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        const imgInput = document.getElementById('image')
        const imgPreview = document.getElementById('image-preview')

        imgInput.onchange = evt => {
            const [file] = imgInput.files
            if (file) {
                imgPreview.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script>
        function submitForm() {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Product Added Successfully',
            }).then(() => {
                document.getElementById('addProductForm').submit();
            });
        }
    </script>
@endsection
