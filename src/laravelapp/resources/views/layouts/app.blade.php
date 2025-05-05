<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'nakoの徒然なるままに')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&family=Noto+Sans+JP&family=Tagesschrift&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('commons.header')

    @if (session('status'))
        <!-- モーダル -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <p>{{ session('status') }}</p>
                <button id="closeModal">閉じる</button>
            </div>
        </div>

        <script>
            // ページ読み込み時にモーダルを表示
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('modal').style.display = 'block';
            });

            // モーダルを閉じる処理
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('modal').style.display = 'none';
            });
        </script>
    @endif

    <main class="{{ Request::is('/') ? 'welcome-main' : '' }}">
        @yield('content')
    </main>

    @include('commons.footer')
</body>

</html>
