<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $schedulesCode = Schedule::get(['code']);
        $schedulesTimes = Schedule::get(['startTime', 'endTime']);
        $rooms = Room::get(['code']);
        foreach($rooms as $room)
        {
            
        }
        return view('index', compact(['schedulesCode'],['schedulesTimes'],['rooms']));
    }
}
