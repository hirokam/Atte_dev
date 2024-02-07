@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('main')
    <div class="content">
        <p class="content__title">会員登録</p>
        <div class="content__inner">
            <form action="/register" method="post" class="register-form">
                @csrf
                <div class="content__inner-items">
                    <p class="content__inner-item-name">
                        <input type="text" name="name" placeholder="名前" value="{{ old('name') }}">
                    </p>
                    <p class="error-message">@error('name')<span>※{{$errors->first('name')}}</span>@enderror</p>
                    <p class="content__inner-item-other">
                        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
                    </p>
                    <p class="error-message">@error('email')<span>※{{$errors->first('email')}}</span>@enderror</p>
                    <p class="content__inner-item-other">
                        <input type="password" name="password" placeholder="パスワード">
                    </p>
                    <p class="error-message">@error('password')<span>※{{$errors->first('password')}}</span>@enderror</p>
                    <p class="content__inner-item-other">
                        <input type="password" name="password_confirmation" placeholder="確認用パスワード">
                    </p>
                </div>
                <div class="content__inner-button-register">
                    <button class="register">会員登録</button>
                </div>
            </form>
            <div class="content__inner-guide">
                <p class="guide">アカウントをお持ちの方はこちらから</p>
                <a href="/login" class="login">ログイン</a>
            </div>
        </div>
    </div>
@endsection