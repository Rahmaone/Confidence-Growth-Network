@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Manajemen Modul Pembelajaran</h1>

        <!-- Form Pencarian -->
        {{-- <form action="{{ route('modul.index') }}" method="GET">
            <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}" required>
            <select name="type">
                <option value="title" {{ request('type') == 'title' ? 'selected' : '' }}>Judul</option>
                <option value="description" {{ request('type') == 'description' ? 'selected' : '' }}>Deskripsi</option>
                <option value="slug" {{ request('type') == 'slug' ? 'selected' : '' }}>Slug</option>
            </select>
            <button type="submit">Cari</button>
        </form> --}}

        <!-- Tabel Data Modul Pembelajaran -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Modul</th>
                    <th>Deskripsi</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($ModulPembelajaran->count() > 0)
                    @foreach($ModulPembelajaran as $modul)
                        <tr>
                            <td>{{ $modul->id }}</td>
                            <td>{{ $modul->title }}</td>
                            <td>{{ $modul->description }}</td>
                            <td>{{ $modul->slug }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $modul->file) }}" target="_blank">Download</a>
                            </td>
                            <td>{{ $modul->created_at}}</td>
                            <td>
                                {{-- <form action="{{ route('admodul.destroy', $modul->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">Tidak ada modul ditemukan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
