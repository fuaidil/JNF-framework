@extends('Pages.master')
@section('pages', 'Add Admin')
@section('description', 'Admin can be registered only by the previous admin')
@section('content')
    <main class="py-3">
        <div class="container">
            <hr>
            <form id="addAdminForm" action="{{ route('add') }}" method="POST">
                @csrf
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="verify_password">Verify Password</label>
                                <input type="password" name="verify_password" id="verify_password" class="form-control" required>
                            </div>
                            <button class="btn btn-primary" onclick="submitForm()">Submit</button>
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
                title: 'User Added Successfully',
            }).then(() => {
                document.getElementById('addAdminForm').submit();
            });
        }
    </script>
@endsection
