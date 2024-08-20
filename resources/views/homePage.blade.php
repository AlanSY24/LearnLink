<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/header_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <script src="{{ asset('js/nav.js') }}"></script>
    <x-nav />
    
    <div class="container" id="identitySelection">
        <div class="form-container">
            <button class="identity-button" onclick="location.href='{{ route('teacher_list') }}'">
                <i class="fas fa-user-graduate"></i>
                <span>師資列表</span>
            </button>
            <button class="identity-button" onclick="location.href='{{ route('student_case') }}'">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>家教需求</span>
            </button>
        </div>
    </div>
    
    <x-footer_alpha />
</body>
</html>