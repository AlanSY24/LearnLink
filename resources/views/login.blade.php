<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- 引入 FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: url('https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwyNzY3NzR8MHwxfGFsbHwxfHx8fHx8fHwxNjE3OTQ2NzY2&ixlib=rb-1.2.1&q=80&w=1080') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        width: 350px;
        text-align: center;
    }

    .register-and-forgot-container {
        width: 450px;
        max-width: 100%;
    }

    @media (min-width: 768px) {
        .register-and-forgot-container {
            width: 750px;
        }
    }

    .textbox {
        position: relative;
        height: 100%;
    }

    .textbox input {
        width: 100%;
        height: 100%;
        padding: 12px 12px 12px 40px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .textbox select {
        width: 100%;
        height: 100%;
        padding: 12px 12px 12px 40px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }



    .textbox i {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #999;
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .textbox input:focus {
        outline: none;
        border-color: #007bff;
    }

    .textbox input:focus+i {
        color: #007bff;
    }

    .row>* {
        padding-right: calc(var(--bs-gutter-x) * .5);
        padding-left: calc(var(--bs-gutter-x) * .5);
    }

    .row:last-of-type {
        margin-bottom: 1rem;
    }

    h1 {
        margin-bottom: 30px;
        color: #333;
        font-size: 24px;
    }

    .btn-my {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: linear-gradient(135deg, #ff7e5f, #feb47b);
        color: white;
        font-size: 18px;
        cursor: pointer;
        transition: background 0.3s ease;
        margin-bottom: 25px;
    }

    .btn-my:hover {
        background: linear-gradient(135deg, #feb47b, #ff7e5f);
    }

    .btn-verify {}

    .links {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }

    .links a {
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
    }

    .links a:hover {
        text-decoration: underline;
    }

    .back-icon {
        color: #ff7e5f;
        text-decoration: none;
        font-size: 18px;
    }

    .back-icon:hover {
        color: #007bff;
        text-decoration: underline;
        font-size: 18px;
    }

    li.warning-message {
        list-style-type: none;
    }

    #verificationDialog {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        max-width: 90%;
        width: 400px;
        /* Adjust as needed */
    }

    @media (min-width: 768px) {
        #verificationDialog {
            max-width: 500px;
        }
    }
</style>

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
                <a href="#" data-show-form="forgot-form">忘記密碼？</a>
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
                            <option value="3">其他</option>
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
                <a href="#" data-show-form="forgot-form">忘記密碼？</a>
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
                    const data = await response.json();
                    if (data.success) {
                        alert(data.message);
                        verificationDialog.style.display = 'block';
                    } else {
                        alert(data.error || '發生錯誤，請重試。');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('發生錯誤，請重試。');
                }
            });

            submitVerification.addEventListener('click', async function () {
                const formData = new FormData(form);
                formData.append('verificationCode', verificationCode.value);
                formData.append('email', document.getElementById('emailInReg').value); // 添加這行

                try {
                    const response = await fetch('/register', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    });
                    const data = await response.json();
                    if (data.message) {
                        alert(data.message);
                        verificationDialog.style.display = 'none';
                        // 註冊成功後的操作，例如重定向
                        window.location.href = '/login';
                    } else {
                        alert(data.error || '註冊失敗，請重試。');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('發生錯誤，請重試。');
                }
            });

        });
    </script>

    <!-- 忘記密碼 -->
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 d-none outdiv"
        id="forgot-form">
        <form action="/forgot-password" method="POST"
            class="form-container register-and-forgot-container rounded-3 shadow p-4 p-md-5 position-relative">
            <a href="{{ url('/homePage') }}" class="position-absolute top-0 start-0 m-2 back-icon">
                <i class="fas fa-caret-left"> back</i>
            </a>
            <h1 class="mb-4 text-center">忘記密碼</h1>
            <div class="row g-4">
                <div class="col-12">
                    <div class="textbox">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="電子信箱" name="email" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="textbox">
                        <i class="fas fa-key"></i>
                        <input type="text" placeholder="輸入驗證碼" name="verification_code" required>
                    </div>
                </div>
            </div>
            <div class="row g-3 align-items-center mt-4">
                <div class="col-md-9">
                    <div class="border p-2">預留的div</div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-my w-100">驗證</button>
                </div>
            </div>
            <div class="links mt-3">
                <a href="#" data-show-form="login-form">登入</a>
                <a href="#" data-show-form="registerForm">註冊</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            //  class 為 'links' 的元素下的 a 標籤，並存入 links 變數
            const links = document.querySelectorAll('.links a');
            // class 為 'outdiv' 的元素，並存入 forms 變數
            const forms = document.querySelectorAll('.outdiv');

            // 對每所有link操作
            links.forEach(link => {
                // 當 link 被點擊時，執行此函數
                link.addEventListener('click', function (event) {
                    // 阻止 link 的預設行為
                    event.preventDefault();
                    // 獲取 link 的 'data-show-form' 屬性值，並存入 formIdToShow 變數
                    const formIdToShow = this.getAttribute('data-show-form');

                    // 針對每一個 form，如果 form 的 id 等於 formIdToShow 就移除其 d-none 讓它顯示，反之
                    forms.forEach(form => {
                        if (form.id === formIdToShow) {
                            form.classList.remove('d-none');
                        } else {
                            form.classList.add('d-none');
                        }
                    });
                });
            });
        });

    </script>
</body>

</html>