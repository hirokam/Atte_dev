@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('header')
    <div class="header-content__right">
        <nav class="header__nav">
            <ul class="header__nav-inner-items">
                @if (Auth::check())
                <li><a href="/" class="header__nav-inner-item">ホーム</a></li>
                <li><a href="/attendance" class="header__nav-inner-item">日付一覧</a></li>
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
        <div class="content-inner__date">
           <form action="/search/{{$day->copy()->subDay()->toDateString()}}" method="post">
            @csrf
                <input type="hidden" name="the_selected_day" value="{{ $day->copy()->subDay()->toDateString() }}" >
                <button type="submit" name="the_previous_day" class="select-day__button" ><</button>
            </form>
            <div class="select-day">{{ $day->format('Y-m-d') }}</div>
            <form action="/search/{{$day->copy()->addDay()->toDateString()}}" method="post">
            @csrf
                <input type="hidden" name="the_selected_day" value="{{ $day->copy()->addDay()->toDateString() }}">
                <button type="submit" name="the_next_day" class="select-day__button" >></button>
           </form>
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
                @foreach ($todayParams as $param)
                <tr>
                    <td>{{$param->getUserName()}}</td>
                    <td>{{ \Carbon\Carbon::parse($param->work_start_time)->format('H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($param->work_end_time)->format('H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($param->getTotalBreakDuration())->format('H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($param->getTotalAttendanceDuration())->format('H:i:s') }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="content-inner__pagination">
            {{ $todayParams->links('custom.pagination') }}
        </div>
    </div>
@endsection