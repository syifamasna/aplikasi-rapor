<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Belajar (Rapor) {{ $student->nama ?? '-' }} - E-Rapor SIT Aliya
    </title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-erapor.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Styling tambahan untuk DataTable */
        .dataTables_wrapper .dataTables_filter {
            display: flex;
            justify-content: flex-end;
            margin-top: auto;
            margin-bottom: 10px;
        }

        .table-responsive {
            overflow-x: hidden;
        }

        table.dataTable {
            border-collapse: collapse !important;
        }

        table.dataTable thead th {
            background-color: #593bdb;
            color: white;
            text-align: center;
        }

        /* Warna latar belang-belang */
        table.dataTable tbody tr:nth-child(odd) {
            background-color: #fcfcfc !important;
        }

        table.dataTable tbody tr:nth-child(even) {
            background-color: #f0f0f0 !important;
        }

        /* Membuat kolom Nama Siswa left-aligned */
        table.dataTable tbody td:nth-child(2) {
            text-align: left;
        }

        table.dataTable td {
            text-align: center;
            color: #707070;
        }


        .info-row {
            display: grid;
            grid-template-columns: 150px 30px auto;
            /* Kolom 1 untuk label, kolom 2 untuk ":", kolom 3 untuk nilai */
            padding: 8px 0;
        }

        .info-row span {
            font-weight: bold;
            color: #333;
        }

        .btn-back {
            background-color: #6c757d !important;
            color: white !important;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-back:hover {
            background-color: #5a6268 !important;
        }

        .btn-back:active {
            background-color: #495057 !important;
        }

        /* Styling untuk tabel responsif hanya pada layar kecil */
        @media (max-width: 991px) {
            .table-responsive {
                overflow-x: auto;
            }

            .info-row {
                grid-template-columns: 1fr;
            }

            .info-row>* {
                margin-bottom: 4px;
            }

            .info-row span {
                display: none;
                /* atau bisa diganti tampil bawah kalau kamu mau */
            }
        }
    </style>
</head>

<body>
    @include('wali-kelas-pages.components.preloader')

    <div id="main-wrapper" class="main-container">
        @include('wali-kelas-pages.components.sidebar')
        @include('wali-kelas-pages.components.topbar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-md-6 p-md-0">
                        <h4 class="mb-0">Cetak Rapor {{ $student->nama ?? '-' }}</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('wali_kelas.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Cetak Rapor & Legger</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('wali_kelas.student_reports.index') }}"
                                    title="Cetak Laporan Hasil Belajar (Rapor) Peserta Didik">Cetak Rapor</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('wali_kelas.student_reports.show', ['class_id' => $class->id, 'student_id' => $student->id]) }}"
                                    title="Cetak Rapor {{ $student->nama ?? '-' }}"
                                    class="{{ request()->is('wali/student_reports/*') ? 'text-dark' : '' }}">
                                    Cetak Rapor Siswa
                                </a>
                            </li>

                        </ol>
                    </div>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {!! session('error') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <!-- FORM FILTER -->
                        <form
                            action="{{ route('wali_kelas.student_reports.show', ['class_id' => $class->id, 'student_id' => $student->id]) }}"
                            method="GET">
                            <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">

                            <div class="mb-4 border-bottom pb-3">
                                <div class="row">

                                    <!-- Nama -->
                                    <div class="col-md-12 mb-2">
                                        <div class="info-row">
                                            <strong class="h5 font-weight-bold">Nama Peserta
                                                Didik</strong>
                                            <span>:</span>
                                            <input type="text" class="form-control"
                                                value="{{ $student->nama ?? '-' }}" disabled>
                                        </div>
                                    </div>

                                    <!-- NIS/NISN -->
                                    <div class="col-md-12 mb-2">
                                        <div class="info-row">
                                            <strong class="h5 font-weight-bold">NIS / NISN</strong>
                                            <span>:</span>
                                            <input type="text" class="form-control"
                                                value="{{ $student->nis ?? '-' }} / {{ $student->nisn ?? '-' }}"
                                                disabled>
                                        </div>
                                    </div>

                                    <!-- Kelas -->
                                    <div class="col-md-12 mb-2">
                                        <div class="info-row">
                                            <strong class="h5 font-weight-bold">Kelas</strong>
                                            <span>:</span>
                                            <input type="text" class="form-control"
                                                value="{{ $class->nama ?? '-' }}" disabled>
                                        </div>
                                    </div>

                                    <!-- Tahun Ajar -->
                                    <div class="col-md-12 mb-2">
                                        <div class="info-row">
                                            <strong class="h5 font-weight-bold">Tahun Pelajaran</strong>
                                            <span>:</span>
                                            <select name="school_year_id" class="form-control"
                                                onchange="this.form.submit()">
                                                @foreach ($schoolYears as $year)
                                                    <option value="{{ $year->id }}"
                                                        {{ request('school_year_id', $schoolYear->id ?? '') == $year->id ? 'selected' : '' }}>
                                                        {{ $year->tahun_awal }} / {{ $year->tahun_akhir }} -
                                                        {{ $year->semester }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- TABEL NILAI MATA PELAJARAN -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-left">Mata Pelajaran</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $isMuatanLokalDisplayed = false; // Variabel untuk menampilkan header "MUATAN LOKAL" hanya sekali
                                    @endphp

                                    @foreach ($subjects as $subject)
                                        <!-- Cek jika kelompok_mapel adalah "Muatan Lokal" dan belum ditampilkan -->
                                        @if ($subject->kelompok_mapel == 'Muatan Lokal' && !$isMuatanLokalDisplayed)
                                            <tr>
                                                <td colspan="3" class="text-left font-weight-bold"
                                                    style="background-color: #593bdb !important; color: white; padding: 10px;">
                                                    MUATAN LOKAL & MUATAN KHAS SDIT ALIYA
                                                </td>
                                            </tr>
                                            @php
                                                $isMuatanLokalDisplayed = true; // Set variabel jadi true agar tidak muncul lagi
                                            @endphp
                                        @endif

                                        @php
                                            $subjectName = strtolower($subject->nama); // Ubah ke lowercase untuk pencocokan fleksibel
                                            $targetLabel = 'Target';
                                            $capaianLabel = 'Capaian';

                                            // Cek jika nama mata pelajaran mengandung 'al-qur\'an metode ummi' atau 'tahfiz'
                                            if (
                                                stripos($subjectName, "al-qur'an metode ummi") !== false ||
                                                stripos($subjectName, 'tahfiz') !== false
                                            ) {
                                                $targetLabel = 'Target Akhir Semester';
                                                $capaianLabel = 'Capaian Saat Ini';
                                            }
                                        @endphp

                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $subject->nama }}</strong>

                                                @php
                                                    $grade = $grades->firstWhere('subject_id', $subject->id);
                                                    $gradeDetail = $grade
                                                        ? $gradeDetails->firstWhere('grade_id', $grade->id)
                                                        : null;
                                                @endphp

                                                <!-- Menampilkan Target jika ada -->
                                                @if ($gradeDetail && $gradeDetail->target)
                                                    <hr
                                                        style="border: 1px solid #ddd; margin-top: 10px; margin-bottom: 10px;">
                                                    <p><strong>{{ $targetLabel }}:</strong>
                                                        {{ $gradeDetail->target }}</p>
                                                @endif

                                                <!-- Menampilkan Capaian jika ada -->
                                                @if ($gradeDetail && $gradeDetail->capaian)
                                                    <hr
                                                        style="border: 1px solid #ddd; margin-top: 10px; margin-bottom: 10px;">
                                                    <p><strong>{{ $capaianLabel }}:</strong>
                                                        {{ $gradeDetail->capaian }}</p>
                                                @endif

                                                <!-- Menampilkan Aplikasi Program jika ada -->
                                                @if ($gradeDetail && $gradeDetail->aplikasi_program)
                                                    <hr
                                                        style="border: 1px solid #ddd; margin-top: 10px; margin-bottom: 10px;">
                                                    <p><strong>Aplikasi Program:</strong>
                                                        {{ $gradeDetail->aplikasi_program }}</p>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $grade ? $grade->nilai : 'Belum diisi' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <br><br> <!-- TABEL PRESTASI -->
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable">
                                <thead>
                                    <!-- Judul utama -->
                                    <tr>
                                        <th colspan="3" class="border-bottom">
                                            PRESTASI
                                        </th>
                                    </tr>
                                    <!-- Header kolom -->
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 30%;">Jenis Prestasi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $achievementsList = $achievements->where('student_id', $student->id);
                                        $count = $achievementsList->count();
                                    @endphp

                                    @if ($count > 0)
                                        @foreach ($achievementsList as $i => $achievement)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td style="text-align: left">{{ $achievement->jenis_prestasi }}</td>
                                                <td style="text-align: left">{{ $achievement->keterangan }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    @for ($i = $count + 1; $i <= 2; $i++)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td style="text-align: left">-</td>
                                            <td style="text-align: left">-</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <br><br> <!-- TABEL CATATAN WALI KELAS -->
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>CATATAN GURU</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: left;">{{ $notes->catatan ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <br><br> <!-- TABEL ABSENSI -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="font-weight-bold text-center"
                                            style="background-color: #593bdb; color: white; padding: 10px;">
                                            KETIDAKHADIRAN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: left; color: #707070;">
                                    <tr>
                                        <td class="font-weight-bold" style="width: 30%;">Sakit</td>
                                        <td>{{ $attendances->sakit ?? '0' }} Hari</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Izin</td>
                                        <td>{{ $attendances->izin ?? '0' }} Hari</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tanpa Keterangan</td>
                                        <td>{{ $attendances->alfa ?? '0' }} Hari</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group mt-4 text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-back">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                            <a href="{{ route('wali_kelas.student_reports.export-pdf', ['class_id' => $class->id, 'student_id' => $student->id, 'school_year_id' => request('school_year_id', $schoolYear->id ?? '')]) }}"
                                class="btn btn-success text-white">
                                <i class="fa fa-print"></i> Cetak Rapor
                            </a>
                        </div>

                    </div>
                </div>

            </div>

            @include('wali-kelas-pages.components.footer')

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <!-- sweetalert2 success dan error -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
            });
        </script>
    @endif

</body>

</html>
