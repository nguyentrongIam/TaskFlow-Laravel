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

    <!-- BỘ CSS THUỒN GIA CỐ - ÉP BUỘC GIAO DIỆN CHUẨN TRONG MỌI TRƯỜNG HỢP -->
    <style>
        /* Căn giữa toàn bộ trang web */
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
        
        /* Nền chuyển màu Liquid Gradient */
        .liquid-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center; /* Căn giữa ngang */
            align-items: center;     /* Căn giữa dọc */
            background: linear-gradient(135deg, #3a1c71, #d76d77, #ffaf7b);
            padding: 20px;
            position: relative;
        }

        /* Định hình cái Box ở chính giữa màn hình */
        .liquid-glass-box {
            width: 100%;
            max-width: 420px; /* Khống chế chiều rộng chuẩn của hộp */
            padding: 45px 35px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px 30px 60px 40px; /* Bo góc dạng giọt nước */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
            transition: all 0.5s ease-in-out;
            z-index: 10;
        }
        .liquid-glass-box:hover {
            border-radius: 40px 60px 30px 70px;
        }

        /* Tiêu đề */
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-header h2 {
            color: #ffffff;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }
        .form-header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            font-weight: 500;
        }

        /* Khung chứa các ô nhập liệu */
        .form-group {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            margin-left: 18px;
            margin-bottom: 6px;
        }

        /* Định dạng Textbox căn đều 2 cạnh, bo tròn giọt nước */
        .liquid-textbox {
            width: 100%; /* Căn đều khít 2 cạnh của Box */
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            border-radius: 9999px;
            padding: 14px 24px;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
            text-align: center; /* Đưa chữ và placeholder vào chính giữa ô nhập liệu */
        }
        .liquid-textbox::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        .liquid-textbox:focus {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        /* Hàng Ghi nhớ & Quên mật khẩu */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
            margin-bottom: 25px;
            padding: 0 10px;
        }
        .form-options label {
            display: flex;
            align-items: center;
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
        }
        .form-options input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #00b4d8;
        }
        .form-options a {
            color: #a5f3fc;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        .form-options a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        /* Nút đăng nhập chất lỏng phát sáng */
        .liquid-btn {
            width: 100%;
            background: linear-gradient(90deg, #00b4d8, #0077b6, #7209b7);
            color: #ffffff;
            border-radius: 9999px;
            padding: 15px 24px;
            font-size: 16px;
            font-weight: 700;
            border: none;
            box-shadow: 0 0 20px rgba(0, 180, 216, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .liquid-btn:hover {
            box-shadow: 0 0 30px rgba(114, 9, 183, 0.6);
            transform: scale(1.02);
        }
        .liquid-btn:active {
            transform: scale(0.98);
        }

        /* Hàng đăng ký tài khoản mới */
        .register-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }
        .register-footer p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13.5px;
        }
        .register-footer a {
            color: #a5f3fc;
            font-weight: 700;
            text-decoration: none;
        }
        .register-footer a:hover {
            text-decoration: underline;
        }

        /* Thông báo lỗi */
        .error-msg {
            margin-top: 6px;
            color: #fca5a5;
            background: rgba(239, 68, 68, 0.2);
            padding: 6px 16px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="liquid-container">
        
        <!-- Khối thẻ Liquid Glass Card độc lập -->
        <div class="liquid-glass-box">
            
            <!-- Header Chào Mừng -->
            <div class="form-header">
                <h2>Chào mừng trở lại!</h2>
                <p>Vui lòng đăng nhập để tiếp tục truy cập hệ thống.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div style="margin-bottom: 15px; text-align: center; color: #a5f3fc; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 15px; font-size: 14px;">
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

                <!-- Submit Button -->
                <button type="submit" class="liquid-btn">
                    Đăng nhập
                </button>

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