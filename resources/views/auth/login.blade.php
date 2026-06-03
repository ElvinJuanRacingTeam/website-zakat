<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SADAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            Transparan, Akurat &<br>
            Terdokumentasi Amanah
        </h1>

        <p class="desc">
            SADAR membantu pengelolaan zakat fitrah,
            zakat mal, fidyah, infaq, dan shodaqoh
            secara digital, transparan, serta mudah
            digunakan oleh pengurus masjid.
        </p>

        <div class="feature-grid">

            <div class="feature-card">
                <h4>Mudah & Praktis</h4>
                <p>
                    Pencatatan zakat cepat,
                    rapi, dan mudah digunakan.
                </p>
            </div>

            <div class="feature-card">
                <h4>Kuitansi Instan</h4>
                <p>
                    Cetak bukti pembayaran
                    otomatis secara langsung.
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

            <h1>Selamat Datang Kembali</h1>

            <p class="subtitle">
                Silakan login untuk mengakses sistem SADAR.
            </p>

            @if(session('status'))
                <div style="
                    background:#ecfdf5;
                    color:#166534;
                    padding:14px;
                    border-radius:14px;
                    margin-bottom:20px;
                    border:1px solid #bbf7d0;
                ">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        required
                        autofocus
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

                <button type="submit" class="login-btn">
                    Masuk Sekarang
                </button>
            </form>

            <div class="register-text">
                Belum punya akun?
                <a href="{{ route('register') }}">
                    Daftar Sekarang
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
