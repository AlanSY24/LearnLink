<nav class="nav-ll-navbar">
    <a class="nav-ll-navbar-brand" href="{{ asset('homePage') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h1>LearnLink</h1>
    </a>
    <button class="nav-ll-navbar-toggle" id="navLLToggle">☰</button>
    <ul class="nav-ll-navbar-menu" id="navLLMenu">
        <li><a href="">發案</a></li>
        <li><a href="">接案</a></li>
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