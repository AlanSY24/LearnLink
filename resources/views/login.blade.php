<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- 引入 FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <!-- 登入 -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100 outdiv" id="login-form">
        <form action="{{ route('login') }}" method="POST" class="form-container rounded-3 shadow p-4 position-relative">
            @csrf
            <a href="{{ url('/homePage') }}" class="position-absolute top-0 start-0 m-2 back-icon">
                <i class="fas fa-caret-left"> back</i>
            </a>
            <h1 class="mb-4">登入</h1>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="帳號" name="loginAccount" value="{{ old('loginAccount') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="密碼" name="loginPassword" required>
                </div>
            </div>
            <div class="mb-3 p-2">
                <!-- @if ($errors->any())
                    <div class="alert alert-danger m-0">
                        <ul class="p-0 m-0">
                            @foreach ($errors->all() as $error)
                                <li class="warning-message">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif -->
            </div>
            <div class="links mt-3">
                <button type="submit" class="btn btn-my w-100">登入</button>
            </div>
            <div class="links">
                <a href="{{ route('registPage') }}" data-show-form="registerForm">註冊</a>
                <a href="{{ route('resetPassword') }}" id="forgotPasswordLink">忘記密碼？</a>
            </div>
        </form>
    </div>

    

</body>

</html>