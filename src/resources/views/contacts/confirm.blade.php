@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset("css/confirm.css") }}">
@endsection


@section("content")
    <h2 class="confirm-title">Confirm</h2>
    <div class="confirm-form-wrapper">
        <form class="confirm-form" action="/contacts" method="post">
            @csrf
            <table class="confirm-table">
                <tr class="form-item">
                    <th>お名前</th>
                    <div class="form-item-td">
                        <td><input type="text" id="name" name="name_first" value="{{ $contactData["name_first"] }}" readonly></td>
                        <td><input type="text" name="name_last" value="{{ $contactData["name_last"] }}" readonly></td>
                    </div>
                </tr>
                <tr class="form-item">
                    <th>性別</th>
                    <td><input type="text" name="gender" value="{{ $contactData["gender"] }}" readonly></td>
                </tr>
                <tr class="form-item">
                    <th>メールアドレス</th>
                    <td><input type="email" id="email" name="email" value="{{ $contactData["email"] }}" readonly></td>
                </tr>
                <tr class="form-item">
                    <th>電話番号</th>
                    <td><input type="text" name="tel" value="{{ $contactData["phone1"] . $contactData["phone2"] . $contactData["phone3"] }}" readonly></td>
                </tr>
                <tr class="form-item">
                    <th>住所</th>
                    <td><input type="text" id="address" name="address" value="{{ $contactData["address"] }}" readonly></td>
                </tr>
                <tr class="form-item">
                    <th>建物名</th>
                    <td><input type="text" id="building" name="building" value="{{ $contactData["building"] }}" readonly></td>
                </tr>
                <tr class="form-item">
                    <th>お問い合わせの種類</th>
                    <td><input type="text" name="category_id" value="{{ $categoryName }}" readonly></td>
                </tr>
                <tr class="form-item inquiry-content">
                    <th>お問い合わせ内容</th>
                    <td><input type="text" name="detail" value="{{ $contactData["detail"] }}" readonly></td>
                </tr>
            </table>
            <div class="button-group-container">
                <div class="button-group">
                    <button type="submit" name="action" value="send" class="submit-button">送信</button>
                </div>
                <div class="edit-button-group">
                    <button type="submit" name="action" value="back" class="edit-button">修正</button>
                </div>
            </div>
        </form>
    </div>
@endsection