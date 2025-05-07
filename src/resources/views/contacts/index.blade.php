@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset("css/index.css") }}">
@endsection

@section("content")
    <h2 class="contact-title">Contact</h2>
    <div class="contact-form-wrapper">
        <form class="contact-form" action="/confirm" method="POST">
            @csrf
            <div class="form-group required">
                <label for="name">お名前</label>
                <div class="input-area">
                    <div class="name-inputs">
                        <input type="text" id="name" name="name_first" placeholder="例：山田" value="{{ old('name_first', $validatedContact['name_first'] ?? '') }}">
                        <input type="text" name="name_last" placeholder="例：太郎" value="{{ old('name_last', $validatedContact['name_last'] ?? '') }}">
                    </div>
                    <div class="form__error">
                        @error("name_first")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__error">
                        @error("name_last")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label>性別</label>
                <div class="input-area">
                    <div class="gender-inputs">
                        <div class="gender-option">
                            <input type="radio" name="gender" value="男性" checked>
                            <div>男性</div>
                        </div>
                        <div class="gender-option">
                            <input type="radio" name="gender" value="女性">
                            <div>女性</div>
                        </div>
                        <div class="gender-option">
                            <input type="radio" name="gender" value="その他">
                            <div>その他</div>
                        </div>
                    </div>
                    <div class="form__error">
                        @error("gender")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label for="email">メールアドレス</label>
                <div class="input-area">
                    <input type="email" id="email" name="email" placeholder="例：test@example.com" value="{{ old('email', $validatedContact['email'] ?? '') }}">
                    <div class="form__error">
                        @error("email")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label for="phone">電話番号</label>
                <div class="input-area">
                    <div class="phone-inputs">
                        <input type="text" name="phone1" placeholder="080" value="{{ old('phone1', $validatedContact['phone1'] ?? '') }}">
                        <span class="hyphen">-</span>
                        <input type="text" name="phone2" placeholder="1234" value="{{ old('phone2', $validatedContact['phone2'] ?? '') }}">
                        <span class="hyphen">-</span>
                        <input type="text" name="phone3" placeholder="5678" value="{{ old('phone3', $validatedContact['phone3'] ?? '') }}">
                    </div>
                    <div class="form__error">
                        @error("phone1")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__error">
                        @error("phone2")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__error">
                        @error("phone3")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label for="address">住所</label>
                <div class="input-area">
                    <input type="text" id="address" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3"
                        value="{{ old('address', $validatedContact["address"] ?? '') }}">
                    <div class="form__error">
                        @error("address")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div for="building">建物名</div>
                <div class="input-area">
                    <input type="text" id="building" name="building" placeholder="例：千駄ヶ谷マンション101"
                        value="{{ old('building', $validatedContact["building"] ?? '') }}">
                    <div class="form__error">
                        @error("building")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label for="inquiry_type">お問い合わせの種類</label>
                <div class="input-area">
                    <select class="inquiry_type" name="category_id">
                        <option value="" disabled selected>選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category["id"] }}">{{ $category["content"] }}</option>
                        @endforeach
                    </select>
                    <div class="form__error">
                        @error("category_id")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label for="inquiry_content">お問い合わせ内容</label>
                <div class="input-area">
                    <textarea class="inquiry_content" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $validatedContact['detail'] ?? '') }}</textarea>
                    <div class="form__error">
                        @error("detail")
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__button">
                <button type="submit" class="confirm-button">確認画面</button>
            </div>
        </form>
    </div>
@endsection