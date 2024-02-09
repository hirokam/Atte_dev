@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('main')
    <div class="content">
        <p class="content__title">ログイン</p>
        <div class="content__inner">
            <form action="/login" method="post" class="login-form">
                @csrf
                <div class="content__inner-items">
                    <p class="content__inner-item-email">
                        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
                    </p>
                    <p class="error-message">@error('email')<span>※{{$errors->first('email')}}</span>@enderror</p>
                    <p class="content__inner-item-password">
                        <input type="password" name="password" placeholder="パスワード">
                    </p>
                    <p class="error-message">@error('password')<span>※{{$errors->first('password')}}</span>@enderror</p>
                </div>
                <div class="content__inner-button-login">
                    <button class="login">ログイン</button>
                </div>
            </form>
            <div class="content__inner-guide">
                <p class="guide">アカウントをお持ちでない方はこちらから</p>
                <a href="/register" class="register">会員登録</a>
            </div>
        </div>
    </div>
@endsection