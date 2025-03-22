<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard {{ Auth::user()->nama }} - E-Rapor SIT Aliya</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-erapor.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .stat-widget-one {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card:hover .stat-text,
        .card:hover .stat-digit {
            color: inherit;
        }

        .card:hover .stat-icon i {
            color: inherit !important;
        }
    </style>
</head>

<body>

    @include('guru-mapel-pages.components.preloader')

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('guru-mapel-pages.components.sidebar')
        @include('guru-mapel-pages.components.topbar')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Selamat Datang, {{ Auth::user()->nama }}!</h4>
                            <p class="mb-0">Kelola nilai, absensi, dan prestasi siswa dengan mudah</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('guru_mapel.grades.index') }}" class="text-decoration-none">
                            <div class="card">
                                <div class="stat-widget-one card-body text-primary">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-book border-primary"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Data Pembelajaran</div>
                                        <div class="stat-digit">{{ $totalPembelajaran }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            @include('guru-mapel-pages.components.footer')

        </div>
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    title: "Login Berhasil",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            @endif
        });
    </script>

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

</body>

</html>
