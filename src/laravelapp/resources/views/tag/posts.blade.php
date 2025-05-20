<!-- resources/views/tag/posts.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>#{{ $tag->name }} の投稿</h2>

    @foreach ($posts as $post)
        <div class="post-summary">
            <h3><a href="{{ url("/{$post->category}/{$post->id}") }}">{{ $post->title }}</a></h3>
            <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>
        </div>
    @endforeach

    {{ $posts->links() }} <!-- ページネーション -->
@endsection