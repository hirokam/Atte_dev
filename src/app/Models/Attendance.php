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
}
