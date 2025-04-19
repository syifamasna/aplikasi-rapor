<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Capaian Kompetensi
        {{ $subjects->where('id', request('subject_id'))->first()?->singkatan ?: $subjects->where('id', request('subject_id'))->first()?->nama ?? '-' }}
        Kelas {{ $class->nama ?? '-' }} - E-Rapor SIT Aliya
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
            grid-template-columns: 150px 10px auto;
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

        /* Styling untuk tabel responsif hanya pada layar kecil */
        @media (max-width: 991px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    @include('guru-mapel-pages.components.preloader')

    <div id="main-wrapper" class="main-container">
        @include('guru-mapel-pages.components.sidebar')
        @include('guru-mapel-pages.components.topbar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-md-6 p-md-0">
                        <h4 class="mb-0">Input Capaian Kompetensi {{ $class->nama ?? 'Tidak Ada Kelas' }}</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('guru_mapel.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('guru_mapel.grades.index') }}">Kelas</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Input Capaian Kompetensi</li>
                        </ol>
                    </div>
                </div>

                @if ($grades->where('nilai', '-')->count() > 0)
                    <div class="alert alert-warning" style="font-size: 1rem;">
                        <strong>Oops! Sepertinya ada nilai yang belum diisi.</strong>
                        Anda belum menginput nilai untuk mata pelajaran
                        <strong>{{ $subjects->where('id', $subjectId)->first()->nama ?? 'yang dipilih' }}</strong>.
                        Mohon lengkapi nilai terlebih dahulu sebelum melanjutkan ke capaian kompetensi.

                        <br><br>
                        <a href="{{ route('guru_mapel.grades.students', ['class_id' => $class->id, 'subject_id' => $subjectId, 'school_year_id' => $schoolYear->id ?? '']) }}"
                            class="btn btn-warning btn-sm text-white" style="font-size: 1rem; padding: 8px 12px;">
                            <i class="fa fa-edit"></i> Isi Nilai Sekarang
                        </a>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <!-- FORM FILTER -->
                        <form action="{{ route('guru_mapel.grade_details.index') }}" method="GET">
                            <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">

                            <div class="mb-4 border-bottom pb-3">
                                <div class="row">
                                    <!-- Mata Pelajaran -->
                                    <div class="col-md-12 mb-2 d-flex align-items-center">
                                        <strong class="info-row h5 font-weight-bold me-3 w-25 text-nowrap">Mata
                                            Pelajaran <span>:</span></strong>
                                        @php
                                            $selectedSubject = $subjects
                                                ->where('id', request('subject_id', $subjectId))
                                                ->first();
                                        @endphp
                                        <input type="text" class="form-control flex-grow-1"
                                            value="{{ $selectedSubject->nama ?? '-' }}" disabled>
                                    </div>

                                    <!-- Kelas -->
                                    <div class="col-md-12 mb-2 d-flex align-items-center">
                                        <strong class="info-row h5 font-weight-bold me-3 w-25 text-nowrap">Kelas
                                            <span>:</span></strong>
                                        <input type="text" class="form-control flex-grow-1"
                                            value="{{ $class->nama ?? '-' }}" disabled>
                                    </div>

                                    <!-- Guru Pengampu -->
                                    <div class="col-md-12 mb-2 d-flex align-items-center">
                                        <strong class="info-row h5 font-weight-bold me-3 w-25 text-nowrap">Guru
                                            Pengampu <span>:</span></strong>
                                        <input type="text" class="form-control flex-grow-1"
                                            value="{{ $teacher->nama ?? '-' }}" disabled>
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

                        @php
                            use Illuminate\Support\Str;
                            $isInformatika =
                                isset($selectedSubject->nama) &&
                                Str::contains(Str::lower($selectedSubject->nama), ['informatika', 'komputer', 'tik']);
                            $isDisabled = $grades->where('nilai', '-')->count() > 0; // Form disabled jika ada nilai kosong
                        @endphp

                        <!-- FORM UNTUK TARGET & CAPAIAN ATAU APLIKASI/PROGRAM -->
                        <form action="{{ route('guru_mapel.grade_details.update', $class->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                            <input type="hidden" name="school_year_id" value="{{ $schoolYear->id ?? '' }}">

                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped {{ $isDisabled ? 'table-secondary' : '' }}"
                                    id="dataTable" width="100%" cellspacing="0"
                                    style="{{ $isDisabled ? 'opacity: 0.6; pointer-events: none;' : '' }}">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NIS</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nilai</th>
                                            @if ($isInformatika)
                                                <th>Aplikasi/Program</th>
                                            @else
                                                <th>Target</th>
                                                <th>Capaian</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->nama }}</td>
                                                <td>{{ $student->nis }}</td>
                                                <td>{{ $student->jk }}</td>
                                                <td>{{ $grades[$student->id]->nilai ?? '-' }}</td>

                                                @if ($isInformatika)
                                                    <!-- FORM APLIKASI/PROGRAM UNTUK INFORMATIKA/KOMPUTER -->
                                                    <td>
                                                        <input type="text"
                                                            name="grade_details[{{ $student->id }}][aplikasi_program]"
                                                            class="form-control"
                                                            value="{{ old('grade_details.' . $student->id . '.aplikasi_program', $gradeDetails[$grades[$student->id]->id]->aplikasi_program ?? '-') }}"
                                                            {{ $isDisabled ? 'disabled' : '' }}>
                                                    </td>
                                                @else
                                                    <!-- FORM TARGET & CAPAIAN UNTUK MATA PELAJARAN LAINNYA -->
                                                    <td>
                                                        <input type="text"
                                                            name="grade_details[{{ $student->id }}][target]"
                                                            class="form-control"
                                                            value="{{ old('grade_details.' . $student->id . '.target', $gradeDetails[$grades[$student->id]->id]->target ?? '-') }}"
                                                            {{ $isDisabled ? 'disabled' : '' }}>
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                            name="grade_details[{{ $student->id }}][capaian]"
                                                            class="form-control"
                                                            value="{{ old('grade_details.' . $student->id . '.capaian', $gradeDetails[$grades[$student->id]->id]->capaian ?? '-') }}"
                                                            {{ $isDisabled ? 'disabled' : '' }}>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-check text-left mt-3 mb-3">
                                <input class="form-check-input" type="checkbox" id="confirmCheckbox">
                                <label class="form-check-label" for="confirmCheckbox">
                                    Saya yakin sudah mengisi dengan benar
                                </label>
                            </div>

                            <div class="form-group text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-back">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success text-white"
                                    {{ $isDisabled ? 'disabled' : '' }}>
                                    <i class="fa fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            @include('guru-mapel-pages.components.footer')

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('confirmCheckbox');
            const submitButton = document.querySelector('button[type="submit"]');

            const isDisabledFromServer = {{ $isDisabled ? 'true' : 'false' }};

            // ⏱ Set kondisi awal saat halaman dimuat
            if (!isDisabledFromServer) {
                submitButton.disabled = true; // awalnya disable
            }

            // 🟢 Update tombol saat checkbox dicentang/diubah
            checkbox.addEventListener('change', function() {
                if (!isDisabledFromServer) {
                    submitButton.disabled = !checkbox.checked;
                }
            });
        });
    </script>

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
