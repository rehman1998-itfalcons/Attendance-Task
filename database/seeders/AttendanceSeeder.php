<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        // Create 50 sample attendance records
        Attendance::factory(50)->create();
    }
}
