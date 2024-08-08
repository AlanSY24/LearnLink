<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入狀態</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .user-info {
            white-space: pre-wrap;
            word-break: break-all;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/會員中心.css') }}">
</head>

<body>
    <script src="{{ asset('js/nav.js') }}"></script>
    <x-nav />
    <div class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>方法</th>
                    <th>值</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Auth::check()</td>
                    <td>{{ Auth::check() ? 'true' : 'false' }}，登入狀態返回值為 true</td>
                </tr>
                <tr>
                    <td>Auth::guest()</td>
                    <td>{{ Auth::guest() ? 'true' : 'false' }}，登出狀態返回值為 false</td>
                </tr>
                <tr>
                    <td>Auth::id()</td>
                    <td>{{ Auth::id() ?? 'null' }}</td>
                </tr>
                <tr>
                    <td>Auth::user()</td>
                    <td>
                        @if(Auth::user())
                            <div class="user-info">
                                {{ json_encode(Auth::user(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                            </div>
                        @else
                            null
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Auth::user()->name</td>
                    <td>{{ Auth::user()->name ?? 'null' }}</td>
                </tr>
                <tr>
                    <td>Auth::user()->email</td>
                    <td>{{ Auth::user()->email ?? 'null' }}</td>
                </tr>
                <tr>
                    <td>Auth::user()->account</td>
                    <td>{{ Auth::user()->account ?? 'null' }}</td>
                </tr>
                <tr>
                    <td>Auth::user()->gender</td>
                    <td>{{ Auth::user()->gender ?? 'null' }}</td>
                </tr>
                <tr>
                    <td>Auth::user()->phone</td>
                    <td>{{ Auth::user()->phone ?? 'null' }}</td>
                </tr>
                <tr>
                    <td>Auth::user()->birthday</td>
                    <td>{{ Auth::user()->birthday ?? 'null' }}</td>
                </tr>
                <tr>
                    <td>Auth::user()->created_at</td>
                    <td>{{ Auth::user()->created_at ?? 'null' }}</td>
                </tr>
                <tr>
                    <td>Auth::user()->updated_at</td>
                    <td>{{ Auth::user()->updated_at ?? 'null' }}</td>
                </tr>
            </tbody>
        </table>

        @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">登出</button>
            </form>
        @endif
    </div>
</body>

</html>