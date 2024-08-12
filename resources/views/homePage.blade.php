<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link rel='stylesheet' href='https://chinese-fonts-cdn.deno.dev/packages/zhbtt/dist/字魂扁桃体/result.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/會員中心.css') }}">
    <style>
        .identity-selection {
            background-color: #f4f4f4;
            padding: 2em;
            margin: 2em auto;
            max-width: 800px;
            border-radius: 5px;
        }

        .identity-selection h2 {
            color: #004080;
            text-align: center;
            margin-bottom: 1em;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .identity-button {
            background-color: #004080;
            color: #fff;
            border: none;
            padding: 1em 2em;
            margin: 1em;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        .identity-button:hover {
            background-color: #003060;
        }

        @media (max-width: 600px) {
            .button-container {
                flex-direction: column;
            }
            
            .identity-button {
                width: 80%;
                margin: 1em auto;
            }
        }
    </style>
</head>

<body>
    <x-nav />

    <main>
        <div class="identity-selection">
            <h2>選擇您的身份</h2>
            <div class="button-container">
                <button class="identity-button" onclick="location.href=''">我是學生</button>
                <button class="identity-button" onclick="location.href=''">我是老師</button>
            </div>
        </div>
    </main>

    <x-footer_alpha />

    <script src="{{ asset('js/nav.js') }}"></script>
</body>

</html>