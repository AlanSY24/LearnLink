<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- 引入 FontAwesome CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


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

        .btn {
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

        .btn:hover {
            background: linear-gradient(135deg, #feb47b, #ff7e5f);
        }

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
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-transparent" id="login-form">
        <form action="/login" method="POST" class="form-container rounded-3 shadow p-4 position-relative">
            <a href="{{ url('/homePage') }}" class="position-absolute top-0 start-0 m-2 back-icon">
                <i class="fas fa-caret-left"> back</i>
            </a>
            <h1 class="mb-4">登入</h1>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="用戶名" name="username" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="密碼" name="password" required>
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
    </div>


    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 d-none" id="register-form">
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


    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 d-none" id="forgot-form">
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
            const forms = document.querySelectorAll('.container-fluid, .d-flex');

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