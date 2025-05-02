{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="carousel">
        <div class="slides">
            <div class="slide slide1">
                <img src="{{ asset('images/autumn_kodaiji.jpg') }}" alt="Photo 1">
            </div>
            <div class="slide slide2">
                <img src="{{ asset('images/kingyo_aquarium.jpg') }}" alt="Photo 2">
            </div>
        </div>
    </div>

    <h2>ようこそ！</h2>
    <p>ここはnakoが自由に書き連ねる場所です。</p>
@endsection
