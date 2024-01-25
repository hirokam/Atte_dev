<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $params = Attendance::all();
        return view('attendance', compact('params'));
    }

}
