@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    <div class="login-title">
        <h3>プロフィール編集</h3>
    </div>

    <div class="form-wrapper">
        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
            @csrf

            <div class="form-item">
                <label for="name">名前</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-item">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-item">
                <label for="password">新しいパスワード（変更する場合）</label>
                <input id="password" type="password" name="password">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-item">
                <label for="password_confirmation">新しいパスワード（確認）</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
            </div>

            <button type="submit" class="submit-button">更新する</button>
        </form>
    </div>
@endsection
