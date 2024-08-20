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
        <form id="registForm" action="{{ route('register') }}" method="POST" class="form-container">
            <a href="{{ asset('homePage') }}" class="back-icon">
                <i class="fas fa-caret-left"></i> back
            </a>
            <h1>註冊</h1>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="帳號" name="account" required pattern="^[a-zA-Z0-9_.]{4,30}$"
                    maxlength="30" title="帳號必須是4-30個字符，只能包含英文字母、數字、底線和點">
            </div>
            <div class="textbox">
                <i class="fa-solid fa-signature"></i>
                <input type="text" placeholder="姓名" name="name" required maxlength="30" title="姓名不能超過30個字符">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="密碼至少八碼 包含數字 英文大小寫" name="password" required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,30}$" maxlength="30" id="rps"
                    title="密碼必須是8-30個字符，包含至少一個大寫字母、一個小寫字母和一個數字">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="確認密碼" name="password_confirmation" id="rpsc" required>
            </div>
            <div class="textbox">
                <i class="fa-solid fa-restroom"></i>
                <select name="gender" required value="2">
                    <option value="">請選擇您的性別</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                </select>
            </div>
            <div class="textbox">
                <i class="fas fa-envelope"></i>
                <input type="email" id="emailInReg" placeholder="電子信箱" name="email" required>
            </div>
            <button type="submit" class="btn">註冊</button>
            <div class="links">
                <a href="{{ route('login') }}" data-show-form="login-form">登入</a>
                <a href="{{ route('resetPassword') }}" id="forgotPasswordLink">忘記密碼？</a>
            </div>
        </form>
    </div>
    <dialog id="registDialog">
        <div class="close-button" onclick="registDialog.close()">&#10005;</div>
        <h3>輸入驗證碼</h3>
        <form id="verifyForm">
            <div class="textbox" style="width: 105% !important;">
                <i class="fas fa-lock"></i>
                <input type="text" placeholder="請輸入驗證碼" name="code" required>
            </div>
            <button type="submit" id="verifyButton">驗證</button>
        </form>
    </dialog>
    

    <x-footer_alpha />
    <script src="{{ asset('js/loadingMask.js') }}"></script><!-- 引入ladingMask -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('rps');
            const confirmPasswordInput = document.getElementById('rpsc');
            const form = document.getElementById('registForm');
            const registDialog = document.getElementById('registDialog');
            const verifyForm = document.getElementById('verifyForm');

            verifyForm.addEventListener('submit', async function(event) {
                event.preventDefault();
                showLoadingMask();

                try {
                    const formData = new FormData(verifyForm);
                    const response = await fetch("{{ route('registVerify') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(Object.fromEntries(formData.entries()))
                    });

                    const data = await response.json();

                    if (data.success) {
                        hideLoadingMask();
                        alert('註冊成功！');
                        window.location.href = "{{ route('login') }}"; // 回到登入頁面
                    } else {
                        hideLoadingMask();
                        alert(data.message);
                    }
                } catch (error) {
                    hideLoadingMask();
                    console.error('驗證過程中發生錯誤:', error);
                    alert('驗證過程中發生錯誤，請稍後再試。');
                }
            });

            function validatePassword() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.setCustomValidity('密碼不一致');
                } else {
                    confirmPasswordInput.setCustomValidity('');
                }
            }

            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePassword);

            form.addEventListener('submit', async function(event) {
                event.preventDefault();
                validatePassword();

                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                showLoadingMask();

                try {
                    const formData = new FormData(event.target);
                    const requestData = Object.fromEntries(formData.entries());

                    const response = await fetch("{{ route('register') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(requestData)
                    });

                    const data = await response.json();

                    if (data.success) {
                        hideLoadingMask();
                        alert(data.message);
                        registDialog.showModal();
                    } else {
                        hideLoadingMask();
                        alert(data.message);
                    }
                } catch (error) {
                    hideLoadingMask();
                    console.error('在前端就catch到Error了。後端資訊:', error);
                }
            });
        });
    </script>
</body>

</html>