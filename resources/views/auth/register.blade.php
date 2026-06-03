<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SADAR</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    @vite('resources/css/auth.css')
</head>
<body>

<div class="login-wrapper">

    <!-- LEFT PANEL -->
    <div class="left-panel">

        <div class="brand">

            <div class="logo-box">
                <img src="{{ asset('logo.png') }}" alt="Logo">
            </div>

            <div>
                <h2>SADAR</h2>
                <p>Sistem Data Zakat Warga</p>
            </div>

        </div>

        <div class="badge-text">
            ✨ Digitalisasi Zakat Amanah
        </div>

        <h1>
            Buat Akun<br>
            Masjid Anda
        </h1>

        <p class="desc">
            Kelola zakat fitrah, zakat mal,
            fidyah, infaq, shodaqoh, dan
            laporan pembayaran secara digital,
            aman, dan mudah digunakan.
        </p>

        <div class="feature-grid">

            <div class="feature-card">
                <h4>Data Aman</h4>
                <p>
                    Data pembayaran zakat
                    tersimpan rapi dan aman.
                </p>
            </div>

            <div class="feature-card">
                <h4>Kuitansi Instan</h4>
                <p>
                    Cetak bukti pembayaran
                    otomatis dengan cepat.
                </p>
            </div>

        </div>

        <div class="footer-left">
            © SADAR Sistem Zakat
        </div>

    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">

        <div class="login-card">

            <h1>Daftar Akun</h1>

            <p class="subtitle">
                Buat akun baru untuk masjid Anda
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group">
                    <label>Nama Masjid / Pengurus</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama masjid"
                        required
                    >

                    @error('name')
                        <small style="color:red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        required
                    >

                    @error('email')
                        <small style="color:red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                    @error('password')
                        <small style="color:red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Konfirmasi Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                    >
                </div>

                <button type="submit" class="login-btn">
                    Daftar Sekarang
                </button>

                <div class="register-text">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>