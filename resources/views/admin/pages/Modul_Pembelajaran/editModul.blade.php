@extends('admin.layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <h1 class="card-title">Edit Modul Pembelajaran</h1>
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

            <form action="{{ route('admin.updateModul', $modul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul Modul -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Modul</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $modul->title) }}"
                        required
                        style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                    >
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        style="resize: vertical; min-height: 120px; border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 10px;"
                        required
                    >{{ old('description', $modul->description) }}</textarea>
                </div>

                {{-- Edit file --}}
                <div class="mb-3 d-flex align-items-start gap-4">
                    <!-- File yang Sudah Ada -->
                    <div style="margin-right: 70px;">
                        <label>File yang Sudah Diunggah</label>
                        @if($modul->file)
                            <p>
                                <a href="{{ asset('storage/' . $modul->file) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fas fa-file-alt"></i> Lihat File
                                </a>
                            </p>
                        @else
                            <p class="text-danger">Tidak ada file yang diunggah.</p>
                        @endif
                    </div>

                    <!-- Upload File Baru -->
                    <div>
                        <label for="file" class="form-label">Upload File Baru (Opsional)</label>
                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                        >
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah file.</small>
                    </div>
                </div>

                <div class="mb-3 d-flex align-items-start gap-4">
                    <!-- Gambar yang Sudah Diunggah -->
                    @if($modul->image)
                        <div style="margin-right: 40px;"> <!-- Menambahkan jarak dengan margin -->
                            <label>Gambar yang Sudah Diunggah</label>
                            <p>
                                <img src="{{ asset('storage/' . $modul->image) }}" alt="Gambar Modul" width="150" class="img-thumbnail">
                            </p>
                        </div>
                    @else
                        <div class="me-3">
                            <p class="text-danger">Tidak ada gambar yang diunggah.</p>
                        </div>
                    @endif

                    <!-- Gambar Baru -->
                    <div>
                        <label for="image" class="form-label">Upload Gambar Baru (Opsional)</label>
                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                        >
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex">

                    <a href="{{ route('admin.modulPembelajaran') }}" class="btn btn-secondary mr-3">Batal</a>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
