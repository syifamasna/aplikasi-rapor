<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa Kelas {{ $class->nama ?? 'Tidak Ada Kelas' }} - E-Rapor SIT Aliya</title>

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

        /* Membuat kolom Wali Kelas left-aligned */
        table.dataTable tbody td:nth-child(2) {
            text-align: left;
        }

        table.dataTable td {
            text-align: center;
            color: #707070;
        }

        .info-row {
            display: grid;
            grid-template-columns: 180px 10px auto;
            /* Kolom 1 untuk label, kolom 2 untuk ":", kolom 3 untuk nilai */
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            color: #707070;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row strong,
        .info-row span {
            text-align: left;
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

        #bulkDeleteTable_wrapper .dataTables_filter input {
            width: 180px !important;
        }

        #bulkDeleteTable_wrapper .dataTables_length select {
            width: 70px !important;
        }

        #bulkDeleteTable_wrapper .dataTables_info,
        #bulkDeleteTable_wrapper .dataTables_paginate {
            width: 100%;
            display: block;
            text-align: center;
        }

        #bulkDeleteTable_wrapper .dataTables_paginate {
            margin-top: 5px;
        }

        /* Styling untuk tabel responsif hanya pada layar kecil */
        @media (max-width: 991px) {
            .card-body .btn {
                display: block;
                width: 100%;
                max-width: 300px;
                margin: 5px auto;
                text-align: center !important;
            }

            .table-responsive {
                overflow-x: auto;
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
                        <h4 class="mb-0">Daftar Siswa Kelas {{ $class->nama ?? 'Tidak Ada Kelas' }} SIT Aliya</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('wali_kelas.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('wali_kelas.student_classes.index') }}">Data
                                    Kelas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Tabel Siswa</h5>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-success text-white" data-bs-toggle="modal"
                                data-bs-target="#importStudentModal"><i class="fa fa-upload"></i> Impor Siswa
                            </button>
                            <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                                data-target="#addStudentModal">
                                Tambah Siswa
                            </button>
                            <button type="button" class="btn btn-danger ml-2" data-bs-toggle="modal"
                                data-bs-target="#deleteMultipleModal">
                                <i class="fa fa-trash"></i> Hapus Beberapa
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->nama }}</td>
                                            <td>{{ $student->class ? $student->class->nama : '-' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm btn-detail"
                                                    data-siswa='@json($student)'>Detail</button>
                                                <button type="button" class="btn btn-warning btn-sm btn-edit"
                                                    data-id="{{ $student->id }}" data-nama="{{ $student->nama }}"
                                                    data-class_id="{{ $student->class_id }}"
                                                    data-jk="{{ $student->jk }}" data-nis="{{ $student->nis }}"
                                                    data-nisn="{{ $student->nisn }}">
                                                    Edit
                                                </button>
                                                <form action="{{ route('wali_kelas.students.destroy', $student->id) }}"
                                                    method="POST" class="d-inline form-hapus">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm btn-konfirmasi-hapus">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @include('wali-kelas-pages.components.footer')

        </div>
    </div>

    <!-- Modal Impor Siswa -->
    <div class="modal fade" id="importStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="importStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importStudentModalLabel">Impor Data Siswa</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="importForm" action="{{ route('wali_kelas.students.import') }}" method="POST"
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
                            <br><a href="{{ route('wali_kelas.students.template') }}" class="custom-download-link">
                                Download Format Impor
                            </a>
                        </div>
                        <div class="form-group">
                            <label for="importFile">Pilih File Excel</label>
                            <input type="file" class="form-control" id="importFile" name="importFile" required>
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" id="importConfirmCheckbox" required>
                            <label class="form-check-label" for="importConfirmCheckbox">
                                Saya yakin sudah mengisi data dengan benar
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="importSubmitButton"
                            disabled>Impor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addStudentForm" action="{{ route('wali_kelas.students.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Tambah Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Siswa <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control"
                                placeholder="Masukkan Nama Siswa..." required>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas <span class="text-danger">*</span></label>
                            <select name="class_id" class="form-control" required disabled>
                                <option value="{{ $class->id ?? '' }}" selected>
                                    {{ $class->nama ?? 'Tidak Ada Kelas' }}</option>
                            </select>
                            <input type="hidden" name="class_id" value="{{ $class->id ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jk" class="form-control" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nis">NIS <span class="text-danger">*</span></label>
                            <input type="text" name="nis" class="form-control"
                                placeholder="Masukkan NIS Siswa..." required>
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN <span class="text-danger">*</span></label>
                            <input type="text" name="nisn" class="form-control"
                                placeholder="Masukkan NISN Siswa..." required>
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" id="confirmCheckbox" required>
                            <label class="form-check-label" for="confirmCheckbox">
                                Saya yakin sudah mengisi data dengan benar
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editStudentForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentModalLabel">Edit Siswa</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_nama">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="edit_nama" class="form-control"
                                placeholder="Masukkan Nama Siswa..." required>
                        </div>
                        <div class="form-group">
                            <label for="edit_kelas">Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" name="class_id" id="edit_kelas" required readonly>
                                <option value="" selected disabled>Pilih Kelas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_jk">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-control" name="jk" id="edit_jk" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_nis">NIS <span class="text-danger">*</span></label>
                            <input type="text" name="nis" id="edit_nis" class="form-control"
                                placeholder="Masukkan NIS Siswa..." required>
                        </div>
                        <div class="form-group">
                            <label for="edit_nisn">NISN <span class="text-danger">*</span></label>
                            <input type="text" name="nisn" id="edit_nisn" class="form-control"
                                placeholder="Masukkan NISN Siswa..." required>
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" id="editConfirmCheckbox" required>
                            <label class="form-check-label" for="editConfirmCheckbox">
                                Saya yakin ingin menyimpan perubahan
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="editSubmitButton" disabled>Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Siswa</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Informasi Siswa -->
                    <div class="text-left">
                        <div class="info-row"><strong>Nama</strong> <span>:</span> <span id="detailNama"></span></div>
                        <div class="info-row"><strong>Kelas</strong> <span>:</span> <span id="detailKelas"></span>
                        </div>
                        <div class="info-row"><strong>Jenis Kelamin</strong> <span>:</span> <span
                                id="detailJk"></span>
                        </div>
                        <div class="info-row"><strong>NIS</strong> <span>:</span> <span id="detailNis"></span></div>
                        <div class="info-row"><strong>NISN</strong> <span>:</span> <span id="detailNisn"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="btnCloseModal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Beberapa -->
    <div class="modal fade" id="deleteMultipleModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteMultipleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form id="bulkDeleteForm" method="POST" action="{{ route('wali_kelas.students.bulk-delete') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Siswa yang Akan Dihapus</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped" id="bulkDeleteTable" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" id="selectAll"></th>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name="student_ids[]"
                                                value="{{ $student->id }}"></td>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $student->nama }}</td> {{-- Nama tetap kiri --}}
                                        <td class="text-center">{{ $student->class->nama ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="btnDeleteSelected">Hapus Terpilih</button>
                    </div>
                </div>
            </form>
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

        // script modal tambah
        document.addEventListener('DOMContentLoaded', function() {
            const confirmCheckbox = document.getElementById('confirmCheckbox');
            const submitButton = document.querySelector('#addStudentForm button[type="submit"]');
            const formInputs = document.querySelectorAll('#addStudentForm input, #addStudentForm select');

            // Awalnya tombol disable sampai checkbox dicentang
            submitButton.disabled = true;

            // Event listener untuk mengubah status tombol submit berdasarkan checkbox
            confirmCheckbox.addEventListener('change', function() {
                submitButton.disabled = !confirmCheckbox.checked;
            });

            // Mencegah checkbox dicentang saat menekan Enter
            formInputs.forEach(input => {
                input.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter' && document.activeElement === confirmCheckbox) {
                        event.preventDefault(); // Mencegah aksi default Enter pada checkbox
                    }
                });
            });
        });

        // script modal edit
        document.addEventListener("DOMContentLoaded", function() {
            const editCheckbox = document.getElementById("editConfirmCheckbox");
            const editSubmitButton = document.getElementById("editSubmitButton");

            // Saat modal edit dibuka, reset checkbox dan disable tombol
            $('#editStudentModal').on('show.bs.modal', function() {
                editCheckbox.checked = false;
                editSubmitButton.disabled = true;
            });

            // Aktifkan tombol ketika checkbox dicentang
            editCheckbox.addEventListener("change", function() {
                editSubmitButton.disabled = !this.checked;
            });

            // Script untuk isi data ke modal edit
            document.body.addEventListener("click", function(event) {
                if (event.target.classList.contains("btn-edit")) {
                    let button = event.target;
                    let id = button.getAttribute("data-id");
                    let nama = button.getAttribute("data-nama");
                    let class_id = button.getAttribute("data-class_id");
                    let jk = button.getAttribute("data-jk");
                    let nis = button.getAttribute("data-nis");
                    let nisn = button.getAttribute("data-nisn");

                    document.getElementById("edit_id").value = id;
                    document.getElementById("edit_nama").value = nama;
                    document.getElementById("edit_kelas").value = class_id;
                    document.getElementById("edit_jk").value = jk;
                    document.getElementById("edit_nis").value = nis;
                    document.getElementById("edit_nisn").value = nisn;

                    let form = document.getElementById("editStudentForm");
                    form.setAttribute("action", `/wali/students/${id}`);

                    $('#editStudentModal').modal('show');
                }

                // script modal detail
                document.addEventListener("click", function(event) {
                    if (event.target.classList.contains("btn-detail")) {
                        let button = event.target;
                        let student = JSON.parse(button.getAttribute("data-siswa"));

                        // Isi data di modal
                        document.getElementById("detailNama").textContent =
                            student
                            .nama;
                        document.getElementById("detailKelas").textContent = student.class ? student
                            .class.nama : "-";
                        document.getElementById("detailJk").textContent =
                            student.jk.toLowerCase() === "laki-laki" ?
                            "Laki-Laki" :
                            student.jk.toLowerCase() === "perempuan" ?
                            "Perempuan" : "-";
                        document.getElementById("detailNis").textContent =
                            student.nis ?? "-";
                        document.getElementById("detailNisn").textContent =
                            student.nisn ?? "-";

                        $("#detailModal").modal("show");
                    }
                });

                //script konfirmasi hapus
                if (event.target.classList.contains("btn-konfirmasi-hapus")) {
                    let form = event.target.closest("form");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data yang dihapus tidak bisa dikembalikan",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
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
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100]
            });
        });
    </script>

    <script>
        let tableInitialized = false;

        $('#deleteMultipleModal').on('shown.bs.modal', function() {
            if (!tableInitialized) {
                $('#bulkDeleteTable').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "pageLength": 5,
                    "lengthMenu": [5, 10, 25, 50, 100]
                });
                tableInitialized = true;
            }
        });

        $('#selectAll').on('click', function() {
            const isChecked = $(this).is(':checked');
            $('#bulkDeleteTable input[type="checkbox"]').prop('checked', isChecked);
        });

        // Script untuk menghapus banyak siswa
        $(document).ready(function() {
            // Tombol hapus banyak
            $('#btnDeleteSelected').on('click', function(e) {
                e.preventDefault();

                // Ambil semua ID yang tercentang
                let selectedIds = [];
                $('#bulkDeleteTable input[name="student_ids[]"]:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ada yang dipilih',
                        text: 'Silakan pilih minimal satu siswa',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: `Anda akan menghapus ${selectedIds.length} siswa`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim form jika dikonfirmasi
                        $('#bulkDeleteForm').submit();
                    }
                });
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
