@extends('layouts.app')

@section('title', 'Diary')

@section('content')
    <div class="categories diary-page">
        <h2>日記ページへようこそ！</h2>
        <p>ここはnakoがそのほか思ったことや感じたこと、体験をさらけ出す場所です。</p>

        <ul>
            @foreach ($posts as $post)
                @include('post.post_card', ['post' => $post])
            @endforeach
        </ul>
    </div>
@endsection
