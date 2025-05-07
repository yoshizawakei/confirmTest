@extends("layouts.auth")

@section("css")
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section("content")
    <header class="header">
        <div class="header__inner">
            <a href="/login" class="logo">Fashionably Late</a>
        </div>
        <div class="header__link">
            <a href="/register" class="register">register</a>
        </div>
    </header>
    <main>
    <h2 class="login-header">Login</h2>
    <div class="login">
        <form class="login-form" action="/login" method="POST">
            @csrf
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
                <input type="password" id="password" name="password" placeholder="例：coachtech1106">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="button">
                <button type="submit" class="login-button">ログイン</button>
            </div>
        </form>
    </div>
    </main>
@endsection