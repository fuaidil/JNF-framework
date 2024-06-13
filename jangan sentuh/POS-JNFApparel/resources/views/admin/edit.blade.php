@extends('Pages.master')
@section('pages', 'Edit Data User')
@section('description', 'Modify the users data as you go')
@section('content')
    <main class="py-3">
        <div class="container">
            <hr>
            <form id="editAdminForm" action="{{ route('update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                        required>
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
                title: 'User Edited Successfully',
            }).then(() => {
                document.getElementById('editAdminForm').submit();
            });
        }
    </script>
@endsection
