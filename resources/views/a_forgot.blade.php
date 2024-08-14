<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>發送驗證碼</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <form id="emailForm">
        @csrf
        <input type="email" id="email" required value="sean2000.cy@gmail.com">
        <button type="submit">發送</button>
    </form>
    <dialog id="verifyWindow">
        <form action="">
            @csrf
            <label for="code">請輸入驗證碼</label>
            <input type="text" id="code" required>
            <button type="submit">驗證</button>
        </form>
    </dialog>

    <script src="{{ asset('js/loadingMask.js') }}"></script>    <!-- 引入loadingMask -->
    <script>
        const emailForm = document.getElementById('emailForm');
        const verifyWindow = document.getElementById('verifyWindow');

        emailForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            showLoadingMask(); // 顯示遮罩層

            try {
                const response = await fetch('{{ route('seadEmail') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value
                    })
                });

                const data = await response.json();

                hideLoadingMask(); // 隱藏遮罩層

                if (data.success) {
                    alert(data.message);
                    verifyWindow.showModal();
                } else {
                    alert('發送失敗: ' + data.message);
                }
            } catch (error) {
                hideLoadingMask(); // 發生錯誤時也要隱藏遮罩層
                alert('發送失敗: ' + error.message);
            }
        });
    </script>
</body>

</html>