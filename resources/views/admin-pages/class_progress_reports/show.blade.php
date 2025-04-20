<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perkembangan Siswa Kelas {{ $class->nama ?? '-' }} - E-Rapor SIT Aliya
    </title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-erapor.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Styling tambahan untuk DataTable */
        table.dataTable {
            border-collapse: collapse !important;
        }

        table.dataTable thead th {
            background-color: #593bdb;
            color: white;
            text-align: center;
        }

        /* Border bawah hanya untuk th "Nilai" dan "Absensi" */
        table.dataTable thead tr:first-child th:nth-child(3),
        table.dataTable thead tr:first-child th:nth-child(4) {
            border-bottom: 1px solid white;
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

        .td-merah {
            background-color: #ff7e7e !important;
            color: white;
        }

        .info-row {
            display: grid;
            grid-template-columns: 170px 10px auto;
            /* Kolom 1 untuk label, kolom 2 untuk ":", kolom 3 untuk nilai */
            padding: 8px 0;
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

        .dataTables_scroll {
            margin: 0 !important;
            padding: 0 !important;
        }

        .dataTables_wrapper .dataTables_scrollBody {
            overflow-x: auto;
            border-bottom: none !important;
            box-shadow: none !important;
        }

        .dataTables_wrapper .dataTables_filter {
            display: flex;
            justify-content: flex-end;
            margin-top: auto;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_length {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 250px;
            display: inline-block;
            margin-left: 10px;
        }

        .dataTables_wrapper .dataTables_length select {
            width: 100px;
            display: inline-block;
            margin-right: 10px;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    @include('admin-pages.components.preloader')

    <div id="main-wrapper" class="main-container">
        @include('admin-pages.components.sidebar')
        @include('admin-pages.components.topbar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-md-6 p-md-0">
                        <h4 class="mb-0">Legger LPS Kelas {{ $class->nama ?? '-' }}</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Cetak Rapor & Legger</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.class_progress_reports.index') }}"
                                    title="Legger Laporan Perkembangan Siswa (LPS)">Legger LPS</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.class_progress_reports.show', ['class_id' => $class->id]) }}"
                                    title="Legger LPS Kelas {{ $class->nama ?? '-' }}"
                                    class="{{ request()->is('admin/class_progress_reports/*') ? 'text-dark' : '' }}">
                                    Legger LPS Kelas
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
                        <form action="{{ route('admin.class_progress_reports.show', ['class_id' => $class->id]) }}"
                            method="GET">
                            <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">

                            <div class="mb-4 border-bottom pb-3">
                                <div class="row">

                                    <!-- Kelas -->
                                    <div class="col-md-12 mb-2 d-flex align-items-center">
                                        <strong class="info-row h5 font-weight-bold me-3 w-25 text-nowrap">Kelas
                                            <span>:</span></strong>
                                        <input type="text" class="form-control flex-grow-1"
                                            value="{{ $class->nama ?? '-' }}" disabled>
                                    </div>

                                    <!-- Wali Kelas -->
                                    <div class="col-md-12 mb-2 d-flex align-items-center">
                                        <strong class="info-row h5 font-weight-bold me-3 w-25 text-nowrap">Wali Kelas
                                            <span>:</span></strong>
                                        <input type="text" class="form-control flex-grow-1"
                                            value="{{ $class->waliKelas->nama ?? '-' }}" disabled>
                                    </div>

                                    <!-- Tahun Ajar -->
                                    <div class="col-md-12 mb-2 d-flex align-items-center">
                                        <strong class="info-row h5 font-weight-bold me-3 w-25 text-nowrap">Tahun
                                            Pelajaran <span>:</span></strong>
                                        <select name="school_year_id" class="form-control flex-grow-1"
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
                        </form>

                        <!-- TABEL NILAI MATA PELAJARAN -->
                        <table class="table table-bordered table-striped table-sm" id="dataTable" cellspacing="0"
                            style="font-size: 0.85rem; min-width: max-content;">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle">No</th>
                                    <th rowspan="2" style="vertical-align: middle">Nama Lengkap</th>

                                    {{-- Kolom Nilai --}}
                                    <th colspan="{{ count($subjects) }}">Nilai</th>

                                    {{-- Kolom Absensi --}}
                                    <th colspan="3">Absensi</th>

                                    <th rowspan="2" style="vertical-align: middle">Jumlah</th>
                                    <th rowspan="2" style="vertical-align: middle">Rata-Rata</th>
                                </tr>
                                <tr>
                                    @foreach ($subjects as $subject)
                                        <th>{{ $subject->singkatan ?? $subject->nama }}</th>
                                    @endforeach
                                    <th>S</th>
                                    <th>I</th>
                                    <th>A</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->nama }}</td>

                                        {{-- Nilai per mapel --}}
                                        @foreach ($subjects as $subject)
                                            @php
                                                $grade = $student->grades->firstWhere('subject_id', $subject->id);
                                            @endphp
                                            @php
                                                $nilai = $grade->nilai ?? null;
                                                $style =
                                                    is_numeric($nilai) && $nilai <= 70
                                                        ? 'background-color: #ff7e7e !important;'
                                                        : '';
                                            @endphp
                                            <td style="text-align: center; {{ $style }}">{{ $nilai ?? '-' }}
                                            </td>
                                        @endforeach

                                        {{-- Absensi --}}
                                        <td>{{ $student->absensi['sakit'] ?? 0 }}</td>
                                        <td>{{ $student->absensi['izin'] ?? 0 }}</td>
                                        <td>{{ $student->absensi['alfa'] ?? 0 }}</td>

                                        {{-- Jumlah dan Rata-Rata --}}
                                        @php
                                            $nilaiArray = $subjects
                                                ->map(function ($subject) use ($student) {
                                                    $nilai = optional(
                                                        $student->grades->where('subject_id', $subject->id)->first(),
                                                    )->nilai;

                                                    return is_numeric($nilai) ? floatval($nilai) : null;
                                                })
                                                ->filter();

                                            $jumlah = $nilaiArray->sum();
                                            $rataRata =
                                                $nilaiArray->count() > 0
                                                    ? number_format($jumlah / $nilaiArray->count(), 2)
                                                    : '-';
                                        @endphp
                                        <td>{{ $jumlah }}</td>
                                        <td>{{ $rataRata }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group mt-4 text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-back">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>

                            <div class="btn-group">
                                <button type="button" class="btn btn-success text-white dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-download"></i> Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.class_progress_reports.export-csv', ['class_id' => $class->id]) }}?school_year_id={{ request('school_year_id', $schoolYear->id) }}">
                                        <i class="fa fa-file-excel-o"></i> CSV (Legger)
                                    </a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.class_progress_reports.export-pdf', ['class_id' => $class->id]) }}?school_year_id={{ request('school_year_id', $schoolYear->id) }}">
                                        <i class="fa fa-file-pdf-o"></i> PDF (Legger)
                                    </a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.class_progress_reports.export-all-pdf', ['class_id' => $class->id, 'school_year_id' => request('school_year_id', $schoolYear->id ?? '')]) }}">
                                        <i class="fa fa-file-pdf-o"></i> PDF (Cetak Semua LPS)
                                    </a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.class_progress_reports.export-pdf', ['class_id' => $class->id]) }}?school_year_id={{ request('school_year_id', $schoolYear->id) }}&mode=print"
                                        target="_blank">
                                        <i class="fa fa-print"></i> Print Legger
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            @include('admin-pages.components.footer')

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
            var table = $('#dataTable').DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: false,
                info: true,
                autoWidth: false,
                responsive: true,
                scrollX: true,
                lengthMenu: [5, 10, 25, 50, 100],
                drawCallback: function() {
                    this.api().columns.adjust();
                }
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
