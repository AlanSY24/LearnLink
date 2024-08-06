<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .favorite-button {
            background: none;
            border: none;
            cursor: pointer;
            color: #f00;
        }

        .favorite-button i {
            font-size: 24px;
        }
    </style>
</head>
<body>
@foreach ($teacherRequests as $teacherRequest)
    <div class="teacher-request">
        <h3>{{ $teacherRequest->title }}</h3>
        <p>{{ $teacherRequest->subject->name ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $teacherRequest->city->city ?? 'N/A' }}</p>
        <p><strong>Available Time:</strong> {{ $teacherRequest->available_time }}</p>
        <p><strong>Expected Date:</strong> {{ $teacherRequest->expected_date }}</p>
        <p><strong>Hourly Rate (Min):</strong> {{ $teacherRequest->hourly_rate_min }}</p>
        <p><strong>Hourly Rate (Max):</strong> {{ $teacherRequest->hourly_rate_max }}</p>
        <p><strong>Details:</strong> {{ $teacherRequest->details }}</p>

        <!-- 收藏/取消收藏按鈕 -->
        @auth
            <form action="{{ route('favorites.store', $teacherRequest->id) }}" method="POST" class="favorite-form">
                @csrf
                @method('POST')
                <button type="submit" class="favorite-button">
                    <i class="fa{{ auth()->user()->favoriteTeacherRequests->contains($teacherRequest->id) ? 's' : 'r' }} fa-heart"></i>
                </button>
            </form>
        @else
            <!-- 如果用戶未登入，顯示登入提示 -->
            <a href="{{ route('login') }}" class="favorite-button">
                <i class="far fa-heart"></i>
            </a>
        @endauth
    </div>
@endforeach

<script>
$(document).ready(function() {
    $('.favorite-button').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var form = button.closest('form');
        var icon = button.find('i');
        var url = form.attr('action');
        var method = form.attr('method');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                if (response.favorited) {
                    icon.removeClass('fa-regular').addClass('fa-solid');
                } else {
                    icon.removeClass('fa-solid').addClass('fa-regular');
                }
            },
            error: function(xhr) {
                console.error('An error occurred:', xhr);
                alert('An error occurred.');
            }
        });
    });
});
</script>
</body>
</html>
