<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas - E-Rapor SIT Aliya</title>

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
        table.dataTable tbody td:nth-child(3) {
            text-align: left;
        }

        table.dataTable td {
            text-align: center;
            color: #707070;
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
    @include('admin-pages.components.preloader')

    <div id="main-wrapper" class="main-container">
        @include('admin-pages.components.sidebar')
        @include('admin-pages.components.topbar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-md-6 p-md-0">
                        <h4 class="mb-0">Daftar Kelas SIT Aliya</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Tabel Kelas</h5>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#addStudentClassModal">
                            Tambah Kelas
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kelas</th>
                                        <th>Wali Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student_classes as $student_classes)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student_classes->nama }}
                                            <td>{{ $student_classes->waliKelas->nama ?? '-' }}</td>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm btn-edit"
                                                    data-id="{{ $student_classes->id }}"
                                                    data-nama="{{ $student_classes->nama }}"
                                                    data-wali-kelas="{{ $student_classes->wali_kelas }}">
                                                    Edit
                                                </button>
                                                <form
                                                    action="{{ route('admin.student_classes.destroy', $student_classes->id) }}"
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

            @include('admin-pages.components.footer')

        </div>
    </div>


    <!-- Modal Tambah -->
    <div class="modal fade" id="addStudentClassModal" tabindex="-1" role="dialog"
        aria-labelledby="addStudentClassModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addStudentClassForm" action="{{ route('admin.student_classes.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentClassModalLabel">Tambah Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh : I (Satu) A"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="wali_kelas">Wali Kelas <span class="text-danger">*</span></label>
                            <select name="wali_kelas" class="form-control" required>
                                <option value="" selected disabled>Pilih Wali Kelas</option>
                                @foreach ($waliKelas as $wali)
                                    <option value="{{ $wali->id }}">{{ $wali->nama }}</option>
                                @endforeach
                            </select>
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
    <div class="modal fade" id="editStudentClassModal" tabindex="-1" role="dialog"
        aria-labelledby="editStudentClassModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editStudentClassForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentClassModalLabel">Edit Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_nama">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="edit_nama" class="form-control"
                                placeholder="Contoh : I (Satu) A" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_wali_kelas">Wali Kelas <span class="text-danger">*</span></label>
                            <select class="form-control" name="wali_kelas" id="edit_wali_kelas" required>
                                <option value="" selected disabled>Pilih Wali Kelas</option>
                                @foreach ($waliKelas as $wali)
                                    <option value="{{ $wali->id }}">{{ $wali->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" id="editConfirmCheckbox" required>
                            <label class="form-check-label" for="editConfirmCheckbox">
                                Saya yakin ingin menyimpan perubahan
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="editSubmitButton" disabled>Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // script modal tambah
        document.addEventListener('DOMContentLoaded', function() {
            const confirmCheckbox = document.getElementById('confirmCheckbox');
            const submitButton = document.querySelector('#addStudentClassForm button[type="submit"]');
            const formInputs = document.querySelectorAll('#addStudentClassForm input, #addStudentClassForm select');

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
            $('#editStudentClassModal').on('show.bs.modal', function() {
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
                    let wali_kelas = button.getAttribute("data-wali-kelas");

                    document.getElementById("edit_id").value = id;
                    document.getElementById("edit_nama").value = nama;
                    document.getElementById("edit_wali_kelas").value = wali_kelas;

                    let form = document.getElementById("editStudentClassForm");
                    form.setAttribute("action", `/admin/student_classes/${id}`);

                    $('#editStudentClassModal').modal('show');
                }

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
                "lengthMenu": [2, 5, 10, 25, 50, 100]
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
