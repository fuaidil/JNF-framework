@extends('Pages.master')
@section('pages', 'My Profile')
@section('description', 'The details information about your private data')   
@section('content')
    <main class="py-3">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/images/faces/1.jpg') }}"
                                alt="" class="img-fluid rounded-center mb-3">
                            <h3>{{ $user->name }}</h3>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('profile.add') }}" method="post">
                                @csrf
                                <h3>Edit Profile</h3>
                                <hr>
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ $user->email }}" required>
                                </div>
                                {{-- @foreach ($profile as $profile) --}}
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            value="{{ $profile ? $profile->phone : '' }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" id="dob" class="form-control"
                                            value="{{ $profile ? $profile->dob : '' }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="{{ $profile ? $profile->address : '' }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="{{ $profile ? $profile->gender : '' }}">
                                                {{ $profile ? $profile->gender : '' }}
                                            </option>
                                            <option value="Laki-Laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                {{-- @endforeach --}}
                                {{-- <h3>Change Password</h3>
                                <hr>
                                <div class="mb-3">
                                    <label for="password">New Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div> --}}

                                <button class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
