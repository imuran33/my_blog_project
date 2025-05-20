@extends('layouts.app')

@section('title', 'Programming')

@section('content')
    <div class="categories programming-page">
        <h2>プログラミングページへようこそ！</h2>
        <p>ここはnakoが書いたプログラミングやコードをさらけ出す場所です</p>

        <ul>
            @foreach ($posts as $post)
                @include('post.post_card', ['post' => $post])
            @endforeach
        </ul>
    </div>
@endsection
