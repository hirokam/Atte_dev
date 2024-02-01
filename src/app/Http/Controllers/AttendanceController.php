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

    public function update(Request $request)
    {
        $user_id = $request->input('user_id');
        $work_end_time = Carbon::now();
        $lastInsertId = Attendance::where('user_id', $user_id)->orderBy('id', 'desc')->value('id');
        Attendance::where('id', $lastInsertId)->update(['work_end_time' => $work_end_time]);
        
        return redirect('/');
    }

    public function index(Request $request)
    {
        $today = Carbon::today()->addDay();
        $todayParams = Attendance::whereDate('workday', $today)->paginate(5);

        // if($todayParams->isEmpty()) {
        //     return view('welcome');
        // }

        $todayParams->each(function ($attendance) {
            $attendance->workday = Carbon::parse($attendance->workday);
        });
        return view('attendance', compact('todayParams'));
    }

   public function search(Request $request)
    {
        $selectedDate = $request->input('the_selected_day');
//        dd($selectedDate);
        $selectedDate = $selectedDate ? Carbon::parse($selectedDate) : Carbon::today();
// //        $newDate = $selectedDate->subDay();
// //        if($request->has('the_previous_day')) {
// //            $newDate = $selectedDate->subDay();
//         } elseif ($request->has('the_next_day')) {
//             $newDate = $selectedDate->addDay();
//         }
        $todayParams = Attendance::whereDate('workday', $selectedDate)->paginate(5);
        return view('attendance', compact('todayParams'));
    }
}
