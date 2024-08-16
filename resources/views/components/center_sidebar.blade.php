<aside class="sidebar">
    <h2 id="basicinfoHeader">會員中心 - XX</h2>
    <ul>
        <li><a href="{{ route('basic.page') }}">基本資料</a></li>
        <li><a href="{{ route('teacherprofile.index') }}">老師</a></li>
        <li><a href="{{ route('studentprofile') }}">學生</a></li>
    </ul>
</aside>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let sidebarhaha;
        @if(Route::currentRouteName() == 'basic.page')
            sidebarhaha = '基本資料';
        @elseif(Route::currentRouteName() == 'teacherprofile.index')
            sidebarhaha = '老師';
        @elseif(Route::currentRouteName() == 'studentprofile')
            sidebarhaha = '學生';
        @else
            sidebarhaha = '??';
        @endif
        document.getElementById('basicinfoHeader').textContent = "會員中心 - " + sidebarhaha;
    });
</script>