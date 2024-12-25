@extends('admin.layouts.app', ['page' => __('modulPembelajaran'), 'pageSlug' => 'Modul_Pembelajaran/modulPembelajaran'])

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="title mb-0">Tambah Modul Pembelajaran</h1>
                <small>Lengkapi informasi modul pembelajaran di bawah ini.</small>
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
                    <form action="{{ route('admin.createModul') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Modul -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Nama Modul</label>
                            <input
                                type="text"
                                class="form-control"
                                id="title"
                                name="title"
                                placeholder="Masukkan nama modul"
                                required
                                oninput="generateSlug()"
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea
                                class="form-control"
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Masukkan deskripsi modul"
                                required
                                style="resize: vertical; border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 10px; min-height: 120px;"
                            ></textarea>
                        </div>

                        <!-- Upload File -->
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File Modul</label>
                            <input
                                type="file"
                                class="form-control"
                                id="file"
                                name="file"
                                required
                                style="border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
                            >
                            <small class="text-muted">Format yang diizinkan: PDF, DOC, DOCX. Maksimum ukuran: 10MB.</small>
                        </div>
                        <!-- Upload Gambar -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Gambar Modul</label>
                            <input
                                type="file"
                                class="form-control"
                                id="image"
                                name="image"
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



<script>
    function generateSlug() {
        const title = document.getElementById('title').value;
        const slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    }
</script>
@endsection
