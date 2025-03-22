<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ketidakhadiran Kelas {{ $class->nama ?? 'Tidak Ada Kelas' }} - E-Rapor SIT Aliya</title>

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
                        <h4 class="mb-0">Data Ketidakhadiran Kelas {{ $class->nama ?? 'Tidak Ada Kelas' }}</h4>
                    </div>
                    <div class="col-md-6 p-md-0 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('guru_mapel.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('guru_mapel.grades.index') }}">Kelas</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ketidakhadiran</li>
                        </ol>
                    </div>
                </div>



                <div class="card">
                    <div class="card-body">
                        <!-- FORM FILTER -->
                        <form action="{{ route('guru_mapel.grades.students') }}" method="GET">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">

                            <div class="mb-4 border-bottom pb-3">
                                <div class="row">
                                    <!-- Mata Pelajaran -->
                                    <div class="col-md-12 mb-2 d-flex align-items-center">
                                        <strong class="info-row h5 font-weight-bold me-3 w-25 text-nowrap">Mata
                                            Pelajaran <span>:</span></strong>
                                        <input type="text" class="form-control flex-grow-1"
                                            value="{{ $subjects->where('id', request('subject_id'))->first()->nama ?? '-' }}"
                                            disabled>
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
                                            Ajar <span>:</span></strong>
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

                        <!-- TABEL NILAI -->
                        <form action="{{ route('guru_mapel.grades.update', $class->id) }}" method="POST">
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
                                            <th>Nilai</th>
                                            <th>
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    id="addCapaianBtn">
                                                    <i class="fa fa-plus"></i> Tambah Capaian
                                                </button>
                                            </th>
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
                                                        class="form-control" step="0.01" min="0"
                                                        max="100"
                                                        value="{{ old('grades.' . $student->id . '.nilai', $grades[$student->id]->nilai ?? '') }}">
                                                </td>

                                                <!-- Tempat untuk capaian tambahan -->
                                                <td>
                                                    <div class="capaian-container"
                                                        data-student-id="{{ $student->id }}">
                                                        @if (!empty($grades[$student->id]->capaian))
                                                            <textarea name="grades[{{ $student->id }}][capaian]" class="form-control mt-2">{{ old('grades.' . $student->id . '.capaian', $grades[$student->id]->capaian ?? '') }}</textarea>
                                                        @endif

                                                        @if (!empty($grades[$student->id]->target))
                                                            <textarea name="grades[{{ $student->id }}][target]" class="form-control mt-2">{{ old('grades.' . $student->id . '.target', $grades[$student->id]->target ?? '') }}</textarea>
                                                        @endif

                                                        @if (!empty($grades[$student->id]->aplikasi_program))
                                                            <textarea name="grades[{{ $student->id }}][aplikasi_program]" class="form-control mt-2">{{ old('grades.' . $student->id . '.aplikasi_program', $grades[$student->id]->aplikasi_program ?? '') }}</textarea>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group mt-4 text-right">
                                <button type="submit" class="btn btn-success text-white">
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
        document.getElementById('addCapaianBtn').addEventListener('click', function() {
            document.querySelectorAll('.capaian-container').forEach(container => {
                const studentId = container.getAttribute('data-student-id');

                // Buat pilihan input yang bisa ditambahkan
                let capaianHtml = `
                            <select class="form-control mt-2 add-option">
                                <option value="">Pilih Data Tambahan</option>
                                <option value="capaian">Capaian</option>
                                <option value="target">Target</option>
                                <option value="aplikasi_program">Aplikasi Program</option>
                            </select>
                        `;

                container.insertAdjacentHTML('beforeend', capaianHtml);

                container.addEventListener('change', function(event) {
                    if (event.target.classList.contains('add-option')) {
                        let selected = event.target.value;
                        if (selected) {
                            let inputHtml =
                                `<textarea name="grades[${studentId}][${selected}]" class="form-control mt-2"></textarea>`;
                            event.target.insertAdjacentHTML('afterend', inputHtml);
                            event.target.remove();
                        }
                    }
                });
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
