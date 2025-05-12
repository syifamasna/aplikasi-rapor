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
                            <div class="card-body">
                                <h5 class="text-center mb-4">Jumlah Siswa per Kelas</h5>
                                <canvas id="siswaPerKelasChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center mb-4">Grafik Peringkat Nilai Tertinggi</h5>

                                {{-- Dropdown filter --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="classSelect">Kelas</label>
                                        <select id="classSelect" class="form-control">
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($classes as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ $c->id == $selectedClassId ? 'selected' : '' }}>
                                                    {{ $c->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="schoolYearSelect">Tahun Ajaran</label>
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
                                </div>

                                {{-- Grafik --}}
                                @if (count($rankingTertinggi))
                                    <div class="mt-4">
                                        <canvas id="rankingChart" height="150"></canvas>
                                    </div>
                                @else
                                    <p class="text-muted text-center mt-4">Silakan pilih kelas untuk melihat grafik
                                        ranking.</p>
                                @endif
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

        // RANKING CHART
        document.addEventListener("DOMContentLoaded", function() {
            const rankingData = @json($rankingTertinggi);

            const ctxRanking = document.getElementById('rankingChart').getContext('2d');

            // Membuat gradient warna untuk grafik
            const gradient = ctxRanking.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(46, 204, 113, 0.8)'); // Hijau cerah
            gradient.addColorStop(1, 'rgba(39, 174, 96, 0.1)'); // Hijau gelap

            // Menghitung nilai terendah
            const minValue = Math.min(...rankingData.map(d => d.average_nilai));

            // Menambahkan jarak agar grafik tidak nempel pada garis X
            const adjustedMin = Math.max(minValue - 3, 0); // Pastikan nilai minimum diatur dengan jarak

            // Membuat chart dengan data
            const rankingChart = new Chart(ctxRanking, {
                type: 'bar',
                data: {
                    labels: rankingData.map(d => d.nama),
                    datasets: [{
                        label: 'Rata-rata Nilai',
                        data: rankingData.map(d => d.average_nilai),
                        backgroundColor: gradient,
                        borderColor: 'rgba(39, 174, 96, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: adjustedMin, // Pastikan nilai minimum sudah diubah
                                precision: 0,
                                stepSize: 1 // Langkah interval di sumbu Y
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const nilai = tooltipItem.yLabel.toFixed(1).replace('.', ',');
                                return `Rata-rata Nilai: ${nilai}`;
                            }
                        }
                    }
                }
            });
        });

        // Event handler untuk filter tahun ajaran & kelas
        document.getElementById('schoolYearSelect').addEventListener('change', updateUrl);
        document.getElementById('classSelect').addEventListener('change', updateUrl);

        function updateUrl() {
            const schoolYearId = document.getElementById('schoolYearSelect').value;
            const classId = document.getElementById('classSelect').value;

            const url = new URL(window.location.href);
            url.searchParams.set('school_year_id', schoolYearId);
            url.searchParams.set('class_id', classId);

            window.location.href = url.toString();
        }
    </script>

</body>

</html>
