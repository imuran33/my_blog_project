<!-- Quillのスタイルを読み込む -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <div class="post-detail ql-editor quill-content">
        <h2>{{ $post->title }}</h2>

        <!-- タグ表示 -->
        <div class="tags">
            <span class="tag-label">#タグ</span>
            @foreach ($post->tags as $tag)
                <a href="{{ route('tag.posts', $tag->name) }}" class="tag-badge">{{ $tag->name }}</a>
            @endforeach
        </div>

        @include('favorite.favorite_button', ['post' => $post])

        <div class="quill-detail ql-editor">
            {!! $post->content !!}
        </div>
        <a href="{{ url("/$category") }}">← 一覧に戻る</a>

        <!-- 管理者のみ表示されるリンク -->
        @if (Auth::check() && Auth::user()->is_admin)
            <a href="{{ route('edit.post', $post->id) }}">記事を編集</a>
        @endif
    </div>
@endsection