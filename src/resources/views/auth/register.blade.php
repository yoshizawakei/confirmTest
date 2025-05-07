@extends('layouts.auth')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section("content")
    <header class="header">
        <div class="header__inner">
            <a href="/login" class="logo">Fashionably Late</a>
        </div>
        <div class="header__link">
            <a href="/login" class="login">login</a>
        </div>
    </header>
    <main>
        <h2 class="register-header">Register</h2>
        <div class="register">
            <form class="register-form" action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">お名前</label>
                    <input type="text" id="name" name="name" value="{{ old("name") }}" placeholder="例：山田　太郎">
                    <div class="error">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" value="{{ old("email") }}" placeholder="例：test@example.com">
                    <div class="error">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password"  placeholder="例：coachtech1106">
                    <div class="error">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="register-button">登録</button>
                </div>
            </form>
        </div>
    </main>
@endsection