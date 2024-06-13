@extends('Pages.master')
@section('pages', 'Add Category')
@section('description', 'Add the newest category for the products')
@section('content')
    <main class="py-3">
        <div class="container">
            <hr>
            <form id="addCategoryForm" action="{{ route('category.add') }}" method="POST">
                @csrf
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <button class="btn btn-primary"  onclick="submitForm()">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        function submitForm() {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Category Added Successfully',
            }).then(() => {
                document.getElementById('addCategoryForm').submit();
            });
        }
    </script>
@endsection
