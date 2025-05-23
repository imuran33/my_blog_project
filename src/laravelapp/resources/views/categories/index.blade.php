@extends('layouts.app')

@section('title', $info['title'])

@section('content')
    <div class="categories {{ $category }}-page">
        <h2>{{ $info['heading'] }}</h2>
        <p>{{ $info['description'] }}</p>

        <ul>
            @foreach ($posts as $post)
                @include('post.post_card', ['post' => $post])
            @endforeach
        </ul>
    </div>
@endsection