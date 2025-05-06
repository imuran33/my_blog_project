@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <div class="post-detail">
        <h2>{{ $post->title }}</h2>
        {!! $post->content !!}
        <a href="{{ url('/diary') }}">← 一覧に戻る</a>
    </div>
@endsection
