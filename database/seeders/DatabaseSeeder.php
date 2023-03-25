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
            'code' => 'B1004',
            'capacity' => 50,
            'reduced_capacity' => 25,
            'block_code' => 'C'
        ]);

        Unity::create([
            'code' => 'MI',
            'name' => 'Math institute'
        ]);

        User::create([
            'email' => 'lfseibel@live.com',
            'password' => bcrypt('1234'),
            'type' => 'admin',
            'unity_code' => 'MI'
        ]);

        Schedule::create([
            'code' => 'N1',
            'startTime' => '07:00',
            'endTime' => '07:55'
        ]);

        Reservation::create([
            'acronym' => 'DB',
            'class' => '01',
            'description' => 'Course of Databases',
            'observation' => 'Course',
            'responsible' => 'Olmes',
            'startTime' => '07:00',
            'endTime' => '07:55',
            'room_code' => 'B1004',
            'user_email' => 'lfseibel@live.com'
        ]);

        DB::table('reservationDate')->insert([
            [
                'date' => '2023-05-01',
                'reservation_code' => 1,
            ],
            [
                'date' => '2023-05-02',
                'reservation_code' => 1,
            ],
            [
                'date' => '2023-05-03',
                'reservation_code' => 1,
            ]
        ]);

    }
}
