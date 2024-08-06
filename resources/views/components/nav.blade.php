<nav class="navbar navbar-expand-sm p-0 sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand m-0 p-0" href="">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 50px; padding:5px 0;">
            <h1>LearnLink</h1>
        </a>
        <!-- 
navbar:定義一個導航欄容器。
navbar-expand-sm:控制導航欄在什麼斷點展開。在小於 sm 斷點（576px）時，導航項會折疊；在 sm 及以上斷點，導航項會水平展開。
sticky-top:使導航欄在滾動時黏在頂部。
container-fluid:創建一個寬度 100% 的容器，在所有視窗大小下都是全寬的。
navbar-brand:為品牌、標誌等設置樣式。        
-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- 
navbar-toggler:定義切換按鈕（通常是漢堡按鈕），用於在小屏幕上展開/折疊導航項。
navbar-toggler-icon:為切換按鈕提供默認的漢堡圖標。        
-->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto flex-column-reverse flex-sm-row">
                <li class="nav-item">
                    <a class="nav-link active" href="">發案</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="">接案</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('login') }}">登入/註冊</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- 
collapse navbar-collapse:collapse 類使元素可折疊。navbar-collapse 為導航欄的可折疊部分設置樣式。
navbar-nav:為導航項列表設置樣式。
flex-column-reverse:將 flex 容器設置為反向垂直排列。
flex-sm-row:在 sm 斷點及以上，將 flex 容器設置為水平排列。
nav-item:為導航項設置樣式。
nav-link:為導航項中的連結設置樣式。
active:標記當前活動的導航項。 
-->