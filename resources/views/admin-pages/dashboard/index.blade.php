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

    @include('admin-pages.components.preloader')

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('admin-pages.components.sidebar')
        @include('admin-pages.components.topbar')

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
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('admin.students.index') }}" class="text-decoration-none">
                            <div class="card">
                                <div class="stat-widget-one card-body text-primary">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-user border-primary"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Data Siswa</div>
                                        <div class="stat-digit">{{ $totalSiswa }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('admin.subjects.index') }}" class="text-decoration-none">
                            <div class="card">
                                <div class="stat-widget-one card-body text-success">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-book border-success"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Data Mapel</div>
                                        <div class="stat-digit">{{ $totalMapel }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('admin.student_classes.index') }}" class="text-decoration-none">
                            <div class="card">
                                <div class="stat-widget-one card-body text-info">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-home border-info"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Data Kelas</div>
                                        <div class="stat-digit">{{ $totalKelas }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                            <div class="card">
                                <div class="stat-widget-one card-body text-danger">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-id-badge border-danger"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Data Pengguna</div>
                                        <div class="stat-digit">{{ $totalPengguna }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('admin.achievements.index') }}" class="text-decoration-none">
                            <div class="card">
                                <div class="stat-widget-one card-body text-warning">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-medall border-warning"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Data Prestasi</div>
                                        <div class="stat-digit">{{ $totalPrestasi }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                </div>

            </div>

            @include('admin-pages.components.footer')

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
