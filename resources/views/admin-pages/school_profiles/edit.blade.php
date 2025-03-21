<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Sekolah - E-Rapor SIT Aliya</title>

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
                            <h4>Edit Data Sekolah</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.school_profiles.index') }}">Data
                                    Sekolah</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data Sekolah</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0 font-weight-bold text-primary">Edit Informasi Sekolah</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.school_profiles.update', $school_profiles->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Sekolah <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nama" class="form-control"
                                                    value="{{ old('nama', $school_profiles->nama) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kepsek">Kepala Sekolah <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="kepsek" class="form-control"
                                                    value="{{ old('kepsek', $school_profiles->kepsek) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="npsn">NPSN <span class="text-danger">*</span></label>
                                                <input type="text" name="npsn" class="form-control"
                                                    value="{{ old('npsn', $school_profiles->npsn) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_pos">Kode Pos</label>
                                                <input type="text" name="kode_pos" class="form-control"
                                                    value="{{ old('kode_pos', $school_profiles->kode_pos) }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telepon">Telepon</label>
                                                <input type="text" name="telepon" class="form-control"
                                                    value="{{ old('telepon', $school_profiles->telepon) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ old('email', $school_profiles->email) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" name="website" class="form-control"
                                                    value="{{ old('website', $school_profiles->website) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $school_profiles->alamat) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-right mt-2">
                                        <button type="submit" class="btn btn-success text-white"><i
                                                class="fa fa-save"></i> Simpan</button>
                                        <a href="{{ route('admin.school_profiles.index') }}"
                                            class="btn btn-secondary">Batal</a>
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

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
</body>

</html>
