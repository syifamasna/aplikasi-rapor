<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mapel - E-Rapor SIT Aliya</title>

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

        /* Membuat kolom Nama Mapel left-aligned */
        table.dataTable tbody td:nth-child(2) {
            text-align: left;
        }

        table.dataTable td {
            text-align: center;
            color: #707070;
        }

        .form-group label {
            color: #a3a3a3;
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
                        <h4 class="mb-0">Daftar Mapel SIT Aliya</h4>
                    </div>
                    <div class="col-md-6 p-md-0 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Mapel</li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Tabel Mapel</h5>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#addSubjectModal">
                                Tambah Mapel
                            </button>
                            <button type="button" class="btn btn-secondary ml-2" data-bs-toggle="modal"
                                data-bs-target="#filterModal"><i class="fa fa-filter"></i> Filter
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
                                        <th>Mata Pelajaran</th>
                                        <th>Singkatan</th>
                                        <th>Kelompok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subject->nama }}
                                            <td>{{ $subject->singkatan }}</td>
                                            <td>{{ $subject->kelompok_mapel }}</td>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm btn-edit"
                                                    data-id="{{ $subject->id }}" data-nama="{{ $subject->nama }}"
                                                    data-singkatan="{{ $subject->singkatan }}"
                                                    data-kelompok_mapel="{{ $subject->kelompok_mapel }}">
                                                    Edit
                                                </button>
                                                <form action="{{ route('admin.subjects.destroy', $subject->id) }}"
                                                    method="POST" class="d-inline form-hapus">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-delete"
                                                        data-id="{{ $subject->id }}">
                                                        Hapus
                                                    </button>
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

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data Mata Pelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="filterForm" method="GET" action="{{ route('admin.subjects.index') }}">
                        <div class="mb-3">
                            <label for="filterKelompokMapel" class="form-label">Kelompok Mapel</label>
                            <select class="form-control" id="filterKelompokMapel" name="kelompok_mapel">
                                <option value="">Semua</option>
                                <option value="Mata Pelajaran Wajib"
                                    {{ request('kelompok_mapel') == 'Mata Pelajaran Wajib' ? 'selected' : '' }}>Mata
                                    Pelajaran Wajib</option>
                                <option value="Muatan Lokal"
                                    {{ request('kelompok_mapel') == 'Muatan Lokal' ? 'selected' : '' }}>Muatan Lokal
                                </option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addSubjectForm" action="{{ route('admin.subjects.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSubjectModalLabel">Tambah Mapel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Mapel <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                placeholder="Masukkan Nama Mapel..." required>
                        </div>
                        <div class="form-group">
                            <label for="singkatan">Singkatan</label>
                            <input type="text" name="singkatan" id="singkatan" class="form-control"
                                placeholder="Masukkan Singkatan...">
                        </div>
                        <div class="form-group">
                            <label for="kelompok_mapel">Kelompok <span class="text-danger">*</span></label>
                            <select name="kelompok_mapel" id="kelompok_mapel" class="form-control" required>
                                <option value="" selected disabled>Pilih Kelompok Mapel</option>
                                <option value="Mata Pelajaran Wajib">Mata Pelajaran Wajib</option>
                                <option value="Muatan Lokal">Muatan Lokal</option>
                            </select>
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
    <div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog"
        aria-labelledby="editSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editSubjectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSubjectModalLabel">Edit Mapel</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_nama">Nama Mapel <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="edit_nama" class="form-control"
                                placeholder="Masukkan Nama Mapel..." required>
                        </div>
                        <div class="form-group">
                            <label for="edit_singkatan">Singkatan</label>
                            <input type="text" name="singkatan" id="edit_singkatan" class="form-control"
                                placeholder="Masukkan Singkatan...">
                        </div>
                        <div class="form-group">
                            <label for="edit_kelompok_mapel">Kelompok <span class="text-danger">*</span></label>
                            <select name="kelompok_mapel" id="edit_kelompok_mapel" class="form-control" required>
                                <option value="Mata Pelajaran Wajib">Mata Pelajaran Wajib</option>
                                <option value="Muatan Lokal">Muatan Lokal</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // script modal filter
        document.addEventListener("DOMContentLoaded", function() {
            // Pastikan tombol close bisa berfungsi
            $(".close").on("click", function() {
                $("#filterModal").modal("hide");
            });

            // Tampilkan modal saat tombol filter diklik
            $(".btn-filter").on("click", function() {
                $("#filterModal").modal("show");
            });
        });

        //script modal edit
        document.addEventListener("DOMContentLoaded", function() {
            document.body.addEventListener("click", function(event) {
                if (event.target.classList.contains("btn-edit")) {
                    let button = event.target;
                    let id = button.getAttribute("data-id");
                    let nama = button.getAttribute("data-nama");
                    let singkatan = button.getAttribute("data-singkatan");
                    let kelompok_mapel = button.getAttribute("data-kelompok_mapel");

                    document.getElementById("edit_id").value = id;
                    document.getElementById("edit_nama").value = nama;
                    document.getElementById("edit_singkatan").value = singkatan;
                    document.getElementById("edit_kelompok_mapel").value = kelompok_mapel;

                    let form = document.getElementById("editSubjectForm");
                    form.action = "/admin/subjects/" + id;

                    $('#editSubjectModal').modal('show');
                }
            });
        });

        //script konfirmasi hapus
        document.addEventListener("DOMContentLoaded", function() {
            document.body.addEventListener("click", function(event) {
                if (event.target.classList.contains("btn-delete")) {
                    event.preventDefault(); // Mencegah form langsung terkirim

                    let form = event.target.closest(".form-hapus");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Kirim form setelah konfirmasi
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
