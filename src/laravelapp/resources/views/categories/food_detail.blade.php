<!-- Quillのスタイルを読み込む -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <div class="post-detail ql-editor quill-content">
        <h2>{{ $post->title }}</h2>
        {!! $post->content !!}
        <a href="{{ url('/food') }}">← 一覧に戻る</a>
    </div>
@endsection