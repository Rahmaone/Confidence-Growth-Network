@extends('layout.app')

@section('content')
<div class="heading_container heading_center layout_padding" style="margin-bottom:-14vh;">
  <h1>Tentang <span>Kami</span></h1>
</div>

<!-- About Section Starts -->
<section id="about" class="about_section2 layout_padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="img-box">
          <img
            src="{{ asset('User-depan/images/about.png') }}"
            alt="Modul Pembelajaran"
            class="img-fluid"
          />
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <h2>Pengertian</h2>
          <p>
            Confidence Growth Network (CGN), sebuah aplikasi yang menawarkan berbagai fitur
            interaktif yang bertujuan untuk membantu penggunanya meningkatkan rasa percaya diri
            melalui berbagai latihan, umpan balik positif, dan pembelajaran tentang mindset yang mendukung.
          </p>
          <br>
          <h2>Fitur Utama</h2>
          <ul>
            <li>Modul pembelajaran</li>
            <li>Chat mentor</li>
            <li>Kegiatan seminar (event)</li>
            <li>Kuis</li>
          </ul>
          <br>
          <h2>Penutup</h2>
          <p>
            Aplikasi ini diharapkan memberikan pengalaman belajar
            yang menarik dan menyenangkan, sekaligus mendukung
            pengembangan keterampilan yang relevan. Kami percaya bahwa
            belajar adalah perjalanan yang berkelanjutan, dan kami di
            sini untuk mendampingi setiap langkah Anda.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About Section Ends -->

@endsection
