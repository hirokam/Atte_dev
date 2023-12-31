@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth_common.css') }}">
@endsection

@section('main')
    <div class="content">
        <p class="content__title">ログイン</p>
        <div class="content__inner">
            <form action="" class="login-form">
                <div class="content__inner-items">
                    <p class="content__inner-item">
                        <input type="email" name="email" placeholder="メールアドレス" class="">
                    </p>
                    <p class="content__inner-item">
                        <input type="text" name="password" placeholder="パスワード" class="">
                    </p>
                </div>
                <div class="content__inner-button">
                    <button>ログイン</button>
                </div>
            </form>
            <div class="content__inner-guide">
                <p class="guide">アカウントをお持ちでない方はこちらから</p>
                <a href="" class="register">会員登録</a>
            </div>
        </div>
    </div>
@endsection