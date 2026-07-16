<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Đăng nhập</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- BỘ CSS GIA CỐ: KHUNG VUÔNG LIQUID & TEXTBOX KÍNH THỰC TẾ -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body, html {
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: 'Figtree', sans-serif;
        }
        
        /* Nền không gian Liquid */
        .liquid-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #2f2f2f, #636363, #414946);
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Các khối nước mờ ảo bay lơ lửng phía sau */
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            mix-blend-mode: screen;
            animation: floatAnimation 14s ease-in-out infinite alternate;
        }
        .orb-1 { width: 400px; height: 400px; background: #00f5d4; top: -80px; left: -80px; }
        .orb-2 { width: 500px; height: 500px; background: #7209b7; bottom: -120px; right: -60px; animation-delay: -4s; }
        .orb-3 { width: 300px; height: 300px; background: #ff007f; top: 25px; right: -100px; animation-delay: -8s; }

        @keyframes floatAnimation {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, 30px) scale(1.1); }
        }

        /* KHUNG VUÔNG BAO QUANH - CÁC CẠNH CHUYỂN ĐỘNG GỢN SÓNG (Liquid Square Frame) */
        .liquid-glass-box {
            width: 100%;
            max-width: 485px;
            padding: 55px 45px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 30px 70px -15px rgba(0, 0, 0, 0.6);
            z-index: 10;
            
            /* Tạo chuyển động gợn sóng chạy dọc theo phom hộp vuông */
            animation: squareEdgeMorphing 9s ease-in-out infinite;
        }

        /* Thuật toán tạo độ lồi lõm chuyển động nhẹ trên 4 cạnh vuông */
        @keyframes squareEdgeMorphing {
            0% {
                border-radius: 24px 45px 30px 50px / 45px 30px 50px 24px;
            }
            33% {
                border-radius: 40px 24px 55px 35px / 28px 48px 24px 50px;
            }
            66% {
                border-radius: 24px 50px 30px 45px / 50px 24px 45px 35px;
            }
            100% {
                border-radius: 24px 45px 30px 50px / 45px 30px 50px 24px;
            }
        }

        /* Tiêu đề */
        .form-header {
            text-align: center;
            margin-bottom: 38px;
        }
        .form-header h2 {
            color: #ffffff;
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .form-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14.5px;
            font-weight: 500;
        }

        /* Khung chứa nhập liệu */
        .form-group {
            width: 100%;
            margin-bottom: 24px;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            font-weight: 600;
            margin-left: 14px;
            margin-bottom: 8px;
        }

        /* TEXTBOX PHONG CÁCH KÍNH (Glassmorphic Inputs) - CĂN ĐỀU CẠNH BÊN */
        .liquid-textbox {
            width: 100%; /* Giãn khít 2 bên cạnh box */
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            border-radius: 16px; /* Dáng vuông bo góc đồng bộ */
            padding: 16px 20px;
            font-size: 15.5px;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(255, 255, 255, 0.05), 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .liquid-textbox::placeholder {
            color: rgba(255, 255, 255, 0.35);
        }
        .liquid-textbox:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(0, 245, 212, 0.6);
            box-shadow: inset 0 2px 4px rgba(255, 255, 255, 0.05), 0 0 15px rgba(0, 245, 212, 0.25);
        }

        /* Tùy chọn hàng phụ */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding: 0 6px;
        }
        .form-options label {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }
        .form-options input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #00f5d4;
        }
        .form-options a {
            color: #00f5d4;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        .form-options a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        /* NÚT BẤM RAINBOW WAVE GLOW VÀNG ÓNG TÍM LED */
        .rainbow-btn-wrapper {
            position: relative;
            width: 100%;
            margin-top: 5px;
        }
        .rainbow-glow {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(90deg, #ff0000, #0986b7, #00d81d, #d0f500, #ff0000);
            background-size: 300% 100%;
            border-radius: 16px; /* Bo góc tiệp dáng với textbox */
            filter: blur(15px);
            opacity: 0.8;
            z-index: 1;
            animation: rainbowMovement 4s linear infinite;
        }
        .liquid-btn {
            position: relative;
            z-index: 2;
            width: 100%;
            background: linear-gradient(90deg, #ff007f, #7209b7, #00b4d8, #00f5d4, #ff007f);
            background-size: 300% 100%;
            color: #ffffff;
            border-radius: 16px; /* Bo góc tiệp dáng */
            padding: 16px 24px;
            font-size: 16.5px;
            font-weight: 700;
            letter-spacing: 0.5px;
            border: none;
            cursor: pointer;
            outline: none;
            transition: transform 0.2s ease;
            animation: rainbowMovement 4s linear infinite;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        @keyframes rainbowMovement {
            0% { background-position: 0% 0%; }
            100% { background-position: 300% 0%; }
        }
        .liquid-btn:hover { transform: scale(1.02); }
        .liquid-btn:active { transform: scale(0.98); }

        /* Đăng ký */
        .register-footer {
            text-align: center;
            margin-top: 35px;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }
        .register-footer p {
            color: rgba(255, 255, 255, 0.65);
            font-size: 14px;
        }
        .register-footer a {
            color: #00f5d4;
            font-weight: 700;
            text-decoration: none;
        }
        .register-footer a:hover {
            text-decoration: underline;
        }

        .error-msg {
            margin-top: 6px;
            color: #ffb3b3;
            background: rgba(239, 68, 68, 0.25);
            padding: 6px 16px;
            border-radius: 12px;
            font-size: 12.5px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="liquid-container">
        <!-- Đèn nền Orbs trang trí -->
        <div class="floating-orb orb-1"></div>
        <div class="floating-orb orb-2"></div>
        <div class="floating-orb orb-3"></div>
        
        <!-- Khung vuông Liquid chuyển động gợn sóng -->
        <div class="liquid-glass-box">
            
            <!-- Header Chào Mừng -->
            <div class="form-header">
                <h2>Chào mừng trở lại!</h2>
                <p>Vui lòng đăng nhập để tiếp tục truy cập hệ thống.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div style="margin-bottom: 18px; text-align: center; color: #00f5d4; background: rgba(255,255,255,0.08); padding: 10px; border-radius: 12px; font-size: 14px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="liquid-textbox" 
                           type="email" name="email" value="{{ old('email') }}" 
                           required autofocus autocomplete="username" 
                           placeholder="name@example.com" />
                    
                    @if ($errors->has('email'))
                        <div class="error-msg">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="liquid-textbox"
                           type="password"
                           name="password"
                           required autocomplete="current-password" 
                           placeholder="••••••••" />
                    
                    @if ($errors->has('password'))
                        <div class="error-msg">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Ghi nhớ đăng nhập</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>

                <!-- Nút bấm hào quang sóng cầu vồng dáng vuông bo góc -->
                <div class="rainbow-btn-wrapper">
                    <div class="rainbow-glow"></div>
                    <button type="submit" class="liquid-btn">
                        Đăng nhập
                    </button>
                </div>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <div class="register-footer">
                        <p>
                            Chưa có tài khoản? 
                            <a href="{{ route('register') }}">Đăng ký ngay</a>
                        </p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>