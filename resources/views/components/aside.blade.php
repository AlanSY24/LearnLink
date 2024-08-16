        
        <!-- <aside class="sidebar">
            <h2>會員中心-學生</h2>
            <x-aside />
        </aside> -->


<ul>
    <li><a href="{{ route('basic.page') }}">基本資料</a></li>
    <li>
        <a href="{{ route('teacherprofile.index') }}">老師</a>
        <a href="#" style="font-size: x-small;">評分</a> 
    </li>
    <li>
        <a href="{{ route('studentprofile') }}">學生</a>
        <a href="#" style="font-size: x-small;">家長</a>
    </li>
</ul>