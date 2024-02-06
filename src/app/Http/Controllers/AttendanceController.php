<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function startWork(Request $request)
    {
        $user_id = $request->input('user_id');
        $today = Carbon::today();
        $work_start_time = Carbon::now();
        $created = Attendance::create([
            'user_id' => $user_id,
            'workday' => $today,
            'work_start_time' => $work_start_time,
            'work_end_time' => null
        ]);
        return redirect('/');
    }

    public function finishWork(Request $request)
    {
        $user_id = $request->input('user_id');
        $latestAttendance = Attendance::where('user_id', $user_id)->orderBy('id', 'desc')->first();
        $now = Carbon::now();
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $workStartTime = Carbon::parse($latestAttendance->work_start_time);

        if($now->isNextDay($workStartTime)) {
            $latestAttendance->work_end_time->$yesterday->setTime(23,59,59);
            $latestAttendance->save();

            $newAttendance = new Attendance();
            $newAttendance->user_id = $user_id;
            $newAttendance->workday = $today->toDateString();
            $newAttendance->work_start_time->$today->setTime(0,0,0);
            $newAttendance->work_end_time = $now;
            $newAttendance->save();
        }else{
            if($latestAttendance) {
                $latestAttendance->work_end_time = $now;
                $latestAttendance->save();
            }
        }

        return redirect('/');
    }

    public function index(Request $request)
    {
        $day = Carbon::today();
        $todayParams = Attendance::whereDate('workday', $day)->paginate(5);
        $todayParams->each(function ($attendance) {
            $attendance->workday = Carbon::parse($attendance->workday);
            $attendance->work_end_time = $attendance->work_end_time ? Carbon::parse($attendance->work_end_time) : null;
        });
        return view('attendance', compact('day', 'todayParams'));
    }

    public function search(Request $request, $date)
    {
        $selectedDate = $request->input('the_selected_day') ?? $date;
        $day = $selectedDate ? Carbon::parse($selectedDate) : Carbon::today();
        session(['selected_day' => $day->toDateString()]);
        $todayParams = Attendance::whereDate('workday', $day)->paginate(5);
        return view('attendance', compact('day', 'todayParams'));
    }
}
