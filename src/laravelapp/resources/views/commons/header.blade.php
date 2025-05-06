<header class="site-header">
    <div class="header-container">
        <h1 class="site-title">nakoの徒然なるままに🕊️</h1>
        <nav class="nav-bar">
            <div class="dropdown">
                <button class="dropbtn">コンテンツ</button>
                <div class="dropdown-content">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('programming.index') }}">Programming</a>
                    <a href="{{ route('music.index') }}">Music</a>
                    <a href="{{ route('food.index') }}">Food</a>
                    <a href="{{ route('diary.index') }}">Diary</a>
                </div>
            </div>

            <div class="dropdown">
                @if (Auth::check())
                    <button class="dropbtn">ユーザー：{{ Auth::user()->name }}</button>
                    <div class="dropdown-content">
                        <a href="{{ route('showMyPage') }}">マイページ</a>
                        <a href="#" id="logout-link">ログアウト</a>
                        <a href="#" id="withdrawal-link">退会</a>
                    </div>
                @else
                    <button class="dropbtn">アカウント</button>
                    <div class="dropdown-content">
                        <a href="{{ route('login') }}">ログイン</a>
                        <a href="{{ route('signup') }}">新規登録</a>
                    </div>
                @endif
            </div>
        </nav>
    </div>
</header>
