@extends('layout.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f9f9f9;
  color: #333;
  margin: 0;
  padding: 0;
}

.container1 {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
  border: 1px solid #ddd;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  margin: 15px auto;
  width: 80%;
}

.left {
  flex: 0 0 17%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.right {
  flex: 1 1 0%;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

h3, h5, h6 {
  margin: 0;
}

.pdf-button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #ff4747;
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s, transform 0.2s;
  margin-top: 10px;
  margin-left: auto;
}
.pdf-button:hover {
  background-color: #cc3b3b;
  transform: scale(1.05);
}

.img-custom {
  width: 100%;
  max-width: 150px;
  height: auto;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 10px;
  transition: transform 0.2s;
}

.img-custom:hover {
  transform: scale(1.05);
}

hr {
  border: 0;
  border-top: 1px solid #eee;
  margin: 20px auto;
  width: 80%;
}

.pargarafmodul {
  text-align: justify;
  margin-top: 10px;
  line-height: 1.6;
  color: #333;
}

.pagination {
    display: flex;
    justify-content: center;
    margin: 20px 0;
    list-style: none;
    padding: 0;
}

.pagination .page-item {
    margin: 0 5px;
}

.pagination .page-link {
    display: inline-block;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

.pagination .page-link:hover {
    background-color: #ff4747;
    color: #fff;
}

.pagination .active .page-link {
    background-color: #ff4747;
    color: #fff;
    border-color: #ff4747;
    font-weight: bold;
}


</style>
</head>
<body>
    <hr>
    @foreach($modulPembelajaran as $index => $modul)
    <div class="container1">
        <div class="left">
            @if($modul->image)
            <img src="{{ asset('storage/' . $modul->image) }}" alt="Gambar Modul" class="img-custom">
            @else
            <img src="{{ asset('User-depan/images/2022.png') }}" alt="Placeholder Gambar" class="img-custom">
            @endif
            <h5>Waktu Upload</h5>
            <h6>{{ $modul->created_at->format('d F Y, H:i') }}</h6>
        </div>
        <div class="right">
            <h3>
                Modul Pembelajaran {{ ($modulPembelajaran->currentPage() - 1) * $modulPembelajaran->perPage() + $loop->iteration }}:
                {{ $modul->title }}
            </h3>

            <p class="pargarafmodul">{{ $modul->description }}</p>
            <a href="{{ asset('storage/' . $modul->file) }}" target="_blank" class="pdf-button">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
        </div>
    </div>
    <hr>
    @endforeach

    @if($modulPembelajaran->isEmpty())
        <div class="container1">
            <h3>Modul Pembelajaran</h3>
            <h2>Tidak ada modul pembelajaran tersedia</h2>
            <p>Silakan cek kembali nanti.</p>
        </div>
    @endif

    <!-- Pagination Links -->
    <div class="pagination">
        {{ $modulPembelajaran->appends(request()->input())->links('user.fitur.custom-pagination-view') }}
    </div>

</body>
</html>
@endsection
