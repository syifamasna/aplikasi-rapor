<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - E-Rapor SIT Aliya</title>

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
                            <h4>Profil Saya</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <!-- Foto Profil -->
                                <div id="imagePreviewContainer" class="mb-3">
                                    @if ($user->image)
                                        <img id="imagePreview" src="{{ asset('storage/' . $user->image) }}"
                                            class="rounded-circle border"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        @php
                                            $defaultImage =
                                                $user->jk == 'Perempuan'
                                                    ? asset('images/avatar/female.png')
                                                    : asset('images/avatar/male.png');
                                        @endphp
                                        <img id="imagePreview" src="{{ $defaultImage }}" class="rounded-circle border"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    @endif
                                </div>
                                <!-- Nama dan Role -->
                                <h5 class="mb-1">{{ $user->nama }}</h5>
                                <p class="text-muted mb-3">
                                    @php
                                        $activeRole = session('active_role');
                                    @endphp
                                    {{ $activeRole ? \App\Models\Role::find($activeRole)->role : 'Tidak ada peran aktif' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs justify-content-center mt-3">
                                        <li class="nav-item"><a href="#edit-profil" data-toggle="tab"
                                                class="nav-link active show">Edit Profil</a></li>
                                        <li class="nav-item"><a href="#edit-foto-profil" data-toggle="tab"
                                                class="nav-link">Edit Foto</a></li>
                                        <li class="nav-item"><a href="#edit-akun" data-toggle="tab"
                                                class="nav-link">Edit Akun</a></li>
                                    </ul>
                                    <div class="tab-content p-3">

                                        <!-- Edit Profil -->
                                        <div id="edit-profil" class="tab-pane fade active show">
                                            <div class="pt-3">
                                                <div class="settings-form">
                                                    <form action="{{ route('admin.profile.update', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nama">Nama <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="nama"
                                                                        class="form-control" id="nama"
                                                                        value="{{ $user->nama }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nip">NIP</label>
                                                                    <input type="text" name="nip"
                                                                        class="form-control" id="nip"
                                                                        value="{{ $user->nip }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nuptk">NUPTK</label>
                                                                    <input type="text" name="nuptk"
                                                                        class="form-control" id="nuptk"
                                                                        value="{{ $user->nuptk }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Jenis Kelamin <span
                                                                            class="text-danger">*</span></label>
                                                                    <select name="jk" class="form-control"
                                                                        required>
                                                                        <option value="" disabled>Pilih Jenis
                                                                            Kelamin</option>
                                                                        <option value="Laki-Laki"
                                                                            {{ $user->jk == 'Laki-Laki' ? 'selected' : '' }}>
                                                                            Laki-Laki</option>
                                                                        <option value="Perempuan"
                                                                            {{ $user->jk == 'Perempuan' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="telepon">Telepon</label>
                                                                    <input type="text" name="telepon"
                                                                        class="form-control" id="telepon"
                                                                        value="{{ $user->telepon }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat</label>
                                                                    <textarea name="alamat" class="form-control" id="alamat">{{ $user->alamat }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-check text-left">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="profilConfirmCheckbox">
                                                            <label class="form-check-label"
                                                                for="profilConfirmCheckbox">
                                                                Saya yakin ingin menyimpan perubahan
                                                            </label>
                                                        </div>

                                                        <div class="form-group text-right">
                                                            <button type="submit" class="btn btn-success text-white"
                                                                id="profilSubmitButton" disabled><i
                                                                    class="fa fa-save"></i> Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Foto Profil -->
                                        <div id="edit-foto-profil" class="tab-pane fade">
                                            <div class="pt-3">
                                                <div class="settings-form text-center">

                                                    <!-- Preview Gambar -->
                                                    <div class="text-center">
                                                        <img id="imagePreviewEdit"
                                                            src="{{ asset('storage/' . $user->image) }}"
                                                            class="rounded-circle border d-block mx-auto"
                                                            style="width: 100px; height: 100px; object-fit: cover;">
                                                    </div>

                                                    @if ($user->image)
                                                        <form action="{{ route('admin.profile.destroyImage') }}"
                                                            method="POST" class="mt-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus
                                                                Foto Profil</button>
                                                        </form>
                                                    @endif

                                                    <!-- Form Upload Foto -->
                                                    <form action="{{ route('admin.profile.update') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group mt-3 text-left">
                                                            <label for="inputImage" class="form-label">Upload Foto
                                                                Profil</label>
                                                            <input type="file" name="image" class="form-control"
                                                                accept="image/*" id="inputImage">

                                                            <div class="form-group mt-2 text-right">
                                                                <button type="submit"
                                                                    class="btn btn-success btn-sm mt-3 text-white">
                                                                    <i class="fa fa-upload"></i> Upload
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Akun -->
                                        <div id="edit-akun" class="tab-pane fade">
                                            <div class="pt-3">
                                                <div class="settings-form">
                                                    <form action="{{ route('admin.profile.update', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email Akun <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="email" name="email"
                                                                        class="form-control" id="email"
                                                                        value="{{ $user->email }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="password">Password Akun (Kosongkan jika
                                                                        tidak
                                                                        diubah)</label>
                                                                    <input type="password" name="password"
                                                                        class="form-control" id="password">
                                                                    <div class="mt-2">
                                                                        <input type="checkbox" id="showPassword"
                                                                            onclick="togglePassword()">
                                                                        <label for="showPassword">Tampilkan
                                                                            Password</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-check text-left">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="akunConfirmCheckbox">
                                                            <label class="form-check-label" for="akunConfirmCheckbox">
                                                                Saya yakin ingin menyimpan perubahan
                                                            </label>
                                                        </div>

                                                        <div class="form-group text-right">
                                                            <button type="submit" class="btn btn-success text-white"
                                                                id="akunSubmitButton" disabled><i
                                                                    class="fa fa-save"></i> Perbarui Akun</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin-pages.components.footer')
            </div>
        </div>

    </div>

    <script>
        // script untuk mengaktifkan tombol simpan jika checkbox dicentang
        document.getElementById('profilConfirmCheckbox').addEventListener('change', function() {
            document.getElementById('profilSubmitButton').disabled = !this.checked;
        });

        document.getElementById('akunConfirmCheckbox').addEventListener('change', function() {
            document.getElementById('akunSubmitButton').disabled = !this.checked;
        });

        // Script Toggle Password di Edit Akun
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        // Script Preview Gambar di Edit Foto Profil
        document.getElementById('inputImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById(
                'imagePreviewEdit'); // ID untuk preview dalam form Edit Foto
            const reader = new FileReader();

            if (file) {
                reader.onload = function(e) {
                    previewContainer.src = e.target.result;
                    previewContainer.style.display = "block"; // Tampilkan preview di tab Edit Foto Profil
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.src =
                    "{{ asset('default-profile.png') }}"; // Kembali ke default jika tidak ada gambar
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
