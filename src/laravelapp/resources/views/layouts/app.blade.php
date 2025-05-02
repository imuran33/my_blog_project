<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Portfolio Site')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>🕊️nakoの徒然なるままに🕊️</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>© {{ date('Y') }} My Site</p>
    </footer>
</body>
</html>