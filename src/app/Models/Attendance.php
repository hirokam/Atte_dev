<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workday',
        'work_start_time',
        'work_end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserName()
    {
        return $this->user->name;
    }

    public function breaktimes()
    {
        return $this->hasMany(Breaktime::class);
    }

    public function getTotalBreakDuration()
    {
        return $this->breaktimes->sum(function ($breaktime) {
            return $breaktime->calculateBreakDuration();
        });
    }

    public function getTotalAttendanceDuration()
    {
        $workStartTime = \Carbon\Carbon::parse($this->work_start_time);
        $workEndTime = \Carbon\Carbon::parse($this->work_end_time);

        $attendanceDuration = $workEndTime->diffInMinutes($workStartTime);
        $attendanceDuration -= $this->getTotalBreakDuration();

        return $attendanceDuration;
    }
}
