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

@section('main')
    <div class="content">
        <div class="content-inner__pagenation">

        </div>
        <div class="content-inner__data">
            <table>
                <tr>
                    <th>名前</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
                <tr>
                    <td>テスト太郎</td>
                    <td>10:00:00</td>
                    <td>20:00:00</td>
                    <td>00:30:00</td>
                    <td>09:30:00</td>
                </tr>
                <tr>
                    <td>テスト太郎</td>
                    <td>10:00:00</td>
                    <td>20:00:00</td>
                    <td>00:30:00</td>
                    <td>09:30:00</td>
                </tr>
                <tr>
                    <td>テスト太郎</td>
                    <td>10:00:00</td>
                    <td>20:00:00</td>
                    <td>00:30:00</td>
                    <td>09:30:00</td>
                </tr>
                <tr>
                    <td>テスト太郎</td>
                    <td>10:00:00</td>
                    <td>20:00:00</td>
                    <td>00:30:00</td>
                    <td>09:30:00</td>
                </tr>
                <tr>
                    <td>テスト太郎</td>
                    <td>10:00:00</td>
                    <td>20:00:00</td>
                    <td>00:30:00</td>
                    <td>09:30:00</td>
                </tr>
            </table>
        </div>
    </div>
@endsection