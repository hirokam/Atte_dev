<?php

namespace App\Http\Controllers;

use App\Models\Breaktime;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BreaktimeController extends Controller
{
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $attendance_id = Attendance::where('user_id', $user_id)->orderBy('id', 'desc')->value('id');
        $break_start_time = Carbon::now();
        $created = Breaktime::create([
            'attendance_id' => $attendance_id,
            'break_start_time' => $break_start_time,
            'break_end_time' => null
        ]);

        return redirect('/');
    }

    public function update(Request $request)
    {
        $user_id = $request->input('user_id');
        $break_end_time = Carbon::now();
        $attendance_id = Attendance::where('user_id', $user_id)->orderBy('id', 'desc')->value('id');
        $lastInsertId = Breaktime::where('attendance_id', $attendance_id)->orderBy('id', 'desc')->value('id');
        Breaktime::where('id', $lastInsertId)->update(['break_end_time' => $break_end_time]);

        return redirect('/');
    }
}
