<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Landing Page - E-Rapor SIT Aliya</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('images/logo-erapor.png') }}" rel="icon">
  <link href="{{ asset('landing/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landing/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('landing/assets/css/main.css') }}" rel="stylesheet">

</head>
<style>
  .btn-custom {
    background-color: #6f42c1;
    /* Warna ungu */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    /* Membulat */
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  .btn-custom:hover {
    background-color: #5a33a2;
    /* Warna ungu lebih gelap saat hover */
    transform: scale(1.05);
    /* Efek sedikit membesar */
  }

  .logo-img {
    transform: scale(1.5); /* Ubah angkanya buat gedein */
    display: block; /* Biar gak ada space aneh */
}

</style>


<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('landing/assets/img/logorapor.png') }}" alt="Logo E-Rapor" class="logo-img">
        <h1 class="sitename">E-Rapor SIT Aliya</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda</a></li>
          <li><a href="#about">Tentang kami</a></li>
          <li><a href="#services">Fitur Unggulan</a></li>
          <li><a href="#team">Tim kami</a></li>

          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{route('login')}}">Masuk</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
            <h1>E-Rapor SIT Aliya</h1>
            <h3>Sistem Pelaporan Digital untuk Kemajuan Pendidikan</h3>

            <div class="d-flex">
              <a href="#about" class="btn-get-started">Pelajari Lebih Lanjut</a>

            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('landing/assets/img/hero-img.png')}}" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->


    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Tentang Kami<br></span>
        <h2>Tentang Kami</h2>

      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('landing/assets/img/about.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Mengenal E-Rapor SIT Aliya</h3>
            <p class="fst-italic">
              E-Rapor SIT Aliya adalah sistem pelaporan akademik digital yang mendukung digitalisasi sekolah dengan
              fitur terintegrasi. Sistem ini membantu guru, wali kelas, dan sekolah dalam mengelola data akademik secara
              lebih efisien, akurat, dan transparan.
            </p>
            <p> Manfaat utama yang ditawarkan meliputi:</p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Efisiensi Administrasi Akademik</span>
              </li>
              <li><i class="bi bi-check2-all"></i> <span>Transparansi dan Akurasi Data</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Kemudahan Akses dan Penggunaan</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Mendukung Digitalisasi Sekolah</span></li>

            </ul>
            <p>
              E-Rapor SIT Aliya hadir sebagai solusi modern dalam dunia pendidikan, dengan tujuan menciptakan sistem
              pelaporan akademik yang lebih efektif, akurat, dan sesuai dengan kebutuhan sekolah. Kami berkomitmen untuk
              memberikan kemudahan bagi tenaga pendidik dan pihak sekolah dalam mengelola data akademik, sehingga proses
              penilaian menjadi lebih efisien dan transparan.
            </p>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->




    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Fitur Unggulan</span>
        <h2>Fitur Unggulan</h2>
        <p>Fitur-Fitur Utama dalam E-Rapor SIT Aliya</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-card-checklist"></i>
              </div>
              <h3>Manajemen Nilai</h3>
              <p>Memudahkan guru dalam menginput dan mengelola nilai siswa secara digital dengan perhitungan otomatis.
              </p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-bar-chart-line"></i>
              </div>
              <h3>Pelaporan Real-Time</h3>
              <p>Guru dan wali kelas dapat melihat laporan hasil belajar siswa dengan cepat dan akurat.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-shield-lock"></i>
              </div>
              <h3>Keamanan Data</h3>
              <p>Dilengkapi autentikasi dan enkripsi untuk melindungi data akademik dari akses yang tidak sah.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-laptop"></i>
              </div>
              <h3>Akses Fleksibel</h3>
              <p>Dapat digunakan di berbagai perangkat melalui browser tanpa instalasi tambahan.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-clipboard-data"></i>
              </div>
              <h3>Monitoring Siswa</h3>
              <p>Memudahkan guru dalam memantau perkembangan akademik siswa dengan data yang tersusun rapi.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-diagram-3"></i>
              </div>
              <h3>Integrasi Sekolah</h3>
              <p>Dapat disesuaikan dengan kurikulum sekolah dan mendukung pencetakan laporan akademik.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->



    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Tim Kami</span>
        <h2>Tim Kami</h2>
        <p>Tim yang Berkontribusi dalam Pengembangan dan Operasional Sistem Ini</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="pic"><img src="{{ asset('landing/assets/img/team/team-1.jpeg')}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Siti Nur Aisah</h4>
                <span>Data Analyst & Web Designer</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <div class="pic"><img src="{{ asset('landing/assets/img/team/team-2.jpg')}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Syifa Khairunnisa Masna</h4>
                <span>Programmer 1</span>
                <div class="social">
                  <a href="https://x.com/hrgld11"><i class="bi bi-twitter-x"></i></a>
                  <a href="https://web.facebook.com/people/Syifa-Khairunisa-Masna/pfbid0n1L1kqa1N11Ecs2reKgiGy9trVcXUDnfpyr4jTc2V7V1pBoGwfWQCDheVmVustfzl/"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/hrgld11/"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="pic"><img src="{{ asset('landing/assets/img/team/team-3.jpeg')}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Aulia Putri</h4>
                <span>Programmer 2</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Kontak</span>
        <h2>Kontak</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Alamat</h3>
                  <p>Jalan Gardu Raya RT.03/RW.11 Kel. Bubulak Kec. Bogor Barat, Kota Bogor 16115</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Hubungi Kami</h3>
                  <p>+62 857 1344 0089</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Kami</h3>
                  <p>eraporsitaliyadev@gmail.com</p>
                </div>
              </div><!-- End Info Item -->

              <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3960.570870!2d106.750172!3d-6.570870!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzQnMTUuMTMiUyAxMDbCsDQ1JzAwLjYyIkU!5e0!3m2!1sen!2sid!4v1698765432100!5m2!1sen!2sid"
                frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>

          <div class="col-lg-7">

            @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif


            <form action="{{ route('contact.send') }}" method="POST" class="p-4 shadow rounded bg-white w-100">
              @csrf
              <div class="row gy-4">
                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Nama</label>
                  <input type="text" name="name" id="name-field" class="form-control" placeholder="Masukkan nama anda..." required>
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Email</label>
                  <input type="email" class="form-control" name="email" id="email-field" placeholder="Masukkan email anda..." required>
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Subjek</label>
                  <input type="text" class="form-control" name="subject" id="subject-field" placeholder="Tambahkan subjek..." required>
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Pesan</label>
                  <textarea class="form-control" name="message" rows="10" id="message-field" placeholder="Sampaikan pesan anda..." required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit" class="btn-custom">
                    <i class="bi bi-send"></i> Kirim Pesan
                  </button>
                </div>


              </div>
            </form>

          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-6">
            <h4>Hubungi Kami </h4>
          </div>
        </div>
      </div>
    </div>

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">E-Rapor SIT Aliya</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jalan Gardu Raya</p>
            <p>Kota Bogor, 16115</p>
            <p class="mt-3"><strong>Telepon:</strong> <span>+62 857 1344 0089</span></p>
            <p><strong>Email:</strong> <span>eraporsitaliyadev@gmail.com</span></p>
          </div>
        </div>


        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Link Berguna</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#hero">Beranda</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Fitur Unggulan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#team">Tim Kami</a></li>
          </ul>
        </div>



        <div class="col-lg-4 col-md-12">
          <h4>Ikuti Kami</h4>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>Copyright &copy; Aplikasi E-Rapor SIT Aliya {{ date('Y') }}</p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->

      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('landing/assets/js/main.js') }}"></script>
</body>

</html>