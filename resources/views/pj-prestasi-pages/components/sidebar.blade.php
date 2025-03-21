<div class="nav-header">
    <a href="{{ route('pj_prestasi.dashboard') }}" class="brand-logo d-flex align-items-center">
        <img class="logo-abbr" src="{{ asset('images/logo-erapor.png') }}" alt="">

        @php
            $activeRole = session('active_role');
            $roleText = $activeRole ? \App\Models\Role::find($activeRole)->role : 'Tidak ada peran aktif';
        @endphp

        <span id="role-text" class="ml-3 font-weight-bold text-uppercase">{{ $roleText }}</span>
    </a>

    <div class="nav-control">
        <div class="hamburger" id="hamburger-menu">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">

            <li><a href="{{ route('pj_prestasi.dashboard') }}">
                    <i class="fa fa-dashboard"></i><span class="nav-text">Dashboard</span></a>
            </li>

            <li class="nav-label">Pj Prestasi</li>
            <li><a href="{{ route('pj_prestasi.achievements.index') }}">
                    <i class="fa fa-trophy"></i><span class="nav-text">Prestasi Siswa</span></a>
            </li>

            <li class="nav-label">Lainnya</li>
            <li><a href="{{ route('pj_prestasi.profile.index') }}">
                    <i class="fa fa-user"></i><span class="nav-text">Profil Saya</span></a>
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

<style>
    /* Hilangkan role kalau sidebar kecil (mini-nav) */
    .mini-nav #role-text {
        display: none !important;
    }

    /* Hilangkan role kalau layar kecil (di bawah 768px, ukuran tablet & HP) */
    @media (max-width: 768px) {
        #role-text {
            display: none !important;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const body = document.body;
        const hamburger = document.getElementById("hamburger-menu");

        hamburger.addEventListener("click", function() {
            body.classList.toggle("mini-nav"); // Toggle class mini-nav
        });
    });

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
