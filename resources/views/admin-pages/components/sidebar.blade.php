<div class="nav-header">
    <a href="{{ route('admin.dashboard') }}" class="brand-logo">
        <img class="logo-abbr" src="{{ asset('images/logo-erapor.png') }}" alt="">
        <img class="brand-title" src="{{ asset('images/logo-text.png') }}" alt="">
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">

            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-user"></i><span class="nav-text">Dashboard</span></a>
            </li>

            <li class="nav-label">Data Master</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-folder"></i><span
                        class="nav-text">Administrasi</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.school_profiles.index') }}">Data Sekolah</a></li>
                    <li><a href="./app-calender.html">Data Kelas</a></li>
                    <li><a href="./app-calender.html">Data Mapel</a></li>
                    <li><a href="./app-calender.html">Data Pembelajaran</a></li>
                    <li><a href="./app-calender.html">Data Tahun Ajar</a></li>
                    <li><a href="./app-calender.html">Data Prestasi</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-book"></i><span
                        class="nav-text">Data Rapor</span></a>
                <ul aria-expanded="false">
                    <li><a href="./chart-flot.html">Leger Nilai</a></li>
                    <li><a href="./chart-morris.html">Cetak Rapor</a></li>
                </ul>
            </li>

            <li class="nav-label">Lainnya</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-users"></i><span class="nav-text">Data Pengguna</span></a>
                <ul aria-expanded="false">
                    <li><a href="./ui-accordion.html">Data Admin</a></li>
                    <li><a href="./ui-alert.html">Data Guru Mapel</a></li>
                    <li><a href="./ui-alert.html">Data Guru Wali Kelas</a></li>
                    <li><a href="./ui-button.html">Data Pj Prestasi</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" id="logout-btn">
                    <i class="fa fa-sign-out"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>

            <!-- Form logout tersembunyi -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.addEventListener('click', function(event) {
            if (event.target.closest('#logout-btn')) { // Menangkap event dari dropdown
                event.preventDefault();

                Swal.fire({
                    title: "Logout",
                    text: "Apakah anda yakin akan keluar dari E-Rapor SIT Aliya?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Keluar",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        });
    });
</script>
