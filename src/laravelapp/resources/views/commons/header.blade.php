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
                <button class="dropbtn">アカウント</button>
                <div class="dropdown-content">
                    <a href="{{ route('signup') }}">新規登録</a>
                    <a href="{{ "" }}">ログイン</a>
                    <a href="{{ "" }}">ログアウト</a>
                    <a href="{{ "" }}">マイページ</a>
                    <a href="{{ "" }}">退会</a>
                </div>
            </div>
        </nav>
    </div>
</header>