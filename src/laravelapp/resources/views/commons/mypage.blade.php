@extends('layouts.app')

@section('title')
    {{ Auth::user()->name }}のマイページ
@endsection

@section('content')
    <div>
        <h3>マイページ</h3>
    </div>
    <div>
        <p>ここでは、実行したいいねやコメントが確認・編集できるようになります。</p>
    </div>
    @if ($canPost)
        <a href="{{ route('create.post') }}">投稿作成</a>
    @endif
@endsection
