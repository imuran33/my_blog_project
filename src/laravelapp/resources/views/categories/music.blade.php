@extends('layouts.app')

@section('title', 'Music')

@section('content')
    <div class="music-page">
        <h2>ミュージックページへようこそ！</h2>
        <p>ここはnakoがつくった曲や弾いてみた動画をさらけ出す場所です</p>

        <ul>
            @foreach ($posts as $post)
                <li>
                    <a href="{{ url('/music/' . $post['id']) }}">{{ $post['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection