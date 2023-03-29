<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Block, Calendar, Reservation, ReservationDate, Room, Schedule, Unity, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Block::create([
            'code' => 'C'
        ]);

        Calendar::create([
            'year' => 2023,
            'period' => 1,
            'limitDate' => '2023/07/26'
        ]);

        Room::create([
            'code' => 'C1004',
            'capacity' => 50,
            'reduced_capacity' => 25,
            'block_code' => 'C'
        ]);

        Room::create([
            'code' => 'C1005',
            'capacity' => 50,
            'reduced_capacity' => 25,
            'block_code' => 'C'
        ]);

        Room::create([
            'code' => 'C1006',
            'capacity' => 50,
            'reduced_capacity' => 25,
            'block_code' => 'C'
        ]);

        Unity::create([
            'code' => 'MI',
            'name' => 'Math institute'
        ]);

        User::create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234'),
            'type' => 'admin',
            'unity_code' => 'MI'
        ]);

        User::create([
            'email' => 'professor@professor.com',
            'password' => bcrypt('1234'),
            'type' => 'professor',
            'unity_code' => 'MI'
        ]);

        Schedule::create([
            'code' => 'M1',
            'startTime' => '07:00',
            'endTime' => '07:55'
        ]);

        Schedule::create([
            'code' => 'M2',
            'startTime' => '07:56',
            'endTime' => '08:50'
        ]);

        Schedule::create([
            'code' => 'M3',
            'startTime' => '08:51',
            'endTime' => '9:45'
        ]);

        Schedule::create([
            'code' => 'M4',
            'startTime' => '10:10',
            'endTime' => '11:05'
        ]);

        Schedule::create([
            'code' => 'M5',
            'startTime' => '11:06',
            'endTime' => '12:00'
        ]);

    }
}
