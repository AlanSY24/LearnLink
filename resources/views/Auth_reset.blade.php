<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>重設密碼</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/header_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/basicinfo.css') }}">

    <style>
        main {
            flex-grow: 1;
            padding: 1em;
            margin: auto;
        }

        #mainDiv {
            min-height: 50vh;
            width: 550px;
            margin: auto;
        }

        .container-form {
            background-color: var(--accent-color);
            padding: 20px;
            border-radius: 5px;
            position: relative;
        }

        .container-form h3 {
            color: var(--main-color);
            text-align: center;
        }

        .container-form label {
            display: inline-block;
            font-weight: bold;
            margin: 1em 0 0.5em;
            color: var(--main-color);
            width: 150px;
        }

        .container-form input[type="email"],
        .container-form input[type="text"],
        .container-form input[type="password"] {
            width: 250px;
            padding: 0.5em;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: inline-block;
            margin-left: 10px;
        }

        .container-form input:last-of-type {
            margin-bottom: 41px;
        }

        .container-form button {
            background-color: var(--main-color);
            color: var(--text-color);
            border: none;
            padding: 0.5em 1em;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        .container-form button:hover {
            background-color: #003060;
        }

        #verifyWindow {
            width: 100%;
            max-width: 500px;
            border: none;
            padding: 0;
            border-radius: 5px;
            background-color: var(--bg-color);
        }

        /* 叉叉按鈕的特定樣式 */
        #closeDialog {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: var(--main-color);
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        #closeDialog:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        /* 覆蓋 .container-form button 的樣式 for 叉叉按鈕 */
        .container-form #closeDialog {
            background-color: transparent;
            color: var(--main-color);
            margin-top: 0;
            padding: 0;
        }

        .container-form #closeDialog:hover {
            background-color: transparent;
            color: #003060;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }

            .container-form input[type="email"],
            .container-form input[type="text"] {
                width: 50%;
            }
        }
    </style>

</head>

<body>
    <script src="{{ asset('js/nav.js') }}"></script>
    <x-nav />
    <div class="container" id="mainDiv">
        <main>
            <div class="container-form">
                <h3>重設密碼</h3>
                <form id="emailForm">
                    @csrf
                    <label for="email">電子郵件：</label>
                    <input type="email" id="email" required>
                    <button type="submit">發送</button>
                </form>
            </div>
        </main>
    </div>

    <dialog id="verifyWindow">
        <div class="container-form">
            <div id="closeDialog">&times;</div>
            <h3>驗證及重設密碼</h3>
            <form id="verifyForm">
                @csrf
                <input type="hidden" id="verifyEmail" name="email">
                <label for="code">請輸入驗證碼：</label>
                <input type="text" id="code" name="code" required style="width: 40% !important;"><br>
                <label for="newPassword">輸入新密碼：</label>
                <input type="password" id="newPassword" name="newPassword" required
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="密碼必須包含至少一個數字、一個小寫字母、一個大寫字母，且長度至少為8個字符"
                    style="width: 40% !important;"><br>
                <label for="confirmPassword">再次輸入新密碼：</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" style="width: 40% !important;">
                <button type="submit">重設密碼</button>
            </form>
        </div>
    </dialog>

    <x-footer_alpha />

    <script src="{{ asset('js/loadingMask.js') }}"></script>
    <script>
        const emailForm = document.getElementById('emailForm');
        const verifyWindow = document.getElementById('verifyWindow');
        const verifyForm = document.getElementById('verifyForm');
        let userEmail = '';

        // 寄送email並顯示驗證碼視窗
        emailForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            showLoadingMask();
            userEmail = document.getElementById('email').value;

            try {
                const response = await fetch("{{ route('seadEmail') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: userEmail
                    })
                });

                const data = await response.json();
                hideLoadingMask();

                if (data.success) {
                    alert(data.message);
                    document.getElementById('verifyEmail').value = userEmail;
                    verifyWindow.showModal();
                } else {
                    alert('發送失敗: ' + data.message);
                }
            } catch (error) {
                hideLoadingMask();
                alert('發送失敗: ' + error.message);
            }
        });

        // 收到驗證碼後輸入驗證碼及新密碼
        verifyForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            showLoadingMask();

            const formData = new FormData(verifyForm);
            const email = formData.get('email');
            const code = formData.get('code');
            const newPassword = formData.get('newPassword');
            const confirmPassword = formData.get('confirmPassword');

            if (newPassword !== confirmPassword) {
                hideLoadingMask();
                alert('兩次輸入的密碼不一致，請重新輸入。');
                return;
            }

            try {
                const response = await fetch("{{ route('verifyCode') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: email,
                        code: code,
                        newPassword: newPassword
                    })
                });

                const data = await response.json();
                hideLoadingMask();

                if (data.success) {
                    alert(data.message);
                    verifyWindow.close();
                    window.location.href = "{{ route('login') }}";
                } else {
                    alert('驗證失敗或密碼重設失敗: ' + data.message);
                }
            } catch (error) {
                hideLoadingMask();
                alert('驗證失敗或密碼重設失敗: ' + error.message);
            }
        });

        document.getElementById('closeDialog').addEventListener('click', function() {
            verifyWindow.close();
        });
    </script>
</body>

</html>