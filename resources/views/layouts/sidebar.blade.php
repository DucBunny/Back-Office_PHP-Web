<div>
    <div class="sidebar text-white position-fixed" id="sidebar">
        <div class="d-flex flex-column">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="border-bottom nav-item">
                    <a href="{{ route('home') }}" class="nav-link p-3 text-black d-flex">
                        <span class="fs-5">Home</span>

                        <i class="fa-solid fa-house icon-responsive" style="color: #11c48a"></i>
                    </a>
                </li>

                <li class="border-bottom nav-item item-content" style="background-color: #11c48a">
                    <a href="#" class="nav-link py-3 text-white ps-2 disabled">
                        <span>Quản lý khách hàng</span>
                    </a>
                </li>

                <li class="border-bottom nav-item">
                    <a href="{{ route('customers.index') }}"
                        class="nav-link text-black d-flex justify-content-between align-items-center py-3 pe-1 ps-5">
                        <span>Quản lý khách hàng</span>
                        <i class="bi bi-chevron-right"></i>

                        <i class="fa-solid fa-user icon-responsive" style="color: #11c48a"></i>
                    </a>
                </li>

                <li class="border-bottom nav-item item-content" style="background-color: #11c48a">
                    <a href="#" class="nav-link text-white py-3 ps-2 disabled">
                        <span>Cài đặt</span>
                    </a>
                </li>

                <li class="border-bottom nav-item">
                    <a href="{{ route('salons.index') }}"
                        class="nav-link text-black d-flex justify-content-between align-items-center py-3 pe-1 ps-5">
                        <span>Quản lý cửa hàng</span>
                        <i class="bi bi-chevron-right"></i>

                        <i class="fa-solid fa-store icon-responsive" style="color: #11c48a"></i>
                    </a>
                </li>

                <li class="border-bottom nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link text-black d-flex justify-content-between align-items-center py-3 pe-1 ps-5">
                        <span>Quản lý tài khoản</span>
                        <i class="bi bi-chevron-right"></i>

                        <i class="fa-solid fa-users icon-responsive" style="color: #11c48a"></i>
                    </a>
                </li>

                <li class="border-bottom nav-item">
                    <a href="{{ route('consents.index') }}"
                        class="nav-link text-black d-flex justify-content-between align-items-center py-3 pe-1 ps-5">
                        <span>Quản lý thỏa thuận</span>
                        <i class="bi bi-chevron-right"></i>

                        <i class="fa-solid fa-handshake icon-responsive" style="color: #11c48a"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <button type="button"
        class="btn btn-lg btn-custom-11c48a rounded-circle text-white d-md-none d-block position-fixed"
        style="bottom: 1.5rem; right: 1.5rem; z-index: 9999; min-width: 52px; min-height: 52px" id="sidebarToggle">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>

<style>
    /* Hiệu ứng hover cho nav-link */
    .nav-item {
        transition: all 0.2s ease;
    }

    .nav-item:hover {
        background-color: rgba(17, 196, 138, 0.1);
    }

    .icon-responsive {
        display: none;
    }

    .sidebar {
        width: 250px;
        height: 100vh;
        top: 56px;
        left: 0;
        z-index: 1000;
        background-color: #ffffff;
    }

    @media (min-width: 768px) and (max-width: 991.9px) {
        .sidebar {
            width: 60px;
        }

        .sidebar span,
        .sidebar .bi-chevron-right {
            display: none;
        }

        .sidebar .nav-link i {
            margin: auto;
        }

        .item-content {
            display: none;
        }

        .icon-responsive {
            display: inline-block;
            padding: 6px 0;
        }

        .nav-link {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }

    @media (max-width: 767.9px) {
        .sidebar {
            transform: translateX(-100%);
            opacity: 0;
            transition: transform 0.3s, opacity 0.3s;
        }

        .sidebar.active {
            transform: translateX(0);
            opacity: 1;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        btn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            e.stopPropagation();
        });

        // Ẩn sidebar khi click ra ngoài (mobile)
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 767.9) {
                if (!sidebar.contains(e.target) && !btn.contains(e.target) && sidebar.classList
                    .contains(
                        'active')) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Tắt transition khi resize, bật lại sau 300ms
        let resizeTimer;
        window.addEventListener('resize', function() {
            sidebar.style.transition = 'none';
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                sidebar.style.transition = '';
            }, 300);
        });
    });
</script>
