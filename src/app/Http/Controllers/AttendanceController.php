<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function get()
    {
        $users = User::all();
        return view('attendance', ['users' => $users]);
    }
}
