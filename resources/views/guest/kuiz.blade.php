@extends('layout.app')

@section('title', 'kuiz')

@section('content')
<!-- About Section Starts -->
<section id="about" class=" about_section2 layout_padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="img-box">
          <img
            src="{{ asset('User-depan/images/chatmentor.png') }}"
            alt="Modul Pembelajaran" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <h2>Kuiz</h2>
          <p>
            Fitur "Kuis" pada aplikasi Confident Growth Network adalah alat interaktif yang dirancang untuk menguji
            dan memperkuat pemahaman pengguna terhadap materi yang telah dipelajari dalam berbagai modul pembelajaran.
            Kuis ini terdiri dari serangkaian pertanyaan yang relevan dengan topik yang diajarkan,
            dirancang untuk membantu pengguna mengevaluasi kemajuan mereka dan mengidentifikasi area yang memerlukan
            perhatian lebih lanjut.
          </p>
          <br>
          <h2>Tujuan Kuiz</h2>
          <p>
            Memberikan umpan balik langsung kepada pengguna tentang jawaban mereka,
            sehingga mereka dapat mengetahui kesalahan dan memperbaikinya segera.
            Umpan balik ini juga membantu memperkuat pembelajaran dan memori.
          </p>
          <br>
          <h2>Manfaat kuiz</h2>
          <p>
            Kuis membantu memperkuat retensi informasi melalui pengulangan dan peninjauan materi.
            Mengambil kuis setelah mempelajari materi dapat membantu pengguna menyimpan informasi lebih lama
          <div class="btn-box">
            <a href="{{route('pelaksanaankuiz')}}" class="btn1"> Mulai Kuis </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About Section Ends -->
@endsection