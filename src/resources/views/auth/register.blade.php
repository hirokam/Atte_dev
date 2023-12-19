@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="css/register.css">
@endsection

@section('main')
<div class="content">
    <p class="content__title">会員登録</p>
    <div class="content__inner">
        <form action="" class="register-form">
            <div class="content__inner-items">
                <p class="content__inner-item">
                    <input type="text" name="name" placeholder="名前">
                </p>
                <p class="content__inner-item">
                    <input type="email" name="email" placeholder="メールアドレス">
                </p>
                <p class="content__inner-item">
                    <input type="text" name="password" placeholder="パスワード">
                </p>
                <p class="content__inner-item">
                    <input type="text" name="confirm-password" placeholder="確認用パスワード">
                </p>
            </div>
            <div class="content__inner-button">
                <button>会員登録</button>
            </div>
        </form>
        <div class="content__inner-guide">
            <p class="guide">アカウントをお持ちの方はこちらから</p>
            <a href="" class="login">ログイン</a>
        </div>
    </div>
</div>
@endsection