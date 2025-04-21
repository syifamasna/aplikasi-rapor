<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi {{ $student->nama ?? 'Siswa Tidak Ditemukan' }} - E-Rapor SIT Aliya</title>

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

        /* Membuat kolom Tahun Ajar dan Keterangan left-aligned */
        table.dataTable tbody td:nth-child(2),
        table.dataTable tbody td:nth-child(4) {
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

        /* Styling untuk tabel responsif hanya pada layar kecil */
        @media (max-width: 991px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    @include('pj-prestasi-pages.components.preloader')

    <div id="main-wrapper" class="main-container">
        @include('pj-prestasi-pages.components.sidebar')
        @include('pj-prestasi-pages.components.topbar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-md-6 p-md-0">
                        <h4 class="mb-0">Daftar Prestasi {{ $student->nama ?? 'Siswa Tidak Ditemukan' }}</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('pj_prestasi.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pj Prestasi</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('pj_prestasi.achievements.index') }}">Prestasi Siswa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input Prestasi</li>

                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Tabel Prestasi</h5>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#addAchievementModal">
                            Tambah Prestasi
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
                                        <th>Jenis Prestasi</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($achievements as $achievement)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $achievement->schoolYear->tahun_awal }}/{{ $achievement->schoolYear->tahun_akhir }}
                                                - {{ $achievement->schoolYear->semester }}</td>
                                            <td>{{ $achievement->jenis_prestasi }}</td>
                                            <td>{{ $achievement->keterangan }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm btn-edit"
                                                    data-id="{{ $achievement->id }}"
                                                    data-school_year_id="{{ $achievement->school_year_id }}"
                                                    data-jenis_prestasi="{{ $achievement->jenis_prestasi }}"
                                                    data-keterangan="{{ $achievement->keterangan }}">
                                                    Edit
                                                </button>
                                                <form
                                                    action="{{ route('pj_prestasi.achievements.destroy', $achievement->id) }}"
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

            @include('pj-prestasi-pages.components.footer')

        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addAchievementModal" tabindex="-1" role="dialog"
        aria-labelledby="addAchievementModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addAchievementForm" action="{{ route('pj_prestasi.achievements.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="addAchievementModalLabel">Tambah Prestasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tahun Ajar <span class="text-danger">*</span></label>
                            <select name="school_year_id" class="form-control" required>
                                <option value="" selected disabled>Pilih Tahun Ajar</option>
                                @foreach ($schoolYears as $year)
                                    <option value="{{ $year->id }}">
                                        {{ $year->tahun_awal }}/{{ $year->tahun_akhir }} - {{ $year->semester }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Prestasi <span class="text-danger">*</span></label>
                            <select name="jenis_prestasi" class="form-control" required>
                                <option value="" selected disabled>Pilih Jenis Prestasi</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Non-Akademik">Non-Akademik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                            <input type="text" name="keterangan" class="form-control"
                                placeholder="Contoh : Juara 1 Kompetisi Karate Tingkat Provinsi" required>
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
    <div class="modal fade" id="editAchievementModal" tabindex="-1" role="dialog"
        aria-labelledby="editAchievementModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editAchievementForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAchievementModalLabel">Edit Prestasi</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_school_year_id">Tahun Ajar <span class="text-danger">*</span></label>
                            <select class="form-control" name="school_year_id" id="edit_school_year_id" required>
                                <option value="" selected disabled>Pilih Tahun Ajar</option>
                                @foreach ($schoolYears as $year)
                                    <option value="{{ $year->id }}">
                                        {{ $year->tahun_awal }}/{{ $year->tahun_akhir }} - {{ $year->semester }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_jenis_prestasi">Jenis Prestasi <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_prestasi" id="edit_jenis_prestasi" required>
                                <option value="" selected disabled>Pilih Jenis Prestasi</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Non-Akademik">Non-Akademik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_keterangan">keterangan <span class="text-danger">*</span></label>
                            <input type="text" name="keterangan" id="edit_keterangan" class="form-control"
                                placeholder="Contoh : Juara 1 Kompetisi Karate Tingkat Provinsi" required>
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

    <script>
        // script modal tambah
        document.addEventListener('DOMContentLoaded', function() {
            const confirmCheckbox = document.getElementById('confirmCheckbox');
            const submitButton = document.querySelector('#addAchievementForm button[type="submit"]');
            const formInputs = document.querySelectorAll('#addAchievementForm input, #addAchievementForm select');

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
            $('#editAchievementModal').on('show.bs.modal', function() {
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
                    let school_year_id = button.getAttribute("data-school_year_id");
                    let jenis_prestasi = button.getAttribute("data-jenis_prestasi");
                    let keterangan = button.getAttribute("data-keterangan");

                    document.getElementById("edit_id").value = id;
                    document.getElementById("edit_school_year_id").value = school_year_id;
                    document.getElementById("edit_jenis_prestasi").value = jenis_prestasi;
                    document.getElementById("edit_keterangan").value = keterangan;

                    let form = document.getElementById("editAchievementForm");
                    form.setAttribute("action", `/pj/achievements/${id}`);

                    $('#editAchievementModal').modal('show');
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
