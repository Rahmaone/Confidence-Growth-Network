<!DOCTYPE html>
<html>
  <head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="" />

    <title>CGN</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('User-depan/css/bootstrap.css') }}" />

    <!-- fonts style -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap"
      rel="stylesheet"
    />

    <!--owl slider stylesheet -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />

    <!-- font awesome style -->
    <link href="{{ asset('User-depan/css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <!-- <link href="css/style.css" rel="stylesheet" /> -->
    <link href="{{ asset('User-depan/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('User-depan/css/responsive.css') }}" rel="stylesheet" />

  </head>

  <body>


      <!-- header section strats -->
      <header class="header_section">
        <div class="container-fluid">
          @include('guest.layout.navbar')
        </div>
      </header>
      <!-- end header section -->

    <!-- about section -->

    <section id="about" class=" layout_padding">
    <div class="container">

        <div class="row">
          <div class="col-md-6">
            <div class="img-box">
              <img src="{{ asset('User-depan/images/confiden.png') }}" alt="" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-box">
              <h2>Modul Pembelajaran</h2>
              <p>
                Melalui serangkaian modul pembelajaran yang terstruktur, aplikasi ini memberikan panduan komprehensif
                untuk memberdayakan pengguna dalam mencapai potensi penuh mereka. Modul-modul ini dirancang untuk berbagai
                aspek pengembangan pribadi dan profesional.
              </p>
              <p>
                Molestiae odio earum non qui cumque provident voluptates,
                repellendus exercitationem, possimus at iste corrupti officiis
                unde alias eius ducimus reiciendis soluta eveniet. Nobis ullam
                ab omnis quasi expedita.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end about section -->


    {{--  footer --}}
    @include('guest.layout.footer')
    <!-- client section -->

    <!-- jQery -->
    <script type="text/javascript" src="{{ asset('User-depan/js/jquery-3.4.1.min.js')}}"></script>
    <!-- popper js -->
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="{{ asset('User-depan/js/bootstrap.js') }}"></script>
    <!-- owl slider -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    ></script>
    <!-- custom js -->
    <script type="text/javascript" src="{{ asset('User-depan/js/custom.js')}}"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
    <!-- End Google Map -->
  </body>
</html>
