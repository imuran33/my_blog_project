<header class="site-header">
    <div class="header-container">
        <h1 class="site-title">nakoの徒然なるままに🕊️</h1>
        <nav class="nav-bar">
            <div class="dropdown">
                <button class="dropbtn">コンテンツ</button>
                <div class="dropdown-content">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('category.index', ['category' => 'programming']) }}"class="category-box">Programming</a>
                    <a href="{{ route('category.index', ['category' => 'music']) }}" class="category-box">Music</a>
                    <a href="{{ route('category.index', ['category' => 'food']) }}" class="category-box">Food</a>
                    <a href="{{ route('category.index', ['category' => 'diary']) }}" class="category-box">Diary</a>
                    <a href="{{ route('category.index', ['category' => 'memoir']) }}" class="category-box">Memoir</a>
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
