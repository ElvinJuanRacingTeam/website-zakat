
<!DOCTYPE html>
<html lang="en">
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
                <p>Community Zakat Management System</p>
            </div>

        </div>

        <div class="badge-text">
            ✨ Trusted Zakat Digitalization
        </div>

        <h1>
            Transparent, Accurate &<br>
            Trusted Documentation
        </h1>

        <p class="desc">
            SADAR helps mosque administrators
            manage Zakat al-Fitr, Zakat al-Mal,
            Fidyah, Infaq, and Sadaqah digitally
            with transparency and ease of use.
        </p>

        <div class="feature-grid">

            <div class="feature-card">
                <h4>Easy & Practical</h4>
                <p>
                    Fast, organized, and user-friendly
                    zakat recording system.
                </p>
            </div>

            <div class="feature-card">
                <h4>Instant Receipts</h4>
                <p>
                    Automatically generate and print
                    payment receipts instantly.
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

            <h1>Welcome Back</h1>

            <p class="subtitle">
                Sign in to access the SADAR system.
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
                    <label>Email atau ID Masjid</label>

                    <input
                        type="text"
                        name="login"
                        value="{{ old('login') }}"
                        placeholder="Email atau ID Masjid"
                        required
                        autofocus
                    >

                    @error('login')
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
                        placeholder="Enter password"
                        required
                    >

                    @error('password')
                        <small style="color:red">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <button type="submit" class="login-btn">
                    Sign In
                </button>
            </form>

            <div class="register-text">
                Don't have an account?
                <a href="{{ route('register') }}">
                    Create Account
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>