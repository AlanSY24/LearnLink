<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '首頁')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://chinese-fonts-cdn.deno.dev/packages/zhbtt/dist/字魂扁桃体/result.css' />
    <link rel="stylesheet" href="{{ asset('css/homePage.css') }}">
    @yield('additional_css')
</head>
<body>
    <x-nav/>
    
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('additional_js')
</body>
</html>