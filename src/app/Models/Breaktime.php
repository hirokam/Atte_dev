<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Breaktime extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'break_start_time',
        'break_end_time',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function calculateBreakDuration()
    {
        $start = Carbon::parse($this->break_start_time);
        $end = Carbon::parse($this->break_end_time);

        return $start->diffInMinutes($end);
    }
}
