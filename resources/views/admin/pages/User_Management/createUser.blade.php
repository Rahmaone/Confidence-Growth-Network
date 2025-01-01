@extends('admin.layouts.app', ['page' => __('userManagement'), 'pageSlug' => 'User/create'])

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="title mb-0">Tambah User</h1>
                <small>Lengkapi informasi user di bawah ini.</small>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column">
                    {{-- Feedback Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Form Start --}}
                    <form action="{{ route('admin.simpanUser') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama User -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Email User</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Masukkan email user"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <!-- Nama User -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama User</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Masukkan nama user"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <!-- Password User -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Password User</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Masukkan password user"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select
                                class="form-control"
                                id="role"
                                name="role"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                                <option value="" disabled selected>Masukkan role</option>
                                <option value="user">User</option>
                                <option value="mentor">Mentor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>


                        <!-- Upload Gambar -->
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar Profil User</label>
                            <input
                                type="file"
                                class="form-control"
                                id="image_path"
                                name="image_path"
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                            <small class="text-muted">Format yang diizinkan: JPEG, PNG, JPG, GIF. Maksimum ukuran: 2MB.</small>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    {{-- Form End --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
