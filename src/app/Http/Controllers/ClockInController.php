<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClockInController extends Controller
{
    public function store()
    {
        return view('clock_in');
    }
}
