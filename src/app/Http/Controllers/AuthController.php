<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function home()
    {
        $user_id = Auth::user()->id;
        $today = Carbon::today()->toDateString();
        $record = Attendance::where('user_id', $user_id)->orWhere('work_start_time', $today)->orderBy('id', 'desc')->first();
        $workEndTimeExists = optional($record)->work_end_time;

        $attendance_id = $record->id;
        $attendance = Attendance::find($attendance_id);
        $breakTimeRecord = $attendance->breaktimes()->orderBy('id', 'desc')->first();
        $breakTimeStart = optional($breakTimeRecord)->break_start_time;
        $breakTimeEnd = optional($breakTimeRecord)->break_end_time;
        $buttonAttributes = [];

        if($record) {
            if($workEndTimeExists) {
                $buttonAttributes = ['work_end_time', 'break_start_time', 'break_end_time'];
            }else{
                if($breakTimeStart) {
                    if($breakTimeEnd) {
                        $buttonAttributes = ['work_start_time', 'break_end_time'];
                    }else {
                        $buttonAttributes = ['work_start_time', 'work_end_time', 'break_start_time'];
                    }
                }else {
                    $buttonAttributes = ['work_start_time', 'break_end_time'];
                }
            }
        }else{
            $buttonAttributes = ['work_end_time', 'break_start_time', 'break_end_time'];
        }

        return view('clock_in', compact('buttonAttributes'));
    }
}
