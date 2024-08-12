<section class="student_container">
    <div class="student_header">
        <h1>{{ $teacher->title }}</h1>
        <i id="heart-{{ $teacher->id }}" class="{{ $isFavorite ? 'fas' : 'far' }} fa-heart" style="color: red;"></i>
    </div>
    <div class="student_info-bar">
        <div>{{ $teacher->subject->name ?? 'N/A' }}</div>
        <div>{{ $teacher->city->name ?? 'N/A' }}</div> <!-- 假設 city 為上課地點，根據實際需要修改 -->
        <div>{{ $availableTime }}</div>
        <div>{{ $teacher->hourly_rate }}</div>
    </div>
    <div class="student_profile">
        <div class="avatar">大頭貼</div>
        <div class="description">
            <p>{{ $teacher->details }}</p>
        </div>
    </div>
    <div class="student_buttons">
        <div class="rating">
            <span>★</span>
            <span>★</span>
            <span>★</span>
            <span>★</span>
            <span>★</span>
        </div>
        <div class="student_btn">
            <button class="btnDetailsResume" data-id="{{ $teacher->id }}">詳細履歷</button>
            <button class="btnContactTeacher" data-id="{{ $teacher->id }}">聯絡老師</button>
        </div>
    </div>
</section>
