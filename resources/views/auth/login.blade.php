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
</head>

<body class="h-100">
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
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Masukkan password..." required>
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

    <!-- Scripts -->
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

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
</body>

</html>
