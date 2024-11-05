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
    <div class="hero_area">
      <div class="hero_bg_box">
        <div class="bg_img_box">
          <img src="{{ asset('User-depan/images/bg.png') }}" alt="" />
        </div>
      </div>

      <!-- header section strats -->
      <header class="header_section">
        <div class="container-fluid">
          @include('guest.layout.navbar')
        </div>
      </header>
      <!-- end header section -->
      <!-- slider section -->
      <section class="slider_section">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="detail-box">
                      <h1>
                        Confidence<br/>
                        Growth Network
                      </h1>
                      <p>
                        Explicabo esse amet tempora quibusdam laudantium,
                        laborum eaque magnam fugiat hic? Esse dicta aliquid
                        error repudiandae earum suscipit fugiat molestias,
                        veniam, vel architecto veritatis delectus repellat modi
                        impedit sequi.
                      </p>
                      <div class="btn-box">
                        <a href="" class="btn1"> Selengkapnya </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="img-box">
                      <img src="{{ asset('User-depan/images/confi.png') }}" alt="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- end slider section -->
    </div>

    <!-- service section -->

    <section id="service" class="service_section layout_padding">
      <div class="service_container">
        <div class="container">
          <div class="heading_container heading_center">
            <h1>Layanan <span>kami</span></h1>
            <p>
              There are many variations of passages of Lorem Ipsum available,
              but the majority have suffered alteration
            </p>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                  <img src="{{ asset('User-depan/images/layanan1.png') }}" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Modul Pembelajaran</h5>
                  <p>
                    fact that a reader will be distracted by the readable
                    content of a page when looking at its layout. The point of
                    using
                  </p>
                  <a href=""> Read More </a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                  <img src="{{ asset('User-depan/images/layanan2.png') }}" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Chat mentor CGN</h5>
                  <p>
                    fact that a reader will be distracted by the readable
                    content of a page when looking at its layout. The point of
                    using
                  </p>
                  <a href="service.html"> Read More </a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                  <img src="{{ asset('User-depan/images/layanan3.png') }}" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Kuiz</h5>
                  <p>
                    fact that a reader will be distracted by the readable
                    content of a page when looking at its layout. The point of
                    using
                  </p>
                  <a href=""> Read More </a>
                </div>
              </div>
            </div>

            </div>
          </div>
          <div class="btn-box">
            <a href=""> View All </a>
          </div>
        </div>
      </div>
    </section>

    <!-- end service section -->

    <!-- about section -->

    <section id="about" class="about_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h1>About us</h1>
          <p>
            Magni quod blanditiis non minus sed aut voluptatum illum quisquam
            aspernatur ullam vel beatae rerum ipsum voluptatibus
          </p>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="img-box">
              <img src="{{ asset('User-depan/images/confiden.png') }}" alt="" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-box">
              <h2>We Are CGN</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available,
                but the majority have suffered alteration in some form, by
                injected humour, or randomised words which don't look even
                slightly believable. If you are going to use a passage of Lorem
                Ipsum, you need to be sure there isn't anything embarrassing
                hidden in the middle of text. All
              </p>
              <p>
                Molestiae odio earum non qui cumque provident voluptates,
                repellendus exercitationem, possimus at iste corrupti officiis
                unde alias eius ducimus reiciendis soluta eveniet. Nobis ullam
                ab omnis quasi expedita.
              </p>
              <a href=""> Read More </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end about section -->

    <!-- team section -->
    <section id="team" class="team_section layout_padding">
      <div class="container-fluid">
        <div class="heading_container heading_center">
          <h1 class="">Our <span> Team</span></h1>
        </div>

        <div class="team_container">
          <div class="row">
            <div class="col-lg-3 col-sm-6">
              <div class="box">
                <div class="img-box">
                  <img src="{{ asset('User-depan/images/team-1.jpg') }}" class="img1" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Sauqi Akbar Mubarok</h5>
                  <p>Front Pembela Islam</p>
                </div>
                <div class="social_box">
                  <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="box">
                <div class="img-box">
                  <img src="images/team-2.jpg" class="img1" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Nancy White</h5>
                  <p>Marketing Head</p>
                </div>
                <div class="social_box">
                  <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="box">
                <div class="img-box">
                  <img src="images/team-3.jpg" class="img1" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Earl Martinez</h5>
                  <p>Marketing Head</p>
                </div>
                <div class="social_box">
                  <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="box">
                <div class="img-box">
                  <img src="images/team-4.jpg" class="img1" alt="" />
                </div>
                <div class="detail-box">
                  <h5>Josephine Allard</h5>
                  <p>Marketing Head</p>
                </div>
                <div class="social_box">
                  <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
                  <a href="#">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end team section -->
    {{--  footer --}}
    @include('guest.layout.footer')
    <!-- client section -->

    <!-- jQery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- owl slider -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    ></script>
    <!-- custom js -->
    <script type="text/javascript" src="js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
    <!-- End Google Map -->
  </body>
</html>
