<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tahun Ajar - E-Rapor SIT Aliya</title>

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
                        <h4 class="mb-0">Daftar Tahun Ajar SIT Aliya</h4>
                    </div>
                    <div class="col-md-6 p-md-0 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Tahun Ajar</li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Tabel Tahun Ajar</h5>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addYearModal">
                            Tambah Tahun Ajar
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun Ajar</th>
                                        <th>Semester</th>
                                        <th>Tempat Pembagian Rapor</th>
                                        <th>Tanggal Pembagian Rapor</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schoolYears as $schoolYear)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $schoolYear->tahun_awal }} / {{ $schoolYear->tahun_akhir }}</td>
                                            <td>{{ $schoolYear->semester }}</td>
                                            <td>{{ $schoolYear->tempat_rapor }}</td>
                                            <td>{{ \Carbon\Carbon::parse($schoolYear->tanggal_rapor)->locale('id')->translatedFormat('d F Y') }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm btn-edit"
                                                    data-id="{{ $schoolYear->id }}"
                                                    data-tahun-awal="{{ $schoolYear->tahun_awal }}"
                                                    data-tahun-akhir="{{ $schoolYear->tahun_akhir }}"
                                                    data-semester="{{ $schoolYear->semester }}"
                                                    data-tempat-rapor="{{ $schoolYear->tempat_rapor }}"
                                                    data-tanggal-rapor="{{ $schoolYear->tanggal_rapor }}">
                                                    Edit
                                                </button>
                                                <form
                                                    action="{{ route('admin.school_years.destroy', $schoolYear->id) }}"
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
    <div class="modal fade" id="addYearModal" tabindex="-1" role="dialog" aria-labelledby="addYearModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addSchoolYearForm" action="{{ route('admin.school_years.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addYearModalLabel">Tambah Tahun Ajar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tahun_awal">Tahun Ajar <span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <input type="number" name="tahun_awal" id="tahun_awal" class="form-control"
                                    placeholder="2024" required>
                                <span class="mx-2">/</span>
                                <input type="number" name="tahun_akhir" id="tahun_akhir" class="form-control"
                                    placeholder="2025" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester <span class="text-danger">*</span></label>
                            <select name="semester" class="form-control" required>
                                <option value="" selected disabled>Pilih Semester</option>
                                <option value="Tengah Semester I (Satu)">Tengah Semester I (Satu)</option>
                                <option value="I (Satu)">I (Satu)</option>
                                <option value="Tengah Semester II (Dua)">Tengah Semester II (Dua)</option>
                                <option value="II (Dua)">II (Dua)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_rapor">Tempat Pembagian Rapor</label>
                            <input type="text" name="tempat_rapor" class="form-control"
                                placeholder="Contoh : Bogor">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_rapor">Tanggal Pembagian Rapor</label>
                            <input type="date" name="tanggal_rapor" class="form-control">
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
    <div class="modal fade" id="editYearModal" tabindex="-1" role="dialog" aria-labelledby="editYearModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editSchoolYearForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editYearModalLabel">Edit Tahun Ajar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_tahun_awal">Tahun Ajar <span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <input type="number" name="tahun_awal" id="edit_tahun_awal" class="form-control"
                                    required>
                                <span class="mx-2">/</span>
                                <input type="number" name="tahun_akhir" id="edit_tahun_akhir" class="form-control"
                                    required readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_semester">Semester <span class="text-danger">*</span></label>
                            <select name="semester" id="edit_semester" class="form-control" required>
                                <option value="Tengah Semester I (Satu)">Tengah Semester I (Satu)</option>
                                <option value="I (Satu)">I (Satu)</option>
                                <option value="Tengah Semester II (Dua)">Tengah Semester II (Dua)</option>
                                <option value="II (Dua)">II (Dua)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_tempat_rapor">Tempat Pembagian Rapor</label>
                            <input type="text" name="tempat_rapor" id="edit_tempat_rapor" class="form-control"
                                placeholder="Contoh : Bogor">
                        </div>
                        <div class="form-group">
                            <label for="edit_tanggal_rapor">Tanggal Pembagian Rapor</label>
                            <input type="date" name="tanggal_rapor" id="edit_tanggal_rapor" class="form-control">
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
        document.getElementById('tahun_awal').addEventListener('input', function() {
            let tahunAwal = parseInt(this.value);
            if (!isNaN(tahunAwal)) {
                document.getElementById('tahun_akhir').value = tahunAwal + 1;
            } else {
                document.getElementById('tahun_akhir').value = '';
            }
        });

        // script untuk menambah checkbox di modal tambah
        document.addEventListener('DOMContentLoaded', function() {
            const confirmCheckbox = document.getElementById('confirmCheckbox');
            const submitButton = document.querySelector('#addSchoolYearForm button[type="submit"]');
            const formInputs = document.querySelectorAll('#addSchoolYearForm input, #addSchoolYearForm select');

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
            $('#editYearModal').on('show.bs.modal', function() {
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
                    let tahunAwal = button.getAttribute("data-tahun-awal");
                    let tahunAkhir = button.getAttribute("data-tahun-akhir");
                    let semester = button.getAttribute("data-semester");
                    let tempatRapor = button.getAttribute("data-tempat-rapor");
                    let tanggalRapor = button.getAttribute("data-tanggal-rapor");

                    document.getElementById("edit_id").value = id;
                    document.getElementById("edit_tahun_awal").value = tahunAwal;
                    document.getElementById("edit_tahun_akhir").value = tahunAkhir;
                    document.getElementById("edit_semester").value = semester;
                    document.getElementById("edit_tempat_rapor").value = tempatRapor;
                    document.getElementById("edit_tanggal_rapor").value = tanggalRapor;

                    // Fix: Ubah action form dengan ID yang benar
                    let form = document.getElementById("editSchoolYearForm");
                    form.setAttribute("action", `/admin/school_years/${id}`);

                    $('#editYearModal').modal('show');
                }

                // Ketika user mengubah tahun_awal, otomatis update tahun_akhir
                document.getElementById("edit_tahun_awal").addEventListener("input", function() {
                    let tahunAwal = parseInt(this.value);
                    if (!isNaN(tahunAwal)) {
                        document.getElementById("edit_tahun_akhir").value = tahunAwal + 1;
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
                            form.submit(); // Submit form hapus
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
