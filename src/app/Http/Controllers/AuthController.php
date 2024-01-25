<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AuthController extends Controller
{
    public function home()
    {
        return view('clock_in');
    }
}
