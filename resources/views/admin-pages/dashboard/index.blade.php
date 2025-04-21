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
                            <p class="mb-0">Pantau dan kelola seluruh data sekolah dengan efisien</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <a href="{{ route('admin.students.index') }}" class="text-decoration-none">
                            <div class="card card-widget">
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
                            <div class="card card-widget">
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
                            <div class="card card-widget">
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
                            <div class="card card-widget">
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

                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Jumlah Siswa per Kelas</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="siswaPerKelasChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
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
    <script src="{{ asset('assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script>
        // script garfik jumlah siswa per kelas
        const siswaPerKelasData = @json($siswaPerKelas);
        const ctx = document.getElementById('siswaPerKelasChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(89, 59, 219, 0.8)'); // #593bdb solid-ish
        gradient.addColorStop(1, 'rgba(89, 59, 219, 0.1)'); // faded

        const minValue = Math.min(...siswaPerKelasData.map(item => item.total));
        const adjustedMin = Math.max(minValue - 3, 0);

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: siswaPerKelasData.map(item => item.kelas),
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: siswaPerKelasData.map(item => item.total),
                    backgroundColor: gradient,
                    borderColor: '#593bdb',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: adjustedMin,
                            precision: 0
                        }
                    }]
                }
            }
        });

        // script grafik prestasi per kelas
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('prestasiChart').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, '#f1c40f');
            gradient.addColorStop(1, '#f39c12');

            const labels = {!! json_encode($prestasiPerKelas->pluck('kelas')) !!};
            const values = {!! json_encode($prestasiPerKelas->pluck('total')) !!};

            // Hitung nilai minimum dan kasih jarak
            const minValue = Math.min.apply(null, values);
            const adjustedMin = Math.max(minValue - 3, 0); // supaya gak nempel ke garis X

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Prestasi',
                    data: values,
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
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return ` ${tooltipItem.yLabel} prestasi`;
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: adjustedMin,
                                stepSize: 1, // supaya 1 langsung ke 2, bukan 1.5
                                precision: 0
                            },
                        }],
                    }
                }
            };

            new Chart(ctx, config);
        });
    </script>

</body>

</html>
