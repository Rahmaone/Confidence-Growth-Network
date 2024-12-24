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
            src="{{ asset('User-depan/images/modul.png') }}"
            alt="Modul Pembelajaran" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <h2>Modul Pembelajaran</h2>
          <p>
            Melalui serangkaian modul pembelajaran yang terstruktur,
            aplikasi ini memberikan panduan komprehensif untuk
            memberdayakan pengguna dalam mencapai potensi penuh mereka.
            Modul-modul ini dirancang untuk berbagai aspek pengembangan
            pribadi dan profesional.
          </p>
          <br>
          <h2>Tujuan Modul Pembelajaran</h2>
          <p>
            Membantu pengguna mengembangkan rasa percaya diri yang kuat
            melalui teknik dan latihan khusus yang dirancang untuk
            meningkatkan self-esteem dan mengatasi keraguan diri.
          </p>
          <br>
          <h2>Manfaat Modul Pembelajaran</h2>
          <p>
            Pengguna akan merasa lebih percaya diri dan mandiri dalam menghadapi berbagai
            tantangan dan situasi, baik dalam kehidupan pribadi maupun profesional.
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About Section Ends -->

@endsection