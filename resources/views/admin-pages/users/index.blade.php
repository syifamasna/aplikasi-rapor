<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - E-Rapor SIT Aliya</title>

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
            text-align: left;
            color: #707070;
        }

        .table td,
        .table th {
            white-space: nowrap;
            /* Mencegah teks turun ke baris baru */
            overflow: hidden;
            text-overflow: ellipsis;
            /* Menampilkan "..." jika teks terlalu panjang */
            max-width: 200px;
            /* Sesuaikan dengan kebutuhan */
        }

        .table .nama-column {
            max-width: 250px;
            /* Atur agar kolom nama tidak terlalu panjang */
        }

        .table .aksi-column {
            width: 180px;
            /* Pastikan tombol tetap dalam ukuran yang sesuai */
            text-align: center;
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
    @include('admin-pages.components.preloader')

    <div id="main-wrapper" class="main-container">
        @include('admin-pages.components.sidebar')
        @include('admin-pages.components.topbar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-md-6 p-md-0">
                        <h4 class="mb-0">Daftar Pengguna E-Rapor SIT Aliya</h4>
                    </div>
                    <div class="col-md-6 p-md-0 d-flex justify-content-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Tabel Pengguna</h5>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
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
                                        <th style="width: 50px;">No.</th>
                                        <th class="nama-column">Nama</th>
                                        <th>Email</th>
                                        <th style="width: 150px;">Tipe Pengguna</th>
                                        <th class="aksi-column">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="nama-column">{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->roles->pluck('role')->join(', ') }}</td>
                                            <td class="aksi-column">
                                                <button type="button" class="btn btn-info btn-sm btn-detail"
                                                    data-user='@json($user)'>Detail</button>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
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

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="filterForm" method="GET" action="{{ route('admin.users.index') }}">
                        <div class="mb-3">
                            <label for="filterRole" class="form-label">Tipe Pengguna</label>
                            <select class="form-control" id="filterRole" name="role">
                                <option value="">Semua</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ request('role') == $role->id ? 'selected' : '' }}>
                                        {{ $role->role }}
                                    </option>
                                @endforeach
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

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- Foto Profil -->
                    <img id="detailImage" src="" alt="Foto Profil" class="rounded-circle mb-3"
                        width="100" height="100" style="object-fit: cover; border: 3px solid #ddd;">

                    <!-- Informasi Pengguna -->
                    <div class="text-left">
                        <div class="info-row"><strong>Nama</strong> <span>:</span> <span id="detailNama"></span></div>
                        <div class="info-row"><strong>NIP</strong> <span>:</span> <span id="detailNip"></span></div>
                        <div class="info-row"><strong>NUPTK</strong> <span>:</span> <span id="detailNuptk"></span>
                        </div>
                        <div class="info-row"><strong>Jenis Kelamin</strong> <span>:</span> <span
                                id="detailJk"></span></div>
                        <div class="info-row"><strong>Email Akun</strong> <span>:</span> <span
                                id="detailEmail"></span></div>
                        <div class="info-row"><strong>Tipe Pengguna</strong> <span>:</span> <span
                                id="detailRoles"></span></div>
                        <div class="info-row"><strong>Telepon</strong> <span>:</span> <span id="detailTelepon"></span>
                        </div>
                        <div class="info-row"><strong>Alamat</strong> <span>:</span> <span id="detailAlamat"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnEditUser" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="btnCloseModal">Batal</button>
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

        // script modal detail
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-detail").forEach(function(button) {
                button.addEventListener("click", function() {
                    let user = JSON.parse(this.getAttribute("data-user"));

                    // Tentukan default avatar berdasarkan jenis kelamin
                    let defaultAvatar = user.jk === "Laki-Laki" ? "/images/avatar/male.png" :
                        "/images/avatar/female.png";

                    // Tambahkan timestamp untuk bypass cache
                    let timestamp = new Date().getTime();
                    let imagePath = user.image ? `/storage/${user.image}?t=${timestamp}` :
                        defaultAvatar;

                    // Set gambar di modal
                    document.getElementById("detailImage").src = imagePath;

                    // Isi data di modal
                    document.getElementById("detailNama").textContent = user.nama;
                    document.getElementById("detailNip").textContent = user.nip ?? "-";
                    document.getElementById("detailNuptk").textContent = user.nuptk ?? "-";
                    document.getElementById("detailJk").textContent =
                        user.jk.toLowerCase() === "laki-laki" ? "Laki-Laki" :
                        user.jk.toLowerCase() === "perempuan" ? "Perempuan" : "-";
                    document.getElementById("detailEmail").textContent = user.email;
                    document.getElementById("detailRoles").textContent = user.roles.map(role => role
                        .role).join(", ");
                    document.getElementById("detailTelepon").textContent = user.telepon ?? "-";
                    document.getElementById("detailAlamat").textContent = user.alamat ?? "-";

                    // Ubah link tombol Edit
                    document.getElementById("btnEditUser").href = `/admin/users/${user.id}/edit`;

                    // Tampilkan modal
                    let modal = new bootstrap.Modal(document.getElementById("detailModal"));
                    modal.show();

                    // Tutup modal dengan tombol close manual jika ada masalah
                    $(".close, #btnCloseModal").on("click", function() {
                        $("#detailModal").modal("hide");
                    });
                });
            });

            // Tambahkan event listener untuk tombol batal secara manual (jika Bootstrap gagal)
            document.getElementById("btnCloseModal").addEventListener("click", function() {
                let modal = bootstrap.Modal.getInstance(document.getElementById("detailModal"));
                if (modal) {
                    modal.hide();
                }
            });
        });

        // script konfirmasi hapus
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-konfirmasi-hapus").forEach(button => {
                button.addEventListener("click", function(event) {
                    let form = event.target.closest("form");

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
                            form.submit();
                        }
                    });
                });
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
