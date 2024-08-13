<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心-基本資料</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/zh.js"></script>

    <!-- 導入CSS -->
    <link rel="stylesheet" href="{{ asset('css/header_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/basicinfo.css') }}">
</head>

<body>
    <script src="{{ asset('js/nav.js') }}"></script>
    <x-nav />

    <div class="container">
        <aside class="sidebar">
            <h2>會員中心</h2>
            <ul>
                <li><a href="#" class="active">基本資料</a></li>
                <li><a href="#">老師</a></li>
                <li><a href="#">學生</a></li>
                <li><a href="#">家長</a></li>
            </ul>
        </aside>
        <main>
            <section class="profile-section">
                <form id="basicinfoForm" class="container-form" action="{{ route('basicinfoForm') }}" method="POST">
                    @csrf
                    <h3>基本資料</h3>

                    <div class="form-group">
                        <label for="account">帳號：</label>
                        <span>{{ Auth::user()->account ?? 'null' }}</span>
                        <input type="hidden" name="account" value="{{ Auth::user()->account ?? 'null' }}">
                    </div>

                    <div class="form-group">
                        <label for="name">名稱：</label>
                        <span>{{ Auth::user()->name ?? 'null' }}</span>
                        <i class="fa-solid fa-pen icon-edit" data-target="name"></i>
                        <input type="text" id="name" name="name" style="display: none;"
                            value="{{ Auth::user()->name ?? '' }}" maxlength="30" required title="姓名不能超過30個字符">
                    </div>

                    <div class="form-group">
                        <label for="gender">性別：</label>
                        <span>
                            @if (Auth::user()->gender == 1)
                                男性
                            @elseif (Auth::user()->gender == 2)
                                女性
                            @else
                                不明
                            @endif
                        </span>
                        <i class="fa-solid fa-pen icon-edit" data-target="gender"></i>
                        <select id="gender" name="gender" style="display: none;" required>
                            <option value="">請選擇您的性別</option>
                            <option value="1" {{ Auth::user()->gender == 1 ? 'selected' : '' }}>男性</option>
                            <option value="2" {{ Auth::user()->gender == 2 ? 'selected' : '' }}>女性</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone">手機：</label>
                        <span>
                            @if (Auth::user()->phone)
                                {{ Auth::user()->phone }}
                            @else
                                尚未輸入手機
                            @endif
                        </span>
                        <i class="fa-solid fa-pen icon-edit" data-target="phone"></i>
                        <input type="tel" id="phone" name="phone" style="display: none;"
                            value="{{ Auth::user()->phone ?? '' }}" pattern="\d*" inputmode="numeric" maxlength="10"
                            title="請輸入10位數字的手機號碼">
                    </div>

                    <div class="form-group">
                        <label for="birthday">生日：</label>
                        <span>
                            @if (Auth::user()->birthday)
                                {{ Auth::user()->birthday }}
                            @else
                                尚未輸入生日
                            @endif
                        </span>
                        <i class="fa-solid fa-pen icon-edit" data-target="birthday"></i>
                        <input type="text" id="birthday" name="birthday" style="display: none;"
                            value="{{ Auth::user()->birthday ?? '' }}" required>
                    </div>

                    <button id="save" type="submit" style="display: none;">保存修改</button>
                </form>
            </section>
        </main>
    </div>


    <x-footer_alpha />
    <script>
        // 顯示對應的輸入框並顯示按鈕
        document.querySelectorAll('.icon-edit').forEach(icon => {
            icon.addEventListener('click', function () {
                const target = this.getAttribute('data-target');
                document.querySelector(`#${target}`).style.display = 'block';
                document.getElementById('save').style.display = 'block';
                this.style.display = 'none';
            });
        });
    </script>

    <!-- ↓↓↓↓↓↓↓ 選取時間的東西，別人做的，別動 -->
    <script>
        // 初始化日期選擇器並設置語言為中文
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#birthday", {
                locale: "zh",
                dateFormat: "Y-m-d"
            });
        });
    </script>
</body>

</html>