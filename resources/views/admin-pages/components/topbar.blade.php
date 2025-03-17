<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <h4 class="text-dark font-weight-bold m-0">E-RAPOR SIT ALIYA</h4>
                </div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link d-flex align-items-center" href="#" role="button" data-toggle="dropdown">
                            <!-- Nama User (lebih kecil) -->
                            <span class="mr-2 d-none d-lg-inline text-dark font-weight-bold small">
                                {{ auth()->user()->nama ?? 'User' }}
                            </span>
                
                            <!-- Foto Profil -->
                            <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('images/avatar/default.png') }}"
                                class="rounded-circle border" style="width: 35px; height: 35px; object-fit: cover;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('admin.profile.index') }}" class="dropdown-item">
                                <i class="icon-user"></i>
                                <span class="ml-2">Profil Saya</span>
                            </a>
                            <a class="dropdown-item" href="#" id="logout-btn">
                                <i class="icon-key"></i>
                                <span class="ml-2">Logout</span>
                            </a>
                
                            <!-- Form logout tersembunyi -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>                

            </div>
        </nav>
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
