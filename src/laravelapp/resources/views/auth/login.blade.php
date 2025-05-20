@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="login-title">
        <h3>ログイン</h3>
    </div>
    <div>
        <p>ログインすると、いいねやコメントができるようになります。<br>また一部のアプリも使えるようになります。</p>
    </div>
    <div class="form-wrapper">
        <form method="POST" action="{{ route('login.post') }}" class="signup-form">
            @csrf
            <div class="signupform-item">
                <label for="email">メールアドレス</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="signupform-item">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" value="{{ old('password') }}">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-button">ログイン</button>
        </form>
        <div class="new-register-btn"><a href="{{ route('signup') }}">新規ユーザ登録はこちら</a></div>
    </div>
@endsection
