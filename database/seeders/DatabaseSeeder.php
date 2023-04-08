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
            'limitDate' => '2023/02/20',
            'startSemester' => '2023/03/01',
            'endSemester' => '2023/07/24',
        ]);

        Unity::create([
            'code' => 'PRG',
            'name' => 'Pró reitoria de graduação'
        ]);

        Unity::create([
            'code' => 'DSG',
            'name' => 'Algo'
        ]);

        Unity::create([
            'code' => 'IMC',
            'name' => 'Instituto de matemática e computação'
        ]);

        Unity::create([
            'code' => 'IEPG',
            'name' => 'Instituto de engenharia'
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

        

        User::create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234'),
            'type' => 'Admin',
            'unity_code' => 'PRG'
        ]);

        User::create([
            'email' => 'direcao@imc.com',
            'password' => bcrypt('1234'),
            'type' => 'Direcao',
            'unity_code' => 'IMC'
        ]);

        User::create([
            'email' => 'direcao@iepg.com',
            'password' => bcrypt('1234'),
            'type' => 'Direcao',
            'unity_code' => 'IEPG'
        ]);

        User::create([
            'email' => 'portaria@portaria.com',
            'password' => bcrypt('1234'),
            'type' => 'Portaria',
            'unity_code' => 'PRG'
        ]);

        User::create([
            'email' => 'comum@comum.com',
            'password' => bcrypt('1234'),
            'type' => 'Comum',
            'unity_code' => 'IMC'
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

        Schedule::create([
            'code' => 'T1',
            'startTime' => '13:30',
            'endTime' => '14:25'
        ]);

        Schedule::create([
            'code' => 'T2',
            'startTime' => '14:26',
            'endTime' => '15:20'
        ]);

        Schedule::create([
            'code' => 'T3',
            'startTime' => '15:45',
            'endTime' => '16:40'
        ]);

        Schedule::create([
            'code' => 'T4',
            'startTime' => '16:41',
            'endTime' => '17:35'
        ]);

        Schedule::create([
            'code' => 'T5',
            'startTime' => '17:36',
            'endTime' => '18:30'
        ]);

        Schedule::create([
            'code' => 'N1',
            'startTime' => '19:00',
            'endTime' => '19:50'
        ]);

        Schedule::create([
            'code' => 'N2',
            'startTime' => '19:51',
            'endTime' => '20:40'
        ]);

        Schedule::create([
            'code' => 'N3',
            'startTime' => '21:00',
            'endTime' => '21:50'
        ]);

        Schedule::create([
            'code' => 'N4',
            'startTime' => '21:51',
            'endTime' => '22:40'
        ]);

        Schedule::create([
            'code' => 'N5',
            'startTime' => '22:41',
            'endTime' => '23:30'
        ]);
    }
}
