@extends('layout.app')

@section('content')
    <div class="hero_area">
      <div class="hero_bg_box" >
        <div class="bg_img_box" style="height: 100%">
            <svg style="margin: 0; padding: 0"xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1440 700">
                <g mask="url(&quot;#SvgjsMask1114&quot;)" fill="none">
                    <rect width="1440" height="700" x="0" y="0" fill="rgba(53, 94, 59, 1)"></rect>
                    <path d="M779.7835259122567 622.1573901419113L890.4845236623273 688.6732601769874 957.0003936974034 577.9722624269166 846.2993959473328 511.45639239184055z" fill="rgba(91, 134, 81, 0.38)" class="triangle-float3"></path>
                    <path d="M1259.5094499191755 188.48854588929046L1130.3637229982014 204.3456472617687 1146.2208243706796 333.49137418274285 1275.3665512916536 317.63427281026463z" fill="rgba(91, 134, 81, 0.38)" class="triangle-float1"></path>
                    <path d="M1308.6913478788645 562.4107413795418L1404.4101230687152 689.6860337531015 1461.0323287169704 562.5104776475534z" fill="rgba(91, 134, 81, 0.38)" class="triangle-float2"></path>
                    <path d="M177.966,328.47C215.378,327.376,247.783,306.563,268.151,275.162C290.845,240.175,307.153,196.645,287.239,160.004C266.682,122.18,220.989,107.732,177.966,109.226C137.663,110.626,101.379,132.31,81.094,167.164C60.681,202.238,57.266,245.927,78.159,280.717C98.51,314.605,138.454,329.625,177.966,328.47" fill="rgba(91, 134, 81, 0.38)" class="triangle-float1"></path>
                    <path d="M1151.0060707043465 446.3316048279115L1250.6533264335155 314.09523012383283 1118.416951729437 214.4479743946638 1018.7696960002678 346.6843490987424z" fill="rgba(91, 134, 81, 0.38)" class="triangle-float3"></path>
                    <path d="M971.3837798219473 296.6150355764987L1127.1332225579406 356.57201180681307 1106.829356062995 212.10249490134504z" fill="rgba(91, 134, 81, 0.38)" class="triangle-float2"></path>
                    <path d="M352.568,694.078C404.139,694.627,452.738,670.576,480.428,627.066C510.395,579.977,521.854,519.959,494.25,471.447C466.399,422.501,408.811,399.505,352.568,402.36C301.005,404.977,258.84,439.525,233.785,484.667C209.548,528.337,204.694,580.952,229.336,624.395C254.29,668.388,301.993,693.54,352.568,694.078" fill="rgba(91, 134, 81, 0.38)" class="triangle-float2"></path>
                    <path d="M704.832,257.959C728.949,257.212,752.881,247.548,764.561,226.435C775.931,205.883,769.787,181.563,758.486,160.974C746.628,139.369,729.438,119,704.832,117.617C678.14,116.117,653.189,131.266,639.606,154.292C625.799,177.697,623.864,207.342,638.336,230.342C652.035,252.115,679.12,258.755,704.832,257.959" fill="rgba(91, 134, 81, 0.38)" class="triangle-float2"></path>
                    <path d="M-4.62034992879461 366.5118846433642L-48.28716301786492 500.90451640850483 86.10546874727567 544.5713294975751 129.77228183634597 410.17869773243456z" fill="rgba(91, 134, 81, 0.38)" class="triangle-float1"></path>
                </g>
                <defs>
                    <mask id="SvgjsMask1114">
                        <rect width="1440" height="700" fill="#ffffff"></rect>
                    </mask>
                    <style>
                        @keyframes float1 {
                                0%{transform: translate(0, 0)}
                                50%{transform: translate(-10px, 0)}
                                100%{transform: translate(0, 0)}
                            }

                            .triangle-float1 {
                                animation: float1 5s infinite;
                            }

                            @keyframes float2 {
                                0%{transform: translate(0, 0)}
                                50%{transform: translate(-5px, -5px)}
                                100%{transform: translate(0, 0)}
                            }

                            .triangle-float2 {
                                animation: float2 4s infinite;
                            }

                            @keyframes float3 {
                                0%{transform: translate(0, 0)}
                                50%{transform: translate(0, -10px)}
                                100%{transform: translate(0, 0)}
                            }

                            .triangle-float3 {
                                animation: float3 6s infinite;
                            }
                    </style>
                </defs>
            </svg>
        </div>
    </div>


      <!-- header section strats -->
      {{-- <header class="header_section">
        <div class="container-fluid">
          @include('guest.layout.navbar')
        </div>
      </header> --}}
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
                        Aplikasi Confident Growth Network adalah platform inovatif yang dirancang untuk membantu individu dalam mengembangkan kepercayaan diri dan keterampilan pertumbuhan pribadi mereka.
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
    <svg id="wave" style="transform:rotate(180deg); transition: 0.3s; margin: 0; padding: 0" viewBox="0 0 1440 380" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(53, 94, 59, 1)" offset="0%"></stop><stop stop-color="rgba(91, 134, 81, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,38L48,76C96,114,192,190,288,234.3C384,279,480,291,576,266C672,241,768,177,864,133C960,89,1056,63,1152,57C1248,51,1344,63,1440,82.3C1536,101,1632,127,1728,145.7C1824,165,1920,177,2016,152C2112,127,2208,63,2304,63.3C2400,63,2496,127,2592,145.7C2688,165,2784,139,2880,126.7C2976,114,3072,114,3168,107.7C3264,101,3360,89,3456,88.7C3552,89,3648,101,3744,95C3840,89,3936,63,4032,63.3C4128,63,4224,89,4320,107.7C4416,127,4512,139,4608,139.3C4704,139,4800,127,4896,126.7C4992,127,5088,139,5184,139.3C5280,139,5376,127,5472,126.7C5568,127,5664,139,5760,139.3C5856,139,5952,127,6048,126.7C6144,127,6240,139,6336,139.3C6432,139,6528,127,6624,101.3C6720,76,6816,38,6864,19L6912,0L6912,380L6864,380C6816,380,6720,380,6624,380C6528,380,6432,380,6336,380C6240,380,6144,380,6048,380C5952,380,5856,380,5760,380C5664,380,5568,380,5472,380C5376,380,5280,380,5184,380C5088,380,4992,380,4896,380C4800,380,4704,380,4608,380C4512,380,4416,380,4320,380C4224,380,4128,380,4032,380C3936,380,3840,380,3744,380C3648,380,3552,380,3456,380C3360,380,3264,380,3168,380C3072,380,2976,380,2880,380C2784,380,2688,380,2592,380C2496,380,2400,380,2304,380C2208,380,2112,380,2016,380C1920,380,1824,380,1728,380C1632,380,1536,380,1440,380C1344,380,1248,380,1152,380C1056,380,960,380,864,380C768,380,672,380,576,380C480,380,384,380,288,380C192,380,96,380,48,380L0,380Z"></path></svg>


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
                    <i class="tim-icons tim-icons-60 icon-book-bookmark" aria-hidden="true"></i>
                </div>
                <div class="detail-box">
                  <h5>Modul Pembelajaran</h5>
                  <p>
                    "Akses modul pembelajaran interaktif CGN. Tingkatkan
                     keterampilan dan kepercayaan diri Anda kapan saja, di mana saja,
                     |dengan materi berkualitas tinggi."
                  </p>
                  <a href="{{route('service')}}"> Baca selengkapnya </a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                    <i class="tim-icons tim-icons-60 icon-chat-33" aria-hidden="true"></i>
                </div>
                <div class="detail-box">
                  <h5>Chat mentor CGN</h5>
                  <p>
                    Temui mentor kami yang siap membantu Anda setiap saat! Dapatkan bimbingan langsung,
                    tips praktis, dan solusi cepat untuk semua pertanyaan Anda.
                  </p>
                  <a href="{{route('chatmentor')}}"> Baca selengkapnya </a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                    <i class="tim-icons tim-icons-60 icon-bulb-63" aria-hidden="true"></i>
                </div>
                <div class="detail-box">
                  <h5>Kuiz</h5>
                  <p>
                    "Dapatkan umpan balik instan dari kuis kami dan tingkatkan pengetahuan Anda.
                    Setiap pertanyaan adalah kesempatan untuk belajar lebih baik."
                  </p>
                  <a href="{{route('kuiz')}}"> Baca selengkapnya </a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                  <div class="img-box">
                      <i class="tim-icons tim-icons-60 icon-calendar-60" aria-hidden="true"></i>
                  </div>
                  <div class="detail-box">
                    <h5>Event</h5>
                    <p>
                        "Ikuti event modul CGN dan raih peluang luar biasa untuk belajar langsung dari ahli.
                        Tingkatkan pengetahuan dan keterampilan Anda bersama komunitas yang mendukung."
                    </p>
                    <a href=""> Baca selengkapnya </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- end service section -->

    <!-- about section -->

    <section id="about" class="about_section layout_padding svg_container">
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
          <h1 class="">Our <span> Mentor</span></h1>
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

    <!-- client section -->
@endsection


