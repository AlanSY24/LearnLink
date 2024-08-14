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
                <a href="#" data-show-form="registerForm">註冊</a>
                <a href="{{ route('resetPassword') }}" id="forgotPasswordLink">忘記密碼？</a>
            </div>
        </form>
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 d-none outdiv"
        id="registerForm">
        <form id="registrationForm" action="/register" method="POST"
            class="form-container register-and-forgot-container rounded-3 shadow p-4 p-md-5 position-relative">
            @csrf
            <a href="{{ route('homePage') }}" class="position-absolute top-0 start-0 m-2 back-icon">
                <i class="fas fa-caret-left"> back</i>
            </a>
            <h1 class="mb-4 text-center">註冊</h1>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="帳號" name="registerAccount" required
                            pattern="^[a-zA-Z0-9_.]{4,30}$" maxlength="30" title="帳號必須是4-30個字符，只能包含英文字母、數字、底線和點">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fa-solid fa-signature"></i>
                        <input type="text" placeholder="姓名" name="registerName" required maxlength="30"
                            title="姓名不能超過30個字符">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="密碼" name="registerPassword" required
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,30}$" maxlength="30" id="rps"
                            title="密碼必須是8-30個字符，包含至少一個大寫字母、一個小寫字母和一個數字">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="確認密碼" name="password_confirmation" id="rpsc" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="emailInReg" placeholder="電子信箱" name="registerEmail" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fa-solid fa-person-half-dress"></i>
                        <select name="registerGender" required>
                            <option value="">請選擇您的性別</option>
                            <option value="1">男性</option>
                            <option value="2">女性</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row g-3 align-items-center mt-4">
                <div class="col-md-9">
                    <div class="border p-2">預留的div</div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-my w-100 btn-in-register">註冊</button>
                </div>
            </div>
            <div class="links mt-3">
                <a href="#" data-show-form="login-form">登入</a>
                <a href="{{ route('resetPassword') }}" id="forgotPasswordLink">忘記密碼？</a>
            </div>
        </form>
    </div>

    <!-- 驗證碼對話框 -->
    <div id="verificationDialog" class="modal" style="display: none;">
        <div class="modal-content">
            <h2>請輸入驗證碼</h2>
            <p>驗證碼已發送到您的郵箱，請查收並在下方輸入。</p>
            <input type="text" id="verificationCode" placeholder="驗證碼" required>
            <button id="submitVerification">驗證</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('registrationForm');
            const rpsInput = document.getElementById('rps');
            const rpscInput = document.getElementById('rpsc');
            const verificationDialog = document.getElementById('verificationDialog');
            const verificationCode = document.getElementById('verificationCode');
            const submitVerification = document.getElementById('submitVerification');

            // ↓↓↓↓↓ 檢查兩次輸入的密碼是否符合
            function checkPassword() {
                const rps = rpsInput.value;
                const rpsc = rpscInput.value;

                if (rps !== rpsc) {
                    rpscInput.setCustomValidity('密碼不符');
                    return false;
                } else {
                    rpscInput.setCustomValidity('');
                    return true;
                }
            }

            // ↓↓↓↓↓ 每次變動檢查一次
            rpsInput.addEventListener('input', checkPassword);
            rpscInput.addEventListener('input', checkPassword);

            // ↓↓↓↓↓送出註冊表單
            form.addEventListener('submit', async function (event) {
                event.preventDefault();
                if (!checkPassword()) {
                    return;
                }

                const formData = new FormData(form);
                try {
                    const response = await fetch('/pre-register', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    });
                    if (!response.ok) {
                        throw new Error('後端伺服器錯誤');
                    }
                    const data = await response.json();
                    if (data.success) {
                        alert(data.message);
                        verificationDialog.style.display = 'block';
                    } else {
                        alert('後端錯誤: ' + (data.error || '發生錯誤，請重試。'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('前端錯誤: ' + error.message);
                }
            });

            submitVerification.addEventListener('click', async function () {
                const formData = new FormData();
                formData.append('verificationCode', verificationCode.value);
                formData.append('email', document.getElementById('emailInReg').value);

                try {
                    const response = await fetch('/register', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    });
                    if (!response.ok) {
                        throw new Error('後端伺服器錯誤');
                    }
                    const data = await response.json();
                    if (data.message) {
                        alert(data.message);
                        verificationDialog.style.display = 'none';
                        // 註冊成功後的操作，例如重定向
                        window.location.href = '/login';
                    } else {
                        alert('後端錯誤: ' + (data.error || '註冊失敗，請重試。'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('前端錯誤: ' + error.message);
                }
            });

        });
    </script>

    <!-- 忘記密碼 -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100 d-none outdiv" id="forgotForm">
        <form action="/forgot-password" method="POST" class="form-container rounded-3 shadow p-4 position-relative">
            @csrf
            <a href="{{ url('/homePage') }}" class="position-absolute top-0 start-0 m-2 back-icon">
                <i class="fas fa-caret-left"> back</i>
            </a>
            <h1 class="mb-4">忘記密碼</h1>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-key"></i>
                    <input type="text" placeholder="輸入帳號" name="forgotAccount" id="fotget_account" required
                        value="AA01">
                </div>
            </div>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="電子信箱" name="forgotEmail" required value="sean2000.cy@gmail.com">
                </div>
            </div>
            <div class="links mt-3">
                <button type="submit" id="forgotBtn" class="btn btn-my w-100">寄送驗證碼</button>
            </div>
            <div class="links">
                <a href="#" data-show-form="login-form">登入</a>
                <a href="#" data-show-form="registerForm">註冊</a>
            </div>
        </form>
    </div>
    <!-- 驗證視窗，寄出驗證碼後顯示此視窗 -->
    <dialog id="fotget_2_dialog" class="form-container rounded-3 shadow p-4 position-relative">
        <form method="POST" action="{{ route('forgot_2') }}">
            @csrf
            <h1 class="mb-4">重設密碼</h1>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-envelope"></i>
                    <input value="{{ session('forgotEmail') }}" disabled> <!-- 假的輸入框 -->
                </div>
            </div>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-key"></i>
                    <input value="{{ session('forgotAccount') }}" disabled>
                </div>
            </div>
            <!-- 真的輸入框 -->
            <input type="email" name="forgot_2_email" value="{{ session('forgot_2_email') }}" readonly required
                class="d-none">
            <input type="text" name="forgot_2_account" value="{{ session('forgot_2_account') }}" readonly required
                class="d-none">
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-key"></i>
                    <input type="text" id="fotget_2_code" placeholder="輸入收到的驗證碼" name="fotget_2_code" required>
                </div>
            </div>
            <div class="links mt-3">
                <button type="submit" class="btn btn-my w-100">確認</button>
            </div>
        </form>
    </dialog>

    <script src="{{ asset('js/checkout_form.js') }}"></script>

</body>

</html>