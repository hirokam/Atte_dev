<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function startWork(Request $request)
    {
        $user_id = $request->input('user_id');
        // $year = 2024;
        // $month = 2;
        // $day = 8;
        // $today = Carbon::createMidnightDate($year, $month, $day);
        $today = Carbon::today();
        // $hour = 11;
        // $minute = 30;
        // $second = 0;
        // $work_start_time = Carbon::create($year, $month, $day, $hour, $minute,$second);
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
        $now = Carbon::now();
        $today = Carbon::today();
        $user_id = $request->input('user_id');
        $latestAttendance = Attendance::where('user_id', $user_id)->orderBy('id', 'desc')->first();

        if($latestAttendance) {
            $workStartTime = Carbon::parse($latestAttendance->work_start_time);

            if($now->isNextDay($workStartTime)) {
                $latestAttendance->work_end_time = $workStartTime->copy()->hour(23)->minute(59)->second(59);
                $latestAttendance->save();

                $newAttendance = new Attendance();
                $newAttendance->user_id = $user_id;
                $newAttendance->workday = $workStartTime->copy()->addDay()->toDateString();
                $newAttendance->work_start_time = $workStartTime->copy()->addDay()->hour(0)->minute(0)->second(0);
                $newAttendance->work_end_time = $now;
                $newAttendance->save();

            }elseif ($now->isNextDay($workStartTime->copy()->addDays(1))) {
                $latestAttendance->work_end_time = $workStartTime->copy()->hour(23)->minute(59)->second(59);
                $latestAttendance->save();

                $nextDay = $workStartTime->copy()->addDay();
                
                while ($nextDay->isBefore($now)) {
                    $newAttendance = new Attendance();
                    $newAttendance->user_id = $user_id;
                    $newAttendance->workday = $nextDay->copy()->toDateString();
                    $newAttendance->work_start_time = $nextDay->copy()->hour(0)->minute(0)->second(0);
                    $newAttendance->work_end_time = $nextDay->copy()->hour(23)->minute(59)->second(59);
                    $newAttendance->save();

                    $nextDay->addDay();
                }
                $newAttendance = new Attendance();
                $newAttendance->user_id = $user_id;
                $newAttendance->workday = $today->copy()->toDateString();
                $newAttendance->work_start_time = $today->copy()->hour(0)->minute(0)->second(0);
                $newAttendance->work_end_time = $now;
                $newAttendance->save();

            }else {
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

    // public function workerAttendance(Request $request ,$selectedName)
    // {
    //     $day = Carbon::today();
    //     $selectedName = $request->input('selected_name');
    //     $userParams = User::where('name', $selectedName)->first();
    //     $userId = $userParams->id;
    //     $todayParams = Attendance::whereDate('workday', $day)->where('user_id', $userId)->paginate(5);

    //     return view('attendance', compact('day', 'selectedName', 'todayParams'));
    // }
}
