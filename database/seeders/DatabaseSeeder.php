<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Block, Calendar, Room, Schedule, Unity, User};
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
            'code' => 'B'
        ]);
        
        Block::create([
            'code' => 'C'
        ]);
        
        Block::create([
            'code' => 'I'
        ]);
        Block::create([
            'code' => 'L'
        ]);
        Block::create([
            'code' => 'M'
        ]);
        Block::create([
            'code' => 'X'
        ]);

        Calendar::create([
            'year' => 2023,
            'period' => 1,
            'limitDate' => '2023/02/20',
            'startSemester' => '2023/03/01',
            'endSemester' => '2023/07/24',
        ]);

        $unity1 = Unity::create([
            'code' => 'PRG',
            'name' => 'Pró reitoria de graduação'
        ]);

        $unity2 = Unity::create([
            'code' => 'DSG',
            'name' => 'Diretoria de serviços gerais'
        ]);

            Unity::create([
        'code' => 'IMC',
        'name' => 'Instituto de Matemáticas e Computação'
    ]);

    Unity::create([
        'code' => 'IEPG',
        'name' => 'Instituto de Engenharia de Produção e Gestão'
    ]);
    
    Unity::create([
        'code' => 'IEM',
        'name' => 'Instituto de Engenharia Mecânica'
    ]);
    
    Unity::create([
        'code' => 'IRN',
        'name' => 'Instituto de Recursos Naturais'
    ]); 
    
    Unity::create([
        'code' => 'IFQ',
        'name' => 'Instituto de Física e Química'
    ]);
    
    Unity::create([
        'code' => 'IEST',
        'name' => 'Instituto de Engenharia de Sistemas e Tecnologia da Informação'
    ]);
    
    Unity::create([
        'code' => 'ISEE',
        'name' => 'Instituto de Sistemas Elétricos e Energia'
    ]);


        $room = Room::create([
            'code' => 'B4101',
            'capacity' => 42,
            'reduced_capacity' => 21,
            'block_code' => 'B'
        ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
            'code' => 'B4102',
            'capacity' => 40,
            'reduced_capacity' => 20,
            'block_code' => 'B'
        ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
            'code' => 'B4103',
            'capacity' => 70,
            'reduced_capacity' => 35,
            'block_code' => 'B'
        ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
            'code' => 'B4104',
            'capacity' => 42,
            'reduced_capacity' => 21,
            'block_code' => 'B'
        ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
            $room = Room::create([
        'code' => 'B4105',
        'capacity' => 70,
        'reduced_capacity' => 35,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4106',
        'capacity' => 74,
        'reduced_capacity' => 37,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4108',
        'capacity' => 70,
        'reduced_capacity' => 35,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4109',
        'capacity' => 72,
        'reduced_capacity' => 36,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4111',
        'capacity' => 71,
        'reduced_capacity' => 35,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4117',
        'capacity' => 35,
        'reduced_capacity' => 18,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4118',
        'capacity' => 60,
        'reduced_capacity' => 30,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4204',
        'capacity' => 60,
        'reduced_capacity' => 30,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4205',
        'capacity' => 60,
        'reduced_capacity' => 30,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4206',
        'capacity' => 40,
        'reduced_capacity' => 20,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4207',
        'capacity' => 40,
        'reduced_capacity' => 20,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4208',
        'capacity' => 40,
        'reduced_capacity' => 20,
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4209', 
        'capacity' => 40, 
        'reduced_capacity' => 20, 
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4210', 
        'capacity' => 40, 
        'reduced_capacity' => 20, 
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4211', 
        'capacity' => 40, 
        'reduced_capacity' => 20, 
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4212', 
        'capacity' => 61, 
        'reduced_capacity' => 30, 
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4213', 
        'capacity' => 60, 
        'reduced_capacity' => 30, 
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'B4214', 
        'capacity' => 65, 
        'reduced_capacity' => 32, 
        'block_code' => 'B'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'C1103', 
        'capacity' => 99, 
        'reduced_capacity' => 49, 
        'block_code' => 'C'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'C1105', 
        'capacity' => 100, 
        'reduced_capacity' => 50, 
        'block_code' => 'C'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'C1106', 
        'capacity' => 80, 
        'reduced_capacity' => 40, 
        'block_code' => 'C'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'I2101', 
        'capacity' => 102, 
        'reduced_capacity' => 51, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'I2102', 
        'capacity' => 103, 
        'reduced_capacity' => 51, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'I2105', 
        'capacity' => 96, 
        'reduced_capacity' => 48, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'I2109', 
        'capacity' => 34, 
        'reduced_capacity' => 17, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);$room = Room::create([
        'code' => 'I2110', 
        'capacity' => 34, 
        'reduced_capacity' => 17, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'I2111', 
        'capacity' => 85, 
        'reduced_capacity' => 42, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'I1118', 
        'capacity' => 90, 
        'reduced_capacity' => 45, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'I1123', 
        'capacity' => 46, 
        'reduced_capacity' => 23, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'I1128', 
        'capacity' => 79, 
        'reduced_capacity' => 39, 
        'block_code' => 'I'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'L8104', 
        'capacity' => 30, 
        'reduced_capacity' => 15, 
        'block_code' => 'L'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'L8105', 
        'capacity' => 30, 
        'reduced_capacity' => 15, 
        'block_code' => 'L'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'L8106', 
        'capacity' => 40, 
        'reduced_capacity' => 20, 
        'block_code' => 'L'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'M3109', 
        'capacity' => 60, 
        'reduced_capacity' => 30, 
        'block_code' => 'M'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'M3111',
        'capacity' => 60,
        'reduced_capacity' => 30,
        'block_code' => 'M'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'X1102',
        'capacity' => 110,
        'reduced_capacity' => 55,
        'block_code' => 'X'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'X1103',
        'capacity' => 110,
        'reduced_capacity' => 55,
        'block_code' => 'X'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'X1104',
        'capacity' => 110,
        'reduced_capacity' => 55,
        'block_code' => 'X'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'X1203',
        'capacity' => 110,
        'reduced_capacity' => 55,
        'block_code' => 'X'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'X1302',
        'capacity' => 110,
        'reduced_capacity' => 55,
        'block_code' => 'X'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'X1303',
        'capacity' => 110,
        'reduced_capacity' => 55,
        'block_code' => 'X'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);
        $room = Room::create([
        'code' => 'X1304',
        'capacity' => 110,
        'reduced_capacity' => 55,
        'block_code' => 'X'
    ]);
        $room->unities()->attach($unity1);
        $room->unities()->attach($unity2);

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
            'startTime' => '07:55',
            'endTime' => '08:50'
        ]);

        Schedule::create([
            'code' => 'M3',
            'startTime' => '08:50',
            'endTime' => '9:45'
        ]);

        Schedule::create([
            'code' => 'M4',
            'startTime' => '10:10',
            'endTime' => '11:05'
        ]);

        Schedule::create([
            'code' => 'M5',
            'startTime' => '11:05',
            'endTime' => '12:00'
        ]);

        Schedule::create([
            'code' => 'T1',
            'startTime' => '13:30',
            'endTime' => '14:25'
        ]);

        Schedule::create([
            'code' => 'T2',
            'startTime' => '14:25',
            'endTime' => '15:20'
        ]);

        Schedule::create([
            'code' => 'T3',
            'startTime' => '15:45',
            'endTime' => '16:40'
        ]);

        Schedule::create([
            'code' => 'T4',
            'startTime' => '16:40',
            'endTime' => '17:35'
        ]);

        Schedule::create([
            'code' => 'T5',
            'startTime' => '17:35',
            'endTime' => '18:30'
        ]);

        Schedule::create([
            'code' => 'N1',
            'startTime' => '19:00',
            'endTime' => '19:50'
        ]);

        Schedule::create([
            'code' => 'N2',
            'startTime' => '19:50',
            'endTime' => '20:40'
        ]);

        Schedule::create([
            'code' => 'N3',
            'startTime' => '21:00',
            'endTime' => '21:50'
        ]);

        Schedule::create([
            'code' => 'N4',
            'startTime' => '21:50',
            'endTime' => '22:40'
        ]);

        Schedule::create([
            'code' => 'N5',
            'startTime' => '22:40',
            'endTime' => '23:30'
        ]);
    }
}