@extends('layouts.app')

@section('title', 'Diary')

@section('content')
    <div class="diary-page">
        <h2>日記ページへようこそ！</h2>
        <p>ここはnakoがそのほか思ったことや感じたこと、体験をさらけ出す場所です。</p>

        <ul>
            @foreach ($posts as $post)
                <li>
                    <a href="{{ url('/diary/' . $post['id']) }}">{{ $post['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection