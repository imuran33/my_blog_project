{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="carousel">
        <div class="slides">
            <div class="slide slide1">
                <img src="{{ asset('images/autumn_kodaiji.jpg') }}" alt="Photo 1">
            </div>
            <div class="slide slide2">
                <img src="{{ asset('images/kingyo_aquarium.jpg') }}" alt="Photo 2">
            </div>
        </div>
    </div>

    <div class="welcome-page">
        <h2>ようこそ！</h2>
        <p>ここは〇〇が自由に書き連ねる場所です。</p>
        <p>好みのジャンルがあれば見ていってください。</p>

        <div class="search-box">
            <h3>🔍 記事検索</h3>
            <form action="{{ route('post.search') }}" method="GET" class="search-form">
                <input type="text" name="keyword" placeholder="キーワードで検索" value="{{ request('keyword') }}">
                <button type="submit">検索</button>
            </form>
            @if (session('error'))
                <div class="form-error">{{ session('error') }}</div>
            @endif
        </div>

        <div class="announcement">
            <h3>📰 お知らせ</h3>
            <ul>
                @foreach ($latestPosts as $post)
                    <li>
                        {{ $post->created_at->format('Y年m月d日') }} ：
                        <a href="{{ url('/' . $post->category . '/' . $post->id) }}">
                            {{ $post->category }}カテゴリのブログが追加されました。
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="category">
            <h3>📝 ブログカテゴリ</h3>
            <div class="category-grid">
                <a href="{{ route('category.index', ['category' => 'programming']) }}" class="category-box">
                    <img src="{{ asset('images/defaults/programming.jpg') }}" alt="Programming">
                    <span>Programming</span>
                </a>
                <a href="{{ route('category.index', ['category' => 'music']) }}" class="category-box">
                    <img src="{{ asset('images/defaults/music.jpg') }}" alt="Music">
                    <span>Music</span>
                </a>
                <a href="{{ route('category.index', ['category' => 'food']) }}" class="category-box">
                    <img src="{{ asset('images/defaults/food.jpg') }}" alt="Food">
                    <span>Food</span>
                </a>
                <a href="{{ route('category.index', ['category' => 'diary']) }}" class="category-box">
                    <img src="{{ asset('images/defaults/diary.jpg') }}" alt="Diary">
                    <span>Diary</span>
                </a>
                <a href="{{ route('category.index', ['category' => 'memoir']) }}" class="category-box">
                    <img src="{{ asset('images/defaults/memoir.jpg') }}" alt="Memoir">
                    <span>Memoir</span>
                </a>
            </div>
        </div>
    </div>
@endsection
