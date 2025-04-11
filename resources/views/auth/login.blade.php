<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Halaman Login - E-Rapor SIT Aliya</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-erapor.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .authincation {
            background: url('{{ asset('images/bg.png') }}') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            position: relative;
        }
    
        .authincation::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
    
        .authincation-content {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            max-width: 450px;
            margin: 0 auto;
        }
    
        /* Buat form lebih rapih */
        .auth-form {
            padding: 10px;
        }
    </style>
</head>

<body class="h-100">
    @include('admin-pages.components.preloader')

    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">

                        <!-- Menampilkan form login jika belum login -->
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <!-- Tambahkan logo di sini -->
                                    <div class="text-center mb-4">
                                        <img src="{{ asset('images/logo-erapor.png') }}" alt="Logo E-Rapor"
                                            width="100">
                                    </div>

                                    <h3 class="text-center mb-4">Login E-Rapor SIT Aliya</h3>

                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Masukkan email..." required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password"
                                                    class="form-control" placeholder="Masukkan password..." required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" onclick="togglePassword()"
                                                        style="cursor: pointer;">
                                                        <i id="eyeIcon" class="fa fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Masuk sebagai</strong></label>
                                            <select name="role" class="form-control text-dark bg-white" required>
                                                <option value="" disabled selected>Pilih Tipe Pengguna</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
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

    <script>
        function togglePassword() {
            let passwordInput = document.getElementById("password");
            let eyeIcon = document.getElementById("eyeIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>

    <!-- Scripts -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    title: "Berhasil Logout",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK",
                    position: "center",
                    heightAuto: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: "Login Gagal",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonText: "Coba Lagi",
                    position: "center",
                    heightAuto: false
                });
            @endif
        });
    </script>

</body>

</html>
