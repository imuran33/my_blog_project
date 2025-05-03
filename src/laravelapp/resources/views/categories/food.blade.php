@extends('layouts.app')

@section('title', 'Food')

@section('content')
    <div class="food-page">
        <h2>食べ物ページへようこそ！</h2>
        <p>ここはnakoが食べたごはんやおやつをさらけ出す場所です</p>

        <ul>
            @foreach ($posts as $post)
                <li>
                    <a href="{{ url('/food/' . $post['id']) }}">{{ $post['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection