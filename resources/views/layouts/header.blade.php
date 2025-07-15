<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #11c48a">
    <div class="container-fluid">
        <a class="navbar-brand text-white fw-medium" href="#">PLAGE ミニアプリ</a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link text-white me-2" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        xxxx@xxxx.co.jp
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('login') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
