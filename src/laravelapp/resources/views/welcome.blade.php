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
        <p>ここはnakoが自由に書き連ねる場所です。</p>
        <p>好みのジャンルがあれば見ていってください。</p>

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
                <a href="{{ route('programming.index') }}" class="category-box">Programming</a>
                <a href="{{ route('music.index') }}" class="category-box">Music</a>
                <a href="{{ route('food.index') }}" class="category-box">Food</a>
                <a href="{{ route('diary.index') }}" class="category-box">Diary</a>
            </div>
        </div>
    </div>
@endsection
