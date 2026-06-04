<!DOCTYPE html>
<html lang="en">

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
                    <p>Community Zakat Management System</p>
                </div>

            </div>

            <div class="badge-text">
                ✨ Trusted Zakat Digitalization
            </div>

            <h1>
                Create Your<br>
                Mosque Account
            </h1>

            <p class="desc">
                Manage Zakat al-Fitr, Zakat al-Mal,
                Fidyah, Infaq, Sadaqah, and payment
                reports digitally with a secure,
                transparent, and user-friendly system.
            </p>

            <div class="feature-grid">

                <div class="feature-card">
                    <h4>Secure Data</h4>
                    <p>
                        Zakat payment records are stored
                        securely and organized efficiently.
                    </p>
                </div>

                <div class="feature-card">
                    <h4>Instant Receipts</h4>
                    <p>
                        Generate and print payment
                        receipts instantly.
                    </p>
                </div>

            </div>

            <div class="footer-left">
                © SADAR Zakat Management System
            </div>

        </div>

        <!-- RIGHT PANEL -->
        <div class="right-panel">

            <div class="login-card">

                <h1>Create Account</h1>

                <p class="subtitle">
                    Create a new account for your mosque
                </p>
                @if ($errors->any())
                    <div style="background:#ffebee;padding:10px;border-radius:8px;color:red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group">
                        <label>Mosque ID</label>

                        <input type="text" name="id_masjid" value="{{ old('id_masjid') }}" placeholder="MASJID001"
                            required>

                        @error('id_masjid')
                            <small style="color:red">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="input-group">
                        <label>Mosque Name</label>

                        <input type="text" name="nama_masjid" value="{{ old('nama_masjid') }}"
                            placeholder="Masjid Al-Fajr" required>

                        @error('nama_masjid')
                            <small style="color:red">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="input-group">
                        <label>Email</label>

                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com"
                            required>

                        @error('email')
                            <small style="color:red">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label>Password</label>

                        <input type="password" name="password" placeholder="Enter password" required>

                        @error('password')
                            <small style="color:red">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label>Confirm Password</label>

                        <input type="password" name="password_confirmation" placeholder="Re-enter password" required>
                    </div>

                    <button type="submit" class="login-btn">
                        Create Account
                    </button>

                    <div class="register-text">
                        Already have an account?
                        <a href="{{ route('login') }}">
                            Sign In
                        </a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
