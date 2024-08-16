<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link rel='stylesheet' href='https://chinese-fonts-cdn.deno.dev/packages/zhbtt/dist/字魂扁桃体/result.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/header_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <x-nav />
    <div class="container" id="identitySelection">
        <div class="form-container">
            <button class="identity-button" onclick="location.href='{{ route('teacher_list') }}'">
                <i class="fas fa-user-graduate"></i>
                <span>我是<br>學生</span>
            </button>
            <button class="identity-button" onclick="location.href='{{ route('student_case') }}'">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>我是<br>老師</span>
            </button>
        </div>
    </main>

    <x-footer_alpha />

    <script src="{{ asset('js/nav.js') }}"></script>
</body>

</html>