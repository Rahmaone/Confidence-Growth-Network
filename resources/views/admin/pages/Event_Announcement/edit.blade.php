@extends('admin.layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <h1 class="card-title">Edit Event</h1>
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

            <form action="{{ route('admin.updateEvent', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Event -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Event</label>
                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama', $event->nama) }}"
                        required
                        style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                    >
                </div>

                <!-- Mentor -->
                <div class="mb-3">
                    <label for="mentor" class="form-label">Mentor</label>
                    <input
                        type="text"
                        name="mentor"
                        class="form-control"
                        value="{{ old('mentor', $event->mentor) }}"
                        required
                        style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                    >
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input
                        type="text"
                        name="lokasi"
                        class="form-control"
                        value="{{ old('lokasi', $event->lokasi) }}"
                        required
                        style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                    >
                </div>

                <!-- Waktu Mulai -->
                <div class="mb-3">
                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                    <input
                        type="datetime-local"
                        name="waktu_mulai"
                        class="form-control"
                        value="{{ old('waktu_mulai', \Carbon\Carbon::parse($event->waktu_mulai)->format('Y-m-d\TH:i')) }}"
                        required
                        style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                    >
                </div>

                <!-- Waktu Selesai -->
                <div class="mb-3">
                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                    <input
                        type="datetime-local"
                        name="waktu_selesai"
                        class="form-control"
                        value="{{ old('waktu_selesai', \Carbon\Carbon::parse($event->waktu_selesai)->format('Y-m-d\TH:i')) }}"
                        required
                        style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                    >
                </div>

                <!-- Gambar -->
                <div class="mb-3 d-flex align-items-start gap-4">
                    <!-- Gambar Lama -->
                    @if($event->gambar)
                        <div style="margin-right: 40px;">
                            <label>Gambar Lama</label>
                            <p>
                                <img src="{{ asset('storage/' . $event->gambar) }}" alt="Gambar Event" width="150" class="img-thumbnail">
                            </p>
                        </div>
                    @else
                        <div class="me-3">
                            <p class="text-danger">Tidak ada gambar yang diunggah.</p>
                        </div>
                    @endif

                    <!-- Gambar Baru -->
                    <div>
                        <label for="gambar" class="form-label">Upload Gambar Baru (Opsional)</label>
                        <input
                            type="file"
                            name="gambar"
                            class="form-control"
                            style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                        >
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex">
                    <a href="{{ route('admin.events') }}" class="btn btn-secondary mr-3">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
