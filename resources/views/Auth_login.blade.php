<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/header_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="login-page">
    <script src="{{ asset('js/nav.js') }}"></script>
    <x-nav />
    <div class="container" id="loginForm">
        <form action="{{ route('login') }}" method="POST" class="form-container">
            @csrf
            <a href="{{ route('homePage') }}" class="back-icon">
                <i class="fas fa-caret-left"></i> back
            </a>
            <h1>登入</h1>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="帳號" name="loginAccount" value="{{ old('loginAccount') }}" required>
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="密碼" name="loginPassword" required>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn">登入</button>
            <div class="links">
                <a href="{{ route('registPage') }}" data-show-form="registerForm">註冊</a>
                <a href="{{ route('resetPassword') }}" id="forgotPasswordLink">忘記密碼？</a>
            </div>
        </form>
    </div>
    <x-footer_alpha />
</body>
</html>