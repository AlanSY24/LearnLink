<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>重設密碼</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"></head>
<body>
    <div class="form-container">
        <h3>輸入新的密碼</h3>
        <form action="/reset_password" method="POST">
            <!-- CSRF Token for Laravel -->
            @csrf
            
            <div class="textbox">
                <label for="account">帳號： {{ session('account') }}</label>
            </div>
            
            <div class="textbox">
                <label for="email">Email： {{ session('email') }}</label>
            </div>
            
            <div class="textbox">
                <label for="new_password">新密碼</label>
                <input type="password" id="new_password" name="new_password" placeholder="輸入新密碼" required>
            </div>
            
            <div class="textbox">
                <label for="confirm_password">確認新密碼</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="確認新密碼" required>
            </div>
            
            <button type="submit" class="btn-my">提交</button>
        </form>
    </div>
</body>
</html>
