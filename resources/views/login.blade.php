<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- 引入 FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- 引入自訂的 CSS 檔案 -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 outdiv" id="login-form">
        <form action="{{ route('check.user') }}" method="POST"
            class="form-container rounded-3 shadow p-4 position-relative">
            @csrf
            <a href="{{ url('/homePage') }}" class="position-absolute top-0 start-0 m-2 back-icon">
                <i class="fas fa-caret-left">back</i>
            </a>
            <h1 class="mb-4">登入</h1>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="用戶名" name="loginUsername" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="密碼" name="loginPassword" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="border p-2">預留的div</div>
            </div>
            <div class="links mt-3">
                <button type="submit" class="btn w-100">登入</button>
            </div>
            <div class="links">
                <a href="#" data-show-form="register-form">註冊</a>
                <a href="#" data-show-form="forgot-form">忘記密碼？</a>
            </div>
        </form>

        @if(session('message'))
            <script>
                alert("{{ session('message') }}");
            </script>
        @endif
    </div>

    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 d-none outdiv"
        id="register-form">
        <form action="/register" method="POST"
            class="form-container register-and-forgot-container rounded-3 shadow p-4 p-md-5 position-relative">
            <a href="{{ url('/homePage') }}" class="position-absolute top-0 start-0 m-2 back-icon">
                <i class="fas fa-caret-left"> back</i>
            </a>
            <h1 class="mb-4 text-center">註冊</h1>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="用戶名" name="username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="電子信箱" name="email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="密碼" name="password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="確認密碼" name="confirm_password" required>
                    </div>
                </div>
            </div>
            <div class="row g-3 align-items-center mt-4">
                <div class="col-md-9">
                    <div class="border p-2">預留的div</div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn w-100">註冊</button>
                </div>
            </div>
            <div class="links mt-3">
                <a href="#" data-show-form="login-form">登入</a>
                <a href="#" data-show-form="forgot-form">忘記密碼？</a>
            </div>
        </form>
    </div>

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
                    <button type="submit" class="btn w-100">驗證</button>
                </div>
            </div>
            <div class="links mt-3">
                <a href="#" data-show-form="login-form">登入</a>
                <a href="#" data-show-form="register-form">註冊</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.links a');
            const forms = document.querySelectorAll('.outdiv');

            links.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const formIdToShow = this.getAttribute('data-show-form');

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