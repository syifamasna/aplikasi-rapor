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

        .card-widget {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .card-widget:hover {
            transform: scale(1.05);
        }

        .card-widget:hover .stat-text,
        .card-widget:hover .stat-digit,
        .card-widget:hover .stat-icon i {
            color: inherit !important;
        }

        #genderChart {
            max-height: 200px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    @include('wali-kelas-pages.components.preloader')

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('wali-kelas-pages.components.sidebar')
        @include('wali-kelas-pages.components.topbar')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Selamat Datang, {{ Auth::user()->nama }}!</h4>
                            <p class="mb-0">Pantau perkembangan siswa dan cetak rapor dengan cepat</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-4 col-sm-12">
                        <a href="{{ route('wali_kelas.student_classes.students') }}" class="text-decoration-none">
                            <div class="card card-widget">
                                <div class="stat-widget-one card-body text-primary">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-user border-primary"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Total Siswa</div>
                                        <div class="stat-digit">{{ $totalSiswa }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Grafik Jenis Kelamin {{ $class->nama ?? '-' }}</h5>
                                <canvas id="genderChart" width="200" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @include('wali-kelas-pages.components.footer')

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
    <script src="{{ asset('assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script>
        const genderChartCtx = document.getElementById('genderChart').getContext('2d');

        new Chart(genderChartCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{{ $jumlahLaki }}, {{ $jumlahPerempuan }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

</body>

</html>
