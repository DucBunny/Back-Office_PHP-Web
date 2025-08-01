<nav class="navbar navbar-expand fixed-top" style="background-color: #11c48a">
    <div class="container-fluid">
        <div class="m-0 navbar-brand text-white fw-semibold">PLAGE ミニアプリ</div>
        <div>
            <a class="text-decoration-none text-white me-2 dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
                <i class="bi bi-chevron-down small"></i>
            </a>
            <ul class="dropdown-menu" style="right: 1rem; left: auto; top: 75%">
                <li><a class="dropdown-item" href="{{ route('login') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .dropdown-item:focus {
        background-color: #11c48a !important;
        color: white !important;
    }

    .dropdown-toggle::after {
        display: none !important;
    }
</style>
