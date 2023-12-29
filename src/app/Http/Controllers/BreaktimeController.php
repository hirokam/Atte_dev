<?php

namespace App\Http\Controllers;

use App\Models\Breaktime;
use Illuminate\Http\Request;

class BreaktimeController extends Controller
{
    public function break(Request $request)
    {
        $param = $request->all();
        Breaktime::create($param);
        return redirect('/');
    }
}
