<div class="sidebar text-white position-fixed" style="width: 250px; height: 100vh; top: 56px; left: 0; z-index: 1000;">
    <div class="d-flex flex-column ">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="border-bottom nav-item px-1 py-2">
                <a href="{{ route('home') }}" class="nav-link text-black px-3 py-2">
                    <span class="fs-5">Home</span>
                </a>
            </li>

            <li class="border-bottom nav-item px-1 py-2" style="background-color: #11c48a">
                <span class="nav-link text-white ps-2 disabled">Quản lý khách hàng</span>
            </li>

            <li class="border-bottom nav-item px-1 py-2">
                <a href="{{ route('customers.index') }}" {{-- href="#submenu1" --}} {{-- data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenu1"> --}}
                    class="nav-link text-black d-flex justify-content-between align-items-center pe-1 ps-5">
                    <span>Quản lý khách hàng</span>
                    <i class="bi bi-chevron-right transition-icon transition-icon"></i>
                </a>
                {{-- <ul class="collapse nav" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('customers.index') }}" class="nav-link text-black"
                            style="padding-left: 5rem;">
                            <span class="d-none d-sm-inline">Danh sách</span>
                        </a>
                    </li>
                    <li class="w-100">
                        <a href="{{ route('customers.index') }}" class="nav-link text-black"
                            style="padding-left: 5rem;">
                            <span class="d-none d-sm-inline">Thêm mới</span>
                        </a>
                    </li>
                </ul> --}}
            </li>

            <li class="border-bottom nav-item px-1 py-2" style="background-color: #11c48a">
                <span class="nav-link text-white ps-2 disabled">Cài đặt</span>
            </li>

            <li class="border-bottom nav-item px-1 py-2">
                <a href="{{ route('salons.index') }}" {{-- href="#submenu2" data-bs-toggle="collapse" aria-expanded="false"
                    aria-controls="submenu2" --}}
                    class="nav-link text-black d-flex justify-content-between align-items-center pe-1 ps-5">
                    <span>Quản lý cửa hàng</span>
                    <i class="bi bi-chevron-right transition-icon"></i>
                </a>
                {{-- <ul class="collapse nav" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link text-black" style="padding-left: 5rem;">
                            <span class="d-none d-sm-inline">Danh sách</span>
                        </a>
                    </li>
                    <li class="w-100">
                        <a href="#" class="nav-link text-black" style="padding-left: 5rem;">
                            <span class="d-none d-sm-inline">Thêm mới</span>
                        </a>
                    </li>
                </ul> --}}
            </li>

            <li class="border-bottom nav-item px-1 py-2">
                <a href="{{ route('users.index') }}" {{-- href="#submenu3" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenu3" --}}
                    class="nav-link text-black d-flex justify-content-between align-items-center pe-1 ps-5">
                    <span>Quản lý tài khoản</span>
                    <i class="bi bi-chevron-right transition-icon"></i>
                </a>
                {{-- <ul class="collapse nav" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link text-black" style="padding-left: 5rem;">
                            <span class="d-none d-sm-inline">Danh sách</span>
                        </a>
                    </li>
                    <li class="w-100">
                        <a href="#" class="nav-link text-black" style="padding-left: 5rem;">
                            <span class="d-none d-sm-inline">Thêm mới</span>
                        </a>
                    </li>
                </ul> --}}
            </li>

            <li class="border-bottom nav-item px-1 py-2">
                <a href="{{ route('consents.index') }}" {{-- href="#submenu4" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenu4" --}}
                    class="nav-link text-black d-flex justify-content-between align-items-center pe-1 ps-5">
                    <span>Quản lý thỏa thuận</span>
                    <i class="bi bi-chevron-right transition-icon"></i>
                </a>
                {{-- <ul class="collapse nav" id="submenu4" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link text-black" style="padding-left: 5rem;">
                            <span class="d-none d-sm-inline">Danh sách</span>
                        </a>
                    </li>
                    <li class="w-100">
                        <a href="#" class="nav-link text-black" style="padding-left: 5rem;">
                            <span class="d-none d-sm-inline">Thêm mới</span>
                        </a>
                    </li>
                </ul> --}}
            </li>
        </ul>
    </div>
</div>

<style>
    /* Hiệu ứng xoay icon */
    .transition-icon {
        transition: transform 0.5s ease;
    }

    /* Hiệu ứng hover cho nav-link */
    .nav-item {
        transition: all 0.2s ease;
    }

    .nav-item:hover {
        background-color: rgba(17, 196, 138, 0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các element có data-bs-toggle="collapse"
        const collapseElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
        collapseElements.forEach(function(element) {
            element.addEventListener('click', function() {
                const target = this.getAttribute('href') || this.getAttribute('data-bs-target');
                const targetElement = document.querySelector(target);
                const icon = this.querySelector('.transition-icon');

                // Toggle aria-expanded
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);

                // Thêm hiệu ứng xoay cho icon
                if (icon) {
                    if (!isExpanded) {
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        icon.style.transform = 'rotate(90deg)';
                    }
                }
            });
        });

        // Xử lý event Bootstrap collapse
        const collapseTargets = document.querySelectorAll('.collapse');
        collapseTargets.forEach(function(target) {
            target.addEventListener('show.bs.collapse', function() {
                const trigger = document.querySelector(
                    `[href="#${this.id}"], [data-bs-target="#${this.id}"]`);
                if (trigger) {
                    trigger.setAttribute('aria-expanded', 'true');
                    const icon = trigger.querySelector('.transition-icon');
                    if (icon) {
                        icon.style.transform = 'rotate(90deg)';
                    }
                }
            });

            target.addEventListener('hide.bs.collapse', function() {
                const trigger = document.querySelector(
                    `[href="#${this.id}"], [data-bs-target="#${this.id}"]`);
                if (trigger) {
                    trigger.setAttribute('aria-expanded', 'false');
                    const icon = trigger.querySelector('.transition-icon');
                    if (icon) {
                        icon.style.transform = 'rotate(0deg)';
                    }
                }
            });
        });
    });
</script>
