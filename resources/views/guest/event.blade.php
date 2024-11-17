@extends('layout.app')

@section('content')
    <!-- About Section Starts -->
    <section id="about" class=" about_section2 layout_padding">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="img-box">
              <img
                src="{{ asset('User-depan/images/chatmentor.png') }}"
                alt="Modul Pembelajaran"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-box">
              <h2>Event</h2>
              <p>
                Fitur "Chat Mentor" pada aplikasi Confident Growth Network dirancang untuk memberikan bimbingan,
                dukungan, dan motivasi kepada pengguna dalam perjalanan pengembangan pribadi mereka.
                Fitur ini memungkinkan pengguna untuk berinteraksi langsung dengan mentor yang berpengalaman
                dan mendapatkan nasihat yang dipersonalisasi sesuai kebutuhan mereka.
              </p>
              <br>
              <h2>Tujuan Chat mentor</h2>
              <p>
                Fitur "Chat Mentor" bertujuan untuk menyediakan dukungan dan bimbingan langsung kepada pengguna.
                Ini mencakup jawaban atas pertanyaan, panduan dalam mengikuti modul pembelajaran, serta bantuan dalam
                 mengatasi tantangan yang dihadapi pengguna.
              </p>
              <br>
              <h2>Manfaat Chat Mentor</h2>
              <p>
                Jika pengguna mengalami kesulitan atau hambatan dalam proses belajar, mereka bisa segera menghubungi mentor untuk
                mendapatkan solusi cepat. Ini mengurangi waktu yang dihabiskan untuk mencari
                jawaban dan memungkinkan pengguna untuk terus maju dalam pembelajaran mereka.
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Section Ends -->

@endsection
