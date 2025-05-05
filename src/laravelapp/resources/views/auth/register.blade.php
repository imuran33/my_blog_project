@extends('layouts.app')

@section('title', '新規登録')

@section('content')
    <div class="login-title">
        <h3>新規ユーザー登録</h3>
    </div>
    <div>
        <p>新規ユーザ登録すると、いいねやコメントができるようになります。<br>また一部のアプリも使えるようになります。</p>
    </div>
    <div class="form-wrapper">
        <form method="POST" action="{{ route('signup.post') }}" class="signup-form">
            @csrf
            <div class="form-item">
                <label for="name">名前</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-item">
                <label for="email">メールアドレス</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-item">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" value="{{ old('password') }}">
                @error('possword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-item">
                <label for="password_confirmation">パスワード確認</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    value="{{ old('password_confirmation') }}">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-button">新規登録</button>
        </form>
    </div>
@endsection
