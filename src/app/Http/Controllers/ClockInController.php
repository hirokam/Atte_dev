<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class ClockInController extends Controller
{
    public function home()
    {
        return view('clock_in');
    }

    public function attendance(Request $request)
    {
        $param = $request->all();
        Attendance::create($param);
        return redirect('/');
    }
}
