<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna - E-Rapor SIT Aliya</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-erapor.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .form-group label {
            color: #a3a3a3;
        }
    </style>
</head>

<body>

    @include('admin-pages.components.preloader')

    <div id="main-wrapper">
        @include('admin-pages.components.sidebar')
        @include('admin-pages.components.topbar')

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Tambah Pengguna</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Data
                                    Pengguna</a></li>
                            <li class="breadcrumb-item active"><a class="text-dark" href="{{ route('admin.users.create') }}">Tambah
                                Data
                                Pengguna</a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0 font-weight-bold text-primary">Tambah Pengguna</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.users.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama <span class="text-danger">*</span></label>
                                                <input type="text" name="nama" class="form-control" id="nama"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nip">NIP</label>
                                                <input type="text" name="nip" class="form-control"
                                                    id="nip">
                                            </div>
                                            <div class="form-group">
                                                <label for="nuptk">NUPTK</label>
                                                <input type="text" name="nuptk" class="form-control"
                                                    id="nuptk">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email Akun <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" required>
                                                <div class="mt-2">
                                                    <input type="checkbox" id="showPassword" onclick="togglePassword()">
                                                    <label for="showPassword">Tampilkan Password</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                                <select name="jk" class="form-control" required>
                                                    <option value="" selected disabled>Pilih Jenis Kelamin
                                                    </option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="telepon">Telepon</label>
                                                <input type="text" name="telepon" class="form-control"
                                                    id="telepon">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" class="form-control" id="alamat"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe Pengguna <span class="text-danger">*</span></label>
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($roles as $role)
                                                        <label class="ml-3">
                                                            <input type="checkbox" name="roles[]"
                                                                value="{{ $role->id }}"> {{ $role->role }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2 text-right">
                                        <button type="submit" class="btn btn-success text-white"><i
                                                class="fa fa-save"></i> Simpan</button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin-pages.components.footer')

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            let passwordField = document.getElementById("password");
            let showPasswordCheckbox = document.getElementById("showPassword");

            passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
        }
    </script>

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <!-- sweetalert2 success dan error -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                html: '<ul style="text-align:center;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

</body>

</html>
