<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $work_start_time = $request->input('work_start_time');
        Attendance::create([
            'user_id' => $user_id,
            'work_start_time' => $work_start_time,
        ]);
        return redirect('/');
    }

    public function update(Request $request)
    {
        $user_id = $request->input('user_id');
        $work_end_time = $request->input('work_end_time');
        Attendance::where('user_id', $user_id)->update(['work_end_time' => $work_end_time]);
        
        return redirect('/');
    }
}
