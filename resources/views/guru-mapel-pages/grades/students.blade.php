<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai
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

        .custom-download-link {
            color: #FFAA16;
            font-weight: bold;
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .custom-download-link:hover {
            color: #e0a800;
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
    @include('guru-mapel-pages.components.preloader')

    <div id="main-wrapper" class="main-container">
        @include('guru-mapel-pages.components.sidebar')
        @include('guru-mapel-pages.components.topbar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-md-6 p-md-0">
                        <h4 class="mb-0">Input Nilai Kelas {{ $class->nama ?? 'Tidak Ada Kelas' }}</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('guru_mapel.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Guru Mapel</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('guru_mapel.grades.index') }}">Data Pembelajaran</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Input Nilai</li>
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
                        <form action="{{ route('guru_mapel.grades.students') }}" method="GET">
                            <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">

                            <div class="mb-4 border-bottom pb-3">
                                <div class="row">
                                    <!-- Mata Pelajaran -->
                                    <div class="col-md-12 mb-2">
                                        <div class="info-row">
                                            <strong class="h5 font-weight-bold">Mata Pelajaran</strong>
                                            <span>:</span>
                                            @php
                                                $selectedSubject = $subjects
                                                    ->where('id', request('subject_id', $subjectId))
                                                    ->first();
                                            @endphp
                                            <input type="text" class="form-control"
                                                value="{{ $selectedSubject->nama ?? '-' }}" disabled>
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

                                    <!-- Guru Pengampu -->
                                    <div class="col-md-12 mb-2">
                                        <div class="info-row">
                                            <strong class="h5 font-weight-bold">Guru Pengampu</strong>
                                            <span>:</span>
                                            <input type="text" class="form-control"
                                                value="{{ $teacher->nama ?? '-' }}" disabled>
                                        </div>
                                    </div>

                                    <!-- Tahun Pelajaran -->
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

                        <!-- TABEL NILAI -->

                        <!-- Tombol Terapkan Nilai Rata -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-success text-white" data-bs-toggle="modal"
                                data-bs-target="#importGradeModal">
                                <i class="fa fa-upload"></i> Impor Nilai
                            </button>
                            <div id="customDataTableFilter"></div>
                            <!-- Search bar DataTables will be placed here -->
                        </div>

                        <form action="{{ route('guru_mapel.grades.update', $class->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
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
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->nama }}</td>
                                                <td>{{ $student->nis }}</td>
                                                <td>{{ $student->jk }}</td>

                                                <!-- Input Nilai -->
                                                <td>
                                                    <input type="number" name="grades[{{ $student->id }}][nilai]"
                                                        class="form-control" min="0" max="100"
                                                        step="1"
                                                        value="{{ old('grades.' . $student->id . '.nilai', $grades[$student->id]->nilai ?? '') }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-check text-left mt-3 mb-3">
                                <input class="form-check-input" type="checkbox" id="confirmCheckbox">
                                <label class="form-check-label" for="confirmCheckbox">
                                    Saya yakin sudah mengisi nilai dengan benar
                                </label>
                            </div>

                            <div class="form-group text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-back">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success text-white" id="submitButton" disabled>
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

    <!-- Modal Input Nilai Rata -->
    <div class="modal fade" id="applyAverageModal" tabindex="-1" aria-labelledby="applyAverageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyAverageModalLabel">Terapkan Nilai Rata</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="averageScore">Nilai</label>
                    <input type="number" id="averageScore" class="form-control" min="0" max="100"
                        placeholder="Masukkan nilai...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="applyAverage()">Terapkan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Impor Nilai -->
    <div class="modal fade" id="importGradeModal" tabindex="-1" role="dialog"
        aria-labelledby="importGradeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importGradeModalLabel">Impor Nilai</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="importForm" action="{{ route('guru_mapel.grades.import') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible fade show">
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-exclamation-circle mr-2"></i>
                            <b>Penting!</b> File yang diunggah harus berupa dokumen Microsoft Excel dengan ekstensi
                            .xlsx
                            <br><a href="{{ route('guru_mapel.grades.template') }}" class="custom-download-link">
                                Download Format Impor
                            </a>
                        </div>

                        <div class="form-group">
                            <label for="importFile">Pilih File (Excel)</label>
                            <input type="file" class="form-control" id="importFile" name="import_file" required
                                accept=".xlsx,.xls">
                        </div>

                        <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                        <input type="hidden" name="class_id" value="{{ $class->id }}">
                        <input type="hidden" name="school_year_id" value="{{ $schoolYear->id ?? '' }}">

                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" id="importConfirmCheckbox" required>
                            <label class="form-check-label" for="importConfirmCheckbox">
                                Saya yakin sudah mengisi nilai dengan benar
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="importSubmitButton" disabled>
                            Impor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // script modal import
        document.getElementById('importForm').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('importFile');
            const submitBtn = document.getElementById('importSubmitButton');

            // Validasi file
            if (!fileInput.files.length) {
                e.preventDefault();
                alert('Silakan pilih file terlebih dahulu!');
                return;
            }

            // Tampilkan loading
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
        });

        // script modal import untuk mengaktifkan tombol simpan jika checkbox dicentang
        document.getElementById('importConfirmCheckbox').addEventListener('change', function() {
            document.getElementById('importSubmitButton').disabled = !this.checked;
        });

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

        $(document).ready(function() {
            var dataTable = $("#dataTable").DataTable();

            // Pindahkan search bar DataTables ke dalam div yang kita buat
            $("#customDataTableFilter").append($("#dataTable_filter"));

            // Hilangkan teks "Search:" sebelum input
            $("#customDataTableFilter label").contents().filter(function() {
                return this.nodeType === 3; // NodeType 3 adalah teks
            }).remove();

            // Tambahkan kembali class dan styling yang mungkin hilang
            $("#customDataTableFilter .dataTables_filter").addClass("d-flex align-items-center");
            $("#customDataTableFilter label").addClass("mb-0");
            $("#customDataTableFilter input")
                .addClass("form-control")
                .css({
                    "width": "200px",
                    "margin-left": "10px"
                })
                .attr("placeholder", "Cari...");
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
