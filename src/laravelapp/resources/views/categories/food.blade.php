@extends('layouts.app')

@section('title', 'Food')

@section('content')
    <div class="categories food-page">
        <h2>食べ物ページへようこそ！</h2>
        <p>ここはnakoが食べたごはんやおやつをさらけ出す場所です</p>

        <ul>
            @foreach ($posts as $post)
                @include('post.post_card', ['post' => $post])
            @endforeach
        </ul>
    </div>
@endsection
