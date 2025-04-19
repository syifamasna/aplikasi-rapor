<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelajaran - E-Rapor SIT Aliya</title>

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
                        <h4 class="mb-0">Data Pembelajaran SIT Aliya</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('guru_mapel.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pembelajaran</li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Tabel Pembelajaran</h5>
                        <div class="d-flex align-items-center gap-2">
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
                                        <th>Kelas</th>
                                        <th>Guru Pengampu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($teachings as $teaching)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $teaching->subject->nama }}</td>
                                            <td>{{ $teaching->class->nama }}</td>
                                            <td>{{ $teaching->teacher->nama }}</td>
                                            <td>
                                                <a href="{{ route('guru_mapel.grades.students', ['class_id' => $teaching->class_id, 'subject_id' => $teaching->subject_id]) }}"
                                                    class="btn btn-info btn-sm btn-detail">
                                                    <i class="fa fa-pencil"></i> Input Nilai
                                                </a>
                                                <a href="{{ route('guru_mapel.grade_details.index', ['class_id' => $teaching->class_id, 'subject_id' => $teaching->subject_id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-bar-chart"></i> Input Capaian
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Data tidak tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @include('guru-mapel-pages.components.footer')

        </div>
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="filterForm" method="GET" action="{{ route('guru_mapel.grades.index') }}">
                        <!-- Filter Kelas -->
                        <div class="mb-3">
                            <label for="filterClass" class="form-label">Kelas</label>
                            <select class="form-control" id="filterClass" name="class_id">
                                <option value="">Semua</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Mata Pelajaran -->
                        <div class="mb-3">
                            <label for="filterSubject" class="form-label">Mata Pelajaran</label>
                            <select class="form-control" id="filterSubject" name="subject_id">
                                <option value="">Semua</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Guru (Nonaktif) -->
                        <div class="mb-3">
                            <label for="filterTeacher" class="form-label">Guru Pengampu</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->nama }}" disabled>
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                            <a href="{{ route('guru_mapel.grades.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
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
