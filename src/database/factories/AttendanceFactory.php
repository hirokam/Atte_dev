<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'workday' => $this->faker->date(),
            'work_start_time' => $this->faker->dateTime(),
            'work_end_time' => $this->faker->dateTime()
        ];
    }
}
