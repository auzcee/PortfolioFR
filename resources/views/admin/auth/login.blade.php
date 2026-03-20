<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortFolioPH Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #F3F6F8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ========== HEADER ========== */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: white;
            border-bottom: 1px solid #E1E4E8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
            flex: 0 0 auto;
        }

        .header-logo {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #0A66C2 0%, #0084F0 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(10, 102, 194, 0.25);
            transition: transform 0.2s ease;
        }

        .header-logo:hover {
            transform: scale(1.05);
        }

        .header-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .header-title {
            font-size: 13px;
            font-weight: 700;
            color: #0A66C2;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .header-subtitle {
            font-size: 11px;
            color: #8C95A0;
            letter-spacing: 0.3px;
            font-weight: 500;
        }

        .header-center {
            flex: 1;
            text-align: center;
            display: none;
        }

        .header-center-text {
            font-size: 12px;
            font-weight: 700;
            color: #64748B;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 0 0 auto;
        }

        .header-brand {
            font-size: 14px;
            font-weight: 700;
            color: #0A66C2;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.5px;
        }

        .flag-icon {
            font-size: 18px;
            line-height: 1;
        }

        /* ========== MAIN CONTAINER ========== */
        .main-container {
            flex: 1;
            display: grid;
            grid-template-columns: 40% 60%;
            margin-top: 64px;
            gap: 0;
        }

        /* ========== LEFT PANEL (HERO) ========== */
        .hero-panel {
            background: linear-gradient(135deg, #F3F6F8 0%, #EBF1F5 50%, #E3F0FA 100%);
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background network */
        .hero-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 15% 25%, rgba(10, 102, 194, 0.04) 0%, transparent 50%),
                radial-gradient(circle at 85% 75%, rgba(10, 102, 194, 0.04) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(10, 102, 194, 0.02) 0%, transparent 50%);
            pointer-events: none;
            z-index: 1;
        }

        /* Portfolio grid watermark */
        .hero-panel::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(0deg, rgba(10, 102, 194, 0.015) 0px, rgba(10, 102, 194, 0.015) 1px, transparent 1px, transparent 80px),
                repeating-linear-gradient(90deg, rgba(10, 102, 194, 0.015) 0px, rgba(10, 102, 194, 0.015) 1px, transparent 1px, transparent 80px);
            pointer-events: none;
            z-index: 0;
            opacity: 0.6;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .hero-logo {
            width: 88px;
            height: 88px;
            background: white;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 28px;
            box-shadow: 0 12px 32px rgba(10, 102, 194, 0.18);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hero-logo:hover {
            transform: translateY(-4px);
        }

        .hero-logo i {
            font-size: 44px;
            background: linear-gradient(135deg, #0A66C2 0%, #0084F0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-tagline {
            font-size: 26px;
            font-weight: 700;
            color: #0A2540;
            margin-bottom: 12px;
            letter-spacing: -0.4px;
            line-height: 1.3;
        }

        .hero-subtitle {
            font-size: 15px;
            color: #64748B;
            margin-bottom: 48px;
            line-height: 1.6;
            max-width: 320px;
            font-weight: 400;
        }

        .features-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 48px;
        }

        .features-list li {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 14px;
            color: #0A2540;
            font-weight: 500;
            transition: transform 0.2s ease;
        }

        .features-list li:hover {
            transform: translateX(4px);
        }

        .features-list i {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #0A66C2 0%, #0084F0 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 13px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(10, 102, 194, 0.2);
        }

        .hero-footer {
            font-size: 12px;
            color: #8C95A0;
            margin-top: 48px;
            padding-top: 24px;
            border-top: 1px solid rgba(10, 102, 194, 0.1);
        }

        /* ========== RIGHT PANEL (LOGIN CARD) ========== */
        .login-panel {
            padding: 60px 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            position: relative;
        }

        .card-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .lock-icon {
            width: 68px;
            height: 68px;
            background: linear-gradient(135deg, #0A66C2 0%, #0084F0 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 24px;
            box-shadow: 0 16px 32px rgba(10, 102, 194, 0.25);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .lock-icon:hover {
            transform: translateY(-4px);
        }

        .card-title {
            font-size: 30px;
            font-weight: 700;
            color: #0A2540;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .card-subtitle {
            font-size: 14px;
            color: #64748B;
            font-weight: 400;
        }

        /* ========== FORM ========== */
        .form-wrapper {
            margin-top: 32px;
        }

        .form-field {
            margin-bottom: 22px;
            position: relative;
        }

        .form-field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #0A2540;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .form-field input {
            width: 100%;
            padding: 13px 16px;
            font-size: 15px;
            border: 1.5px solid #D3D9E8;
            border-radius: 10px;
            background: #FAFBFC;
            transition: all 0.25s ease;
            color: #0A2540;
            font-weight: 400;
            letter-spacing: 0.3px;
        }

        .form-field input::placeholder {
            color: #8C95A0;
            font-weight: 400;
        }

        .form-field input:focus {
            outline: none;
            border-color: #0A66C2;
            background: white;
            box-shadow: 0 0 0 4px rgba(10, 102, 194, 0.1), 0 4px 12px rgba(10, 102, 194, 0.12);
        }

        .form-field input:hover:not(:focus) {
            border-color: #8C95A0;
            background: white;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 36px;
            cursor: pointer;
            color: #8C95A0;
            font-size: 15px;
            transition: all 0.2s ease;
            border: none;
            background: none;
            padding: 6px;
            display: flex;
            align-items: center;
        }

        .password-toggle:hover {
            color: #0A66C2;
            transform: scale(1.1);
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            margin-bottom: 28px;
        }

        .form-check input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #0A66C2;
            flex-shrink: 0;
            border: 1.5px solid #D3D9E8;
            border-radius: 5px;
            transition: all 0.2s ease;
        }

        .form-check input:hover {
            border-color: #0A66C2;
        }

        .form-check input:checked {
            box-shadow: 0 2px 6px rgba(10, 102, 194, 0.25);
        }

        .form-check label {
            font-size: 14px;
            color: #64748B;
            cursor: pointer;
            font-weight: 400;
            margin: 0;
        }

        .submit-btn {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(135deg, #0A66C2 0%, #0052A3 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            box-shadow: 0 10px 24px rgba(10, 102, 194, 0.35);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 32px rgba(10, 102, 194, 0.45);
            background: linear-gradient(135deg, #0052A3 0%, #003A7A 100%);
        }

        .submit-btn:active {
            transform: translateY(0);
            box-shadow: 0 6px 16px rgba(10, 102, 194, 0.3);
        }

        .submit-btn i {
            margin-right: 10px;
        }

        /* ========== FOOTER SECTION ========== */
        .login-footer {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #E1E4E8;
        }

        .forgot-link {
            display: block;
            text-align: center;
            color: #0A66C2;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }

        .forgot-link:hover {
            color: #0052A3;
            transform: scale(1.02);
        }

        /* ========== ALERTS ========== */
        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: #FEE5E5;
            border: 1px solid #F5C6C6;
            color: #A93226;
        }

        .alert i {
            font-size: 14px;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .error-message {
            font-size: 12px;
            color: #A93226;
            margin-top: 6px;
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .error-message i {
            font-size: 12px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .main-container {
                grid-template-columns: 1fr;
            }

            .hero-panel {
                display: none;
            }

            .login-panel {
                padding: 40px 24px;
                min-height: calc(100vh - 64px);
            }

            .login-card {
                max-width: 380px;
            }

            .ph-accent {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 16px;
                height: 56px;
            }

            .header-center {
                display: none;
            }

            .header-right {
                display: none;
            }

            .header-logo {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .main-container {
                margin-top: 56px;
            }

            .login-panel {
                padding: 32px 16px;
            }

            .login-card {
                max-width: 100%;
            }

            .card-title {
                font-size: 26px;
            }

            .hero-panel {
                padding: 60px 40px;
            }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <div class="header-left">
            <div class="header-logo">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="header-text">
                <div class="header-title">PortFolioPH</div>
                <div class="header-subtitle">Admin</div>
            </div>
        </div>
        <div class="header-center">
            <div class="header-center-text">Admin Panel</div>
        </div>
        <div class="header-right">
            <div class="header-brand">
                <span>PortFolioPH</span>
                <span class="flag-icon">🇵🇭</span>
            </div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <div class="main-container">
        <!-- LEFT PANEL: HERO SECTION -->
        <section class="hero-panel">
            <div class="hero-content">
                <div class="hero-logo">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h2 class="hero-tagline">Professional Portfolio Management</h2>
                <p class="hero-subtitle">Talent marketplace and admin dashboard for creative professionals in the Philippines</p>
                
                <ul class="features-list">
                    <li><i class="fas fa-users"></i> <span>Manage users and roles</span></li>
                    <li><i class="fas fa-images"></i> <span>Review portfolios</span></li>
                    <li><i class="fas fa-briefcase"></i> <span>Post job listings</span></li>
                    <li><i class="fas fa-chart-line"></i> <span>Track analytics</span></li>
                    <li><i class="fas fa-lock"></i> <span>Secure admin panel</span></li>
                </ul>

                <div class="hero-footer">© 2026 PortFolioPH • All rights reserved</div>
            </div>
        </section>

        <!-- RIGHT PANEL: LOGIN FORM -->
        <section class="login-panel">
            <div class="login-card">
                <div class="card-header">
                    <div class="lock-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h1 class="card-title">Admin Login</h1>
                    <p class="card-subtitle">Sign in to access the PortFolioPH admin dashboard</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <strong>Login Failed</strong>
                            @foreach ($errors->all() as $error)
                                <div class="error-message"><i class="fas fa-times"></i> {{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.login.store') }}" method="POST" class="form-wrapper">
                    @csrf

                    <div class="form-field">
                        <label for="email">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="@error('email') is-invalid @enderror"
                            placeholder="admin@portfolio.ph" 
                            required 
                            value="{{ old('email') }}"
                            autofocus
                        >
                        @error('email')
                            <div class="error-message"><i class="fas fa-times-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="password">Password</label>
                        <div style="position: relative;">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="@error('password') is-invalid @enderror"
                                placeholder="Enter your password" 
                                required
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-message"><i class="fas fa-times-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <label for="remember">Remember me on this device</label>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-sign-in-alt"></i> SIGN IN
                    </button>

                    <div class="login-footer">
                        <a href="#" class="forgot-link">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = event.target.closest('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>