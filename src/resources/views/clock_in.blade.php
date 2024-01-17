@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clock_in.css') }}">
@endsection

@section('header')
    <div class="header-content__right">
        <nav class="header__nav">
            <ul class="header__nav-inner-items">
                @if (Auth::check())
                <li><a href="" class="header__nav-inner-item">ホーム</a></li>
                <li><a href="" class="header__nav-inner-item">日付一覧</a></li>
                <li><form action="/logout" method="post">
                    @csrf
                    <button class="header__nav-inner-item">ログアウト</button></form>
                </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection

@section('main')
    <div class="content">
        <p class="content__title">{{ Auth::user()->name }}さんお疲れ様です！</p>
        <div class="content__inner">
            <div class="content__inner-items-upper">
                <form action="/" method="post" class="content__inner-items">
                @csrf
                    <input hidden type="text" name="user_id" value="{{ Auth::user()->id }}">
                    <button type="submit" name="work_start_time" class="content__inner-item">勤務開始</button>
                </form>
                <form action="/" method="post" class="content__inner-items">
                @method('PATCH')
                @csrf
                    <input hidden type="text" name="user_id" value="{{ Auth::user()->id }}">
                    <button type="submit" name="work_end_time" class="content__inner-item">勤務終了</button>
                </form>
            </div>
            <div class="content__inner-items-lower">
                <form action="/" method="post" class="content__inner-items">
                @csrf
                    <button type="submit" name="break_start_time" class="content__inner-item">休憩開始</button>
                </form>
                <form action="/" method="post" class="content__inner-items">
                @csrf
                    <button type="submit" name="break_end_time" class="content__inner-item">休憩終了</button>
                </form>
            </div>
        </div>
    </div>
@endsection