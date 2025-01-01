@extends('admin.layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <h1 class="card-title">Edit User</h1>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.updateUser', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <!-- Nama User -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama User</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
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
                            value="{{ old('role', $user->role) }}"
                            required
                            style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                        >
                            <option value="" disabled selected>Masukkan role</option>
                            <option value="user">User</option>
                            <option value="mentor">Mentor</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <!-- Gambar yang Sudah Diunggah -->
                    @if($user->image_path)
                        <div style="margin-right: 40px;"> <!-- Menambahkan jarak dengan margin -->
                            <label>Gambar yang Sudah Diunggah</label>
                            <p>
                                <img src="{{ asset('storage/' . $user->image_path) }}" alt="Gambar Modul" width="150" class="img-thumbnail">
                            </p>
                        </div>
                    @else
                        <div class="me-3">
                            <p class="text-danger">Tidak ada gambar yang diunggah.</p>
                        </div>
                    @endif

                    <!-- Upload Gambar -->
                    <div>
                        <label for="image_path" class="form-label">Upload Gambar Profil User</label>
                        <input
                            type="file"
                            class="form-control"
                            id="image_path"
                            name="image_path"
                            style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                        >
                        <small class="text-muted">Format yang diizinkan: JPEG, PNG, JPG, GIF. Maksimum ukuran: 2MB.</small>
                    </div>

                <!-- Tombol -->
                <div class="d-flex">
                    <a href="{{ route('admin.userManagement') }}" class="btn btn-secondary mr-3">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
