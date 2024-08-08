<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心-基本資料</title>

    <!-- ↓↓↓↓↓ 其它人加的 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/zh.js"></script>

    <!-- 導入CSS(會員中心老師.css) -->
    <link rel="stylesheet" href="{{ asset('css/會員中心.css') }}">
</head>

<body>

    <script src="{{ asset('js/nav.js') }}"></script>
    <x-nav />

    <div class="container clearfix">
        <aside class="sidebar">
            <h2>會員中心</h2>
            <ul>
                <li><a href="#" class="active">基本資料</a></li>
                <!-- 其他選項... -->
            </ul>
        </aside>
        <main>
            <section class="profile-section">
                <h2>基本資料</h2>
                <form id="profileForm">
                    <div class="form-group">
                        <label for="account">帳號： </label>
                        <label for="">{{ Auth::user()->account ?? 'null' }}</label>
                    </div>
                    <div class="form-group">
                        <label for="name">名稱： </label>
                        <label for="">{{ Auth::user()->name ?? 'null' }}</label>
                    </div>
                    <div class="form-group">
                        <label for="email">信箱： </label>
                        <label for="">{{ Auth::user()->email ?? 'null' }}</label>
                    </div>
                    <div class="form-group">
                        <label for="password">密碼： </label>
                        <button>變更密碼</button>
                    </div>
                    <div class="form-group">
                        <label for="gender">性別： </label>
                        <label for="">
                            @if (Auth::user()->gender == 1)
                                男性
                            @elseif (Auth::user()->gender == 2)
                                女性
                            @else
                                不明
                            @endif
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="phone">手機： </label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="birthday">生日： </label>
                        <input type="text" id="birthday" name="birthday">
                    </div>
                    <button type="submit">保存修改</button>
                </form>
            </section>
        </main>
    </div>

    <x-footer_alpha />


    <!-- ↓↓↓↓↓↓↓ 選取時間的東西，別人做的 -->
    <script>
        // 初始化日期選擇器並設置語言為中文
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#birthday", {
                locale: "zh",
                dateFormat: "Y-m-d"
            });
        });
        // 表單提交處理
        document.getElementById('profileForm').addEventListener('submit', function (event) {
            event.preventDefault();
            // 這裡添加表單提交的邏輯，例如發送AJAX請求到後端
            alert('資料已更新');
        });
    </script>
</body>

</html>