@extends('layouts.app')

@section('title')
    {{ Auth::user()->name }}のマイページ
@endsection

@section('content')
    <div class="mypage-container">
        <div class="sidebar">
            <div class="user-info">
                <h2 class="section-title">プロフィール</h2>
                <hr class="section-divider">
                <h2>{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->email }}</p>
                <a href="{{ route('profile.edit') }}" class="edit-profile-button">プロフィールを編集</a>
                @if ($canPost)
                    <a href="{{ route('create.post') }}" class="post-button">投稿作成</a>
                @endif
            </div>
        </div>
        <div class="main-content">
            <h3>いいねした記事</h3>
            <hr class="section-divider">
            @foreach ($favorites as $post)
                @include('post.post_card', ['post' => $post])
            @endforeach

            {{ $favorites->links() }}
        </div>
    </div>
@endsection
