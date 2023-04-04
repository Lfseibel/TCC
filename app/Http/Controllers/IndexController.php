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
        $schedulesCode = Schedule::orderBy('startTime')->pluck('code');
        $schedulesTimes = Schedule::selectRaw("DATE_FORMAT(startTime, '%H:%i') as startTime, DATE_FORMAT(endTime, '%H:%i') as endTime")
    ->orderBy('startTime', 'asc')
    ->get();

        $date = \Illuminate\Support\Carbon::today();

        $rooms = Room::select('code')->get();

        $results = [];

        foreach ($rooms as $room) {
            $roomCode = $room->code;
            $schedules = Schedule::orderBy('startTime', 'asc')->get();

            $reserved = [];
            foreach ($schedules as $schedule) 
            {
                $startTime = $schedule->startTime;
                $endTime = $schedule->endTime;
            
                $reservations = Reservation::where('room_code', $roomCode)
                                            ->where('status', 1)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $date) {
                                                $query->where('date', $date)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->exists();
                                        
                $reserved[] = $reservations;
            }
        
            $results[$roomCode] = $reserved;
        }

        return view('index', compact(['schedulesCode'],['schedulesTimes'],['results']));


        
    }
}
