<nav class="navbar-custom d-flex align-items-center">

    <div class="brand-wrapper">
        <img src="{{ asset('logo.png') }}" class="brand-logo">

        <div>
            <div class="brand-title">SADAR</div>
            <div class="brand-sub">MASJID NURUL HIKMAH</div>
        </div>
    </div>

    <div class="ms-auto d-flex gap-3">

        <a href="/" class="nav-menu {{ request()->routeIs('zakat') ? 'active' : '' }}">
            Input Baru
        </a>

        <a href="{{ route('riwayat') }}" class="nav-menu {{ request()->routeIs('riwayat') ? 'active' : '' }}">
            Riwayat
        </a>

        <a href="{{ route('laporan') }}" class="nav-menu {{ request()->routeIs('laporan') ? 'active' : '' }}">
            Laporan
        </a>

    </div>

</nav>
