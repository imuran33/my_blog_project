@extends('layouts.app')

@section('title', 'Programming')

@section('content')
    <div class="programming-page">
        <h2>プログラミングページへようこそ！</h2>
        <p>ここはnakoが書いたプログラミングやコードをさらけ出す場所です</p>

        <ul>
            @foreach ($posts as $post)
                <li>
                    <a href="{{ url('/programming/' . $post['id']) }}">{{ $post['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
