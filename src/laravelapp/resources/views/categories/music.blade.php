@extends('layouts.app')

@section('title', 'Music')

@section('content')
    <div class="categories music-page">
        <h2>ミュージックページへようこそ！</h2>
        <p>ここはnakoがつくった曲や弾いてみた動画をさらけ出す場所です</p>

        <ul>
            @foreach ($posts as $post)
                @include('post.post_card', ['post' => $post])
            @endforeach
        </ul>
    </div>
@endsection
