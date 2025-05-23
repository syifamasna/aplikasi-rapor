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

        .col-md-6 label {
            color: #a3a3a3;
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
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Grafik Prestasi per Kelas</h5>
                                <div class="form-group mb-3">
                                    <label for="schoolYearSelect">Tahun Pelajaran</label>
                                    <select id="schoolYearSelect" class="form-control">
                                        @foreach ($schoolYears as $year)
                                            <option value="{{ $year->id }}"
                                                {{ $year->id == $selectedSchoolYearId ? 'selected' : '' }}>
                                                {{ $year->tahun_awal }}/{{ $year->tahun_akhir }} -
                                                {{ $year->semester }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
            gradient.addColorStop(0, 'rgba(241, 196, 15, 0.8)');
            gradient.addColorStop(1, 'rgba(243, 156, 18, 0.2)');

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
                    borderColor: 'rgba(243, 156, 18, 1)',
                    borderWidth: 1,
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return ` ${tooltipItem.yLabel} Prestasi`;
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: adjustedMin,
                                stepSize: 1, // supaya 1 langsung ke 2, bukan 1.5
                                precision: 0
                            }
                        }]
                    }
                }
            };

            new Chart(ctx, config);
        });

        // Ketika dropdown tahun ajaran diubah, reload dengan query
        document.getElementById('schoolYearSelect').addEventListener('change', function() {
            const schoolYearId = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('school_year_id', schoolYearId);
            window.location.href = url.toString();
        });
    </script>

</body>

</html>
