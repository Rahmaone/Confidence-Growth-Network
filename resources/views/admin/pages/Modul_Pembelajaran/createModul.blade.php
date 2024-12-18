@extends('admin.layouts.app', ['page' => __('modulPembelajaran'), 'pageSlug' => 'Modul_Pembelajaran/modulPembelajaran'])

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="title">Tambah Modul Pembelajaran</h1>
                <p class="category">Lengkapi informasi modul pembelajaran di bawah ini.</p>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column">
                    {{-- Form Start --}}
                    <form action="{{ route('admin.createModul') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Nama Modul</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File Modul</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
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
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
            .replace(/^-+|-+$/g, '');   // Trim leading or trailing hyphens
        document.getElementById('slug').value = slug;
    }
</script>
@endsection
