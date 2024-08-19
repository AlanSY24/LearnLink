<nav class="nav-ll-navbar">
    <a class="nav-ll-navbar-brand" href="{{ asset('homePage') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h1>LearnLink</h1>
    </a>
    <button class="nav-ll-navbar-toggle" id="navLLToggle">☰</button>
    <ul class="nav-ll-navbar-menu" id="navLLMenu">
        <li><a href="{{ route('teacher_list') }}">我是學生</a></li>
        <li><a href="{{ route('student_case') }}">我是老師</a></li>
        <li><a href="{{ route('findteacherPage') }}">發案</a></li>
        <li><a href="{{ route('beteacher.create') }}">接案</a></li>
        @auth
            <li>
                <form action="{{ route('logout') }}" method="POST" class="nav-ll-logout-form">
                    @csrf
                    <button type="submit" class="nav-ll-logout-button">登出</button>
                </form>
            </li>
            <li><a href="{{ route('basic.page') }}">會員中心</a></li>
        @else
            <li><a href="{{ route('login') }}">登入/註冊</a></li>
        @endauth
    </ul>
</nav>
<div class="nav-ll-overlay" id="navLLOverlay"></div>