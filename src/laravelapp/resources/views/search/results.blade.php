<!-- resources/views/search/results.blade.php -->
@extends('layouts.app')

@section('title', '検索結果')

@section('content')
    <h2>「{{ $keyword }}」の検索結果</h2>

    @forelse ($posts as $post)
        @include('post.post_card', ['post' => $post])
    @empty
        <p>該当する投稿が見つかりませんでした。</p>
    @endforelse

    {{ $posts->appends(['keyword' => $keyword])->links() }}
@endsection
