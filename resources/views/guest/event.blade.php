@extends('layout.app')

@section('content')
<div class="heading_container heading_center layout_padding" style="margin-bottom:-14vh ">
  <h1>Layanan <span>kami</span></h1>

</div>
<!-- About Section Starts -->
<section id="about" class=" about_section2 layout_padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="img-box">
          <img
            src="{{ asset('User-depan/images/event_announcement.png') }}"
            alt="Modul Pembelajaran" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <h2>Event</h2>
          <p>
            Event offline di Confidence Growth Network adalah kegiatan yang dilakukan
            secara tatap muka dengan tujuan untuk memperkuat jaringan, berbagi pengetahuan,
             dan meningkatkan kepercayaan diri peserta melalui interaksi langsung.
          </p>
          <br>
          <h2>Tujuan Event </h2>
          <p>
            Event offline bertujuan untuk membantu peserta mengenali dan mengembangkan
            potensi diri melalui berbagai aktivitas dan sesi pelatihan, serta memberikan
             kesempatan bagi mereka untuk bertemu dan berinteraksi dengan individu lain
            yang memiliki tujuan serupa, sehingga dapat memperluas jaringan pertemanan dan profesional.
          </p>
          <br>
          <h2>Manfaat Event</h2>
          <p>
            Event offline ini menawarkan berbagai fitur menarik, termasuk sesi pelatihan yang fokus pada pengembangan
            kepercayaan diri, keterampilan komunikasi, dan kepemimpinan melalui workshop dan seminar.
            Selain itu, terdapat sesi networking yang menyediakan waktu khusus untuk berinteraksi dan membangun
            hubungan dengan peserta lainnya. Peserta juga berkesempatan mendapatkan bimbingan langsung dari mentor berpengalaman dalam bidang pengembangan diri melalui sesi mentoring.
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About Section Ends -->

@endsection
