@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
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

