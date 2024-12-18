@extends('admin.layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <h1 class="card-title">Manajemen Modul Pembelajaran</h1>
        </div>
        <div class="card-body">
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

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Modul</th>
                            <th>Deskripsi</th>
                            <th>Slug</th>
                            <th>File</th>
                            <th>Gambar</th>
                            <th>Waktu Pembuatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($ModulPembelajaran->count() > 0)
                            @foreach($ModulPembelajaran as $modul)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $modul->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($modul->description, 50) }}</td>
                                    <td>{{ $modul->slug }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $modul->file) }}" target="_blank" class="btn btn-link text-primary">
                                            <i class="fas fa-file-pdf"></i> Download PDF
                                        </a>
                                    </td>
                                    <td>
                                        @if($modul->image)
                                            <img src="{{ asset('storage/' . $modul->image) }}" alt="Gambar Modul" width="100">
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>

                                    <td>{{ $modul->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.editModul', $modul->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.deleteModul', $modul->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus modul ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada modul ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
@endsection
