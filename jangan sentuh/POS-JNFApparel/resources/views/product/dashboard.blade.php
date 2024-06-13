@extends('Pages.master')
@section('pages', 'Product')
@section('description', 'Here are the list of product available in store')
@section('content')
    <main class="py-3">
        <div class="container">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('product.new') }}" class="btn btn-primary">Add Product</a>
                        </div>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td><img src="{{ asset('storage/images/' . $item->pictures) }}" alt=""
                                                width="100" class="rounded"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>Rp {{ $item->price }}</td>
                                        <td>
                                            <a href="{{ route('product.edit', $item->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger"
                                                onclick="confirmDelete('{{ route('product.delete', $item->id) }}')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
        <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
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
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Deleted Successfully!'
                        });
                    }
                });
            }
        </script>
    </main>
@endsection
