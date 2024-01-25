<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\AuthController;
use App\Http\controllers\AttendanceController;
use App\Http\controllers\BreaktimeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'home']);
});

Route::get('/attendance', [AttendanceController::class, 'index']);

Route::post('/', [AttendanceController::class, 'store']);
Route::patch('/', [AttendanceController::class, 'update']);

Route::post('/break', [BreaktimeController::class, 'store']);
Route::patch('/break', [BreaktimeController::class, 'update']);