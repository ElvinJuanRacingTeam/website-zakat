<nav class="navbar-custom d-flex align-items-center">

    <div class="brand-wrapper">
        <img src="{{ asset('logo.png') }}" class="brand-logo" >

        <div>
            <div class="brand-title">SADAR</div>
            <div class="brand-sub">Smart Alms Data Administration & Reporting</div>
        </div>
    </div>

    <div class="ms-auto d-flex gap-3 align-items-center">

        <a href="{{ route('zakat') }}"
           class="nav-menu {{ request()->routeIs('zakat') ? 'active' : '' }}">
            Input Data
        </a>

        <a href="{{ route('riwayat') }}"
           class="nav-menu {{ request()->routeIs('riwayat') ? 'active' : '' }}">
            History
        </a>

        <a href="{{ route('laporan') }}"
           class="nav-menu {{ request()->routeIs('laporan') ? 'active' : '' }}">
            Report
        </a>

        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-danger btn-sm">
                Logout
            </button>
        </form>

    </div>

</nav>