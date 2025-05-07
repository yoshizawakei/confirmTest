@extends("layouts.auth")

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section("content")
<header class="header">
    <div class="header__inner">
        <a href="/admin" class="logo">Fashionably Late</a>
    </div>
    <div class="header__link">
        <form action="/logout" method="post">
            @csrf
            <button class="logout">logout</button>
        </form>
    </div>
</header>
<div class="container">
    <h2 class="admin-header">Admin</h2>
    <div class="header-actions">
        <form action="/admin/search" method="GET" class="search-fields">
            @csrf
            <input class="item" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old("keyword") }}">

            <select class="sex" name="gender">
                <option value="">性別</option>
                <option value="男性">男性</option>
                <option value="女性">女性</option>
                <option value="その他" >その他</option>
            </select>

            <select class="inquiry" name="inquiry_type">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category["id"] }}">{{ $category["content"] }}</option>
                @endforeach
            </select>

            <input class="date" type="date" name="search_date" value="search_date">

            <button class="search-button" type="submit">検索</button>
        </form>
        <form action="/admin/reset" method="GET" class="reset-fields">
            @csrf
            <button class="reset-button" type="submit">リセット</button>
        </form>
    </div>
    <div class="table-actions">
        <form action="/admin/export" class="export" >
            <button type="submit" class="export-button">エクスポート</button>
        </form>
        <div class="pagination">
            {{ $contacts->appends(request()->except("page"))->links() }}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr class="table-tr">
                <th class="table-th">お名前</th>
                <th class="table-th">性別</th>
                <th class="table-th">メールアドレス</th>
                <th class="table-th">お問い合わせの種類</th>
                <th class="table-th"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr class="table-tr">
                    <td class="table-td">{{ $contact["name_last"] . " " . $contact["name_first"] }}</td>
                    <td class="table-td">{{ $contact["gender"] }}</td>
                    <td class="table-td">{{ $contact["email"] }}</td>
                    <td class="table-td">{{ $contact->category->content }}</td>
                    <td class="table-td">
                        <a href="#modal-{{ $contact->id }}" class="details-button-css">詳細</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<!-- モーダルの内容 -->
    @foreach ($contacts as $contact)
    <div id="modal-{{ $contact->id }}" class="modal-css">
        <div class="modal-css__content">
            <div class="modal-css__header">
                <a href="#" class="modal-css__close">&times;</a>
            </div>
            <table class="modal-css__table">
                <tr class="modal-css__item">
                    <th class="modal-css__label">お名前</th>
                    <td class="modal-css__value">{{ $contact["name_last"] . "  " . $contact["name_first"] }}</td>
                </tr>
                <tr class="modal-css__item">
                    <th class="modal-css__label">性別</th>
                    <td class="modal-css__value">{{ $contact["gender"] }}</td>
                </tr>
                <tr class="modal-css__item">
                    <th class="modal-css__label">メールアドレス</th>
                    <td class="modal-css__value">{{ $contact["email"] }}</td>
                </tr>
                <tr class="modal-css__item">
                    <th class="modal-css__label">電話番号</th>
                    <td class="modal-css__value">{{ $contact["tel"] }}</td>
                </tr>
                <tr class="modal-css__item">
                    <th class="modal-css__label">住所</th>
                    <td class="modal-css__value">{{ $contact["address"] }}</td>
                </tr>
                <tr class="modal-css__item">
                    <th class="modal-css__label">建物名</th>
                    <td class="modal-css__value">{{ $contact["building"] }}</td>
                </tr>
                <tr class="modal-css__item">
                    <th class="modal-css__label">お問い合わせの種類</th>
                    <td class="modal-css__value">{{ $contact->category->content }}</td>
                </tr>
                <tr class="modal-css__item">
                    <th class="modal-css__label">お問い合わせ内容</th>
                    <td class="modal-css__value modal-css__inquiry-body">{{ $contact["detail"] }}</td>
                </tr>
            </table>
            <div class="modal-css__footer">
                <form action="/delete" method="post">
                    @method("delete")
                    @csrf
                    <input type="hidden" name="id" value="{{ $contact->id }}">
                    <button type="submit" class="modal-css__delete-button">削除</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection