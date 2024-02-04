<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function store(Request $request)
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

        if($latestAttendance) {
            $now = Carbon::now();
            $workStartTime = Carbon::parse($latestAttendance->work_start_time);
        
            // $latestAttendance->work_end_time = $now;
            // $latestAttendance->save();


            if($workStartTime->isNextDay($now)) {
                $latestAttendance->work_end_time = $workStartTime->setTime(23,59,59);
                $latestAttendance->save();

                $newAttendance = new Attendance();
                $newAttendance->user_id = $user_id;
                $newAttendance->workday = $now->toDateString();
                $newAttendance->work_start_time = $now;
                $newAttendance->save();
            }else{
                $latestAttendance->work_end_time = $now;
                $latestAttendance->save();
            }
        }

        // Attendance::where('id', $lastInsertId)->update(['work_end_time' => $work_end_time]);
        
        return redirect('/');
    }

    public function index(Request $request)
    {
        $day = Carbon::today();
        $todayParams = Attendance::whereDate('workday', $day)->paginate(5);
        $todayParams->each(function ($attendance) {
            $attendance->workday = Carbon::parse($attendance->workday);
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
