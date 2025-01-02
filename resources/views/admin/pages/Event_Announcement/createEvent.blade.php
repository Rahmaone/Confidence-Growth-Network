@extends('admin.layouts.app', ['page' => __('eventManagement'), 'pageSlug' => 'Events/create'])

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="title mb-0">Tambah Event</h1>
                <small>Lengkapi informasi event di bawah ini.</small>
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
                    <form action="{{ route('admin.simpanEvent') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Event -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Event</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nama"
                                name="nama"
                                placeholder="Masukkan nama event"
                                required
                                oninput="generateSlug()"
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <!-- Mentor -->
                        <div class="mb-3">
                            <label for="mentor" class="form-label">Mentor</label>
                            <input
                                type="text"
                                class="form-control"
                                id="mentor"
                                name="mentor"
                                placeholder="Masukkan nama mentor"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea
                                class="form-control"
                                id="deskripsi"
                                name="deskripsi"
                                rows="5"
                                placeholder="Masukkan deskripsi..."
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 10px;"
                            ></textarea>
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="lokasi"
                                name="lokasi"
                                placeholder="Masukkan lokasi event"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <!-- Waktu Mulai -->
                        <div class="mb-3">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="waktu_mulai"
                                name="waktu_mulai"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <!-- Waktu Selesai -->
                        <div class="mb-3">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input
                                type="datetime-local"
                                class="form-control"
                                id="waktu_selesai"
                                name="waktu_selesai"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <!-- Upload Gambar -->
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar Event</label>
                            <input
                                type="file"
                                class="form-control"
                                id="gambar"
                                name="gambar"
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                            <small class="text-muted">Format yang diizinkan: JPEG, PNG, JPG, GIF. Maksimum ukuran: 2MB.</small>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <input
                                type="hidden"
                                id="slug"
                                name="slug"
                                required
                            >
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

<script>
    function generateSlug() {
        const nama = document.getElementById('nama').value;
        const slug = nama.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    }
</script>
@endsection
