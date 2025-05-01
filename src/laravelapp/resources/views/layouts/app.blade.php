<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Portfolio Site')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&family=Noto+Sans+JP&family=Tagesschrift&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <h1>🕊️nakoの徒然なるままに🕊️</h1>
    </header>

    <main class="{{ Request::is('/') ? 'welcome-main' : '' }}">
        @yield('content')
    </main>

    <footer>
        <p>© {{ date('Y') }} My Site</p>
    </footer>
</body>

</html>
