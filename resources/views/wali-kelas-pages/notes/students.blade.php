<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Wali Kelas {{ $class->nama ?? 'Tidak Ada Kelas' }} - E-Rapor SIT Aliya</title>

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
                        <h4 class="mb-0">Catatan Wali Kelas {{ $class->nama ?? 'Tidak Ada Kelas' }}</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('wali_kelas.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('wali_kelas.notes.index') }}">Catatan Wali Kelas</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Input Catatan</li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- FORM FILTER -->
                        <form action="{{ route('wali_kelas.notes.students') }}" method="GET">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">

                            <div class="mb-4 border-bottom pb-3">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="info-row">
                                            <strong class="h5 font-weight-bold">Kelas</strong>
                                            <span>:</span>
                                            <input type="text" class="form-control"
                                                value="{{ $class->nama ?? '-' }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="info-row">
                                            <strong class="h5 font-weight-bold">Wali Kelas</strong>
                                            <span>:</span>
                                            <input type="text" class="form-control"
                                                value="{{ $class->waliKelas->nama ?? '-' }}" disabled>
                                        </div>
                                    </div>

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

                        <!-- TABEL CATATAN -->
                        <form action="{{ route('wali_kelas.notes.update', $class->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                            <input type="hidden" name="school_year_id" value="{{ $schoolYear->id ?? '' }}">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NIS</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->nama }}</td>
                                                <td>{{ $student->nis }}</td>
                                                <td>{{ $student->jk }}</td>

                                                <input type="hidden" name="notes[{{ $student->id }}][student_id]"
                                                    value="{{ $student->id }}">
                                                <td>
                                                    <textarea name="notes[{{ $student->id }}][catatan]" class="form-control" rows="2">{{ old("notes.{$student->id}.catatan", $notes[$student->id]->catatan ?? '') }}</textarea>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-check text-left mt-3">
                                <input class="form-check-input" type="checkbox" id="confirmCheckbox">
                                <label class="form-check-label" for="confirmCheckbox">
                                    Saya yakin sudah mengisi data dengan benar
                                </label>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success text-white" id="submitButton" disabled><i
                                        class="fa fa-save"></i>
                                    Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            @include('wali-kelas-pages.components.footer')

        </div>
    </div>

    <script>
        // script untuk mengaktifkan tombol simpan jika checkbox dicentang
        document.getElementById('confirmCheckbox').addEventListener('change', function() {
            document.getElementById('submitButton').disabled = !this.checked;
        });
    </script>

    <!-- Scripts -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

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
