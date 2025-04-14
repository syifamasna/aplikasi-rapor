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
    </style>
</head>

<body>

    @include('pj-prestasi-pages.components.preloader')

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        @include('pj-prestasi-pages.components.sidebar')
        @include('pj-prestasi-pages.components.topbar')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Selamat Datang, {{ Auth::user()->nama }}!</h4>
                            <p class="mb-0">Input dan kelola data prestasi siswa dengan mudah</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-4 col-sm-12">
                        <a href="{{ route('pj_prestasi.achievements.index') }}" class="text-decoration-none">
                            <div class="card card-widget">
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
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="card-header bg-gradient-primary text-white">
                                <h5 class="mb-0">Grafik Prestasi per Kelas</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="prestasiChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @include('pj-prestasi-pages.components.footer')

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
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('prestasiChart').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, '#f1c40f');
            gradient.addColorStop(1, '#f39c12'); // lebih gelap untuk gradasi

            const data = {
                labels: {!! json_encode($prestasiPerKelas->pluck('kelas')) !!},
                datasets: [{
                    label: 'Jumlah Prestasi',
                    data: {!! json_encode($prestasiPerKelas->pluck('total')) !!},
                    backgroundColor: gradient,
                    borderColor: '#f1c40f',
                    borderWidth: 1,
                    hoverBackgroundColor: '#f39c12'
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return ` ${context.parsed.y} prestasi`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Prestasi'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Kelas'
                            }
                        }
                    }
                }
            };

            new Chart(ctx, config);
        });
    </script>
</body>

</html>
