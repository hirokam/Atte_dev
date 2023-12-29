@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clock_in.css') }}">
@endsection

@section('header')
    <div class="header-content__right">
        <nav class="header__nav">
            <ul class="header__nav-inner-items">
                <li><a href="" class="header__nav-inner-item">ホーム</a></li>
                <li><a href="" class="header__nav-inner-item">日付一覧</a></li>
                <li><a href="" class="header__nav-inner-item">ログアウト</a></li>
            </ul>
        </nav>
    </div>
@endsection

@section('main')
    <div class="content">
        <p class="content__title">◯◯さんお疲れ様です！</p>
        <div class="content__inner">
            <form action="/" method="post" class="content__inner-items">
                @csrf
                <div class="content__inner-items-upper">
                    <button name="work_start_time" class="content__inner-item">勤務開始</button>
                    <button disabled name="work_end_time" class="content__inner-item">勤務終了</button>
                </div>
                <div class="content__inner-items-lower">
                    <button disabled name="break_start_time" class="content__inner-item">休憩開始</button>
                    <button disabled name="break_end_time" class="content__inner-item">休憩終了</button>
                </div>
            </form>
        </div>
    </div>
@endsection