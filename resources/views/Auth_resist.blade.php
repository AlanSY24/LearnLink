<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/header_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Auth.css') }}">
</head>

<body>
    <script src="{{ asset('js/nav.js') }}"></script>
    <x-nav />
    <div class="container" id="registerForm">
        <form id="registrationForm" action="/register" method="POST" class="form-container">
            <a href="#" class="back-icon">
                <i class="fas fa-caret-left"></i> back
            </a>
            <h1>註冊</h1>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="帳號" name="registerAccount" required pattern="^[a-zA-Z0-9_.]{4,30}$"
                    maxlength="30" title="帳號必須是4-30個字符，只能包含英文字母、數字、底線和點">
            </div>
            <div class="textbox">
                <i class="fa-solid fa-signature"></i>
                <input type="text" placeholder="姓名" name="registerName" required maxlength="30" title="姓名不能超過30個字符">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="密碼" name="registerPassword" required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,30}$" maxlength="30" id="rps"
                    title="密碼必須是8-30個字符，包含至少一個大寫字母、一個小寫字母和一個數字">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="確認密碼" name="password_confirmation" id="rpsc" required>
            </div>
            <div class="textbox">
                <i class="fas fa-envelope"></i>
                <input type="email" id="emailInReg" placeholder="電子信箱" name="registerEmail" required>
            </div>
            <div class="textbox">
                <i class="fa-solid fa-restroom"></i>
                <select name="registerGender" required>
                    <option value="">請選擇您的性別</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                </select>

            </div>
            <button type="submit" class="btn">註冊</button>
            <div class="links">
                <a href="#" data-show-form="login-form">登入</a>
                <a href="#" id="forgotPasswordLink">忘記密碼？</a>
            </div>
        </form>
    </div>

    <x-footer_alpha />
</body>

</html>