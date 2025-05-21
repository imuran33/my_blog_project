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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('commons.header')

    @if (!empty($status))
        <!-- 新規完了登録などの通知モーダル -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <p>{{ session('status') }}</p>
                <button id="closeModal">閉じる</button>
            </div>
        </div>
    @endif

    <!-- ログアウト確認モーダル -->
    <div id="logout-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <p>ログアウトしますか？</p>
            <button id="confirm-logout">はい</button>
            <button id="cancel-logout">いいえ</button>
        </div>
    </div>

    <!-- ログアウト用フォーム（非表示）-->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- 退会確認モーダル -->
    <div id="withdrawal-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <p>本当に退会しますか？</p>
            <button id="confirm-withdrawal">はい</button>
            <button id="cancel-withdrawal">いいえ</button>
        </div>
    </div>

    <!-- 退会処理フォーム（非表示） -->
    <form id="withdrawal-form" action="{{ route('withdrawal') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>


    <script>
        // ✅ モーダル用スクリプト
        document.addEventListener('DOMContentLoaded', function() {
            // 登録完了モーダルがあれば表示
            const modal = document.getElementById('modal');
            if (modal) {
                modal.style.display = 'block';
                document.getElementById('closeModal').addEventListener('click', function() {
                    modal.style.display = 'none';
                });
            }

            // ログアウト確認モーダルのイベント登録
            const logoutLink = document.getElementById('logout-link');
            if (logoutLink) {
                logoutLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('logout-modal').style.display = 'block';
                });

                document.getElementById('cancel-logout').addEventListener('click', function() {
                    document.getElementById('logout-modal').style.display = 'none';
                });

                document.getElementById('confirm-logout').addEventListener('click', function() {
                    document.getElementById('logout-form').submit();
                });
            }

            // 退会確認モーダルのイベント登録
            const withdrawalLink = document.getElementById('withdrawal-link');
            if (withdrawalLink) {
                withdrawalLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('withdrawal-modal').style.display = 'block';
                });

                document.getElementById('cancel-withdrawal').addEventListener('click', function() {
                    document.getElementById('withdrawal-modal').style.display = 'none';
                });

                document.getElementById('confirm-withdrawal').addEventListener('click', function() {
                    document.getElementById('withdrawal-form').submit();
                });
            }
        });
    </script>

    <main class="{{ Request::is('/') ? 'welcome-main' : '' }}">
        @yield('content')
    </main>

    @include('commons.footer')
</body>

</html>
