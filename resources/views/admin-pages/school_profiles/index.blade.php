<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sekolah - E-Rapor SIT Aliya</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-erapor.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                        <h4 class="mb-0">Data Sekolah</h4>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Sekolah</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold text-primary">Informasi Sekolah</h5>
                                <a href="{{ route('admin.school_profiles.edit', $school_profiles->id) }}"
                                    class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered text-dark">
                                    <tr>
                                        <th>Nama Sekolah</th>
                                        <td>{{ $school_profiles->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kepala Sekolah</th>
                                        <td>{{ $school_profiles->kepsek }}</td>
                                    </tr>
                                    <tr>
                                        <th>NPSN</th>
                                        <td>{{ $school_profiles->npsn }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pos</th>
                                        <td>{{ $school_profiles->kode_pos }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <td>{{ $school_profiles->telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $school_profiles->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $school_profiles->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Website</th>
                                        <td>{{ $school_profiles->website }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0 font-weight-bold text-primary">Logo Sekolah</h5>
                            </div>
                            <div class="card-body text-center">
                                <div id="imagePreviewContainer">
                                    @if ($school_profiles->logo)
                                        <img id="imagePreview" src="{{ asset('storage/' . $school_profiles->logo) }}"
                                            class="img-fluid mb-3" width="150">
                                    @else
                                        <i id="defaultIcon" class="fas fa-school fa-3x text-secondary mb-3"></i>
                                    @endif
                                </div>
                                @if ($school_profiles->logo)
                                    <form
                                        action="{{ route('admin.school_profiles.deleteLogo', $school_profiles->id) }}"
                                        method="POST" class="mb-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mb-3">Hapus Logo</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.school_profiles.uploadLogo', $school_profiles->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="file" name="logo" class="form-control" required
                                            accept="image/*" id="inputLogo">
                                        <button type="submit" class="btn btn-primary btn-sm"><i
                                                class="fa fa-upload"></i>Upload</button>
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
        document.getElementById('inputLogo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('imagePreview');
            const defaultIcon = document.getElementById('defaultIcon');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                    defaultIcon?.classList.add('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "";
                imagePreview.classList.add('d-none');
                defaultIcon?.classList.remove('d-none');
            }
        });
    </script>

    @if (session('success'))
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500
                });
            };
        </script>
    @endif

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
</body>

</html>
