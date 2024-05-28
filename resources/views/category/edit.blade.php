@extends('Pages.master')
@section('pages', 'Category Edit')
@section('description', 'Modify the category as you go')
@section('content')
    <main class="py-3">
        <div class="container">
            <hr>
            <form id="editCategoryForm" method="POST" action="{{ route('category.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="editForm()">Submit</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        function editForm() {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Category Edited Successfully',
            }).then(() => {
                document.getElementById('editCategoryForm').submit();
            });
        }
    </script>
@endsection
