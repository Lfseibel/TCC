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
        $schedules = Schedule::orderBy('startTime', 'asc')->get();
        foreach ($rooms as $room) {
            $roomCode = $room->code;
            
        
            $reserved = [];
            foreach ($schedules as $key => $schedule) {
                $startTime = $schedule->startTime;
                $endTime = $schedule->endTime;
        
                $reservation = Reservation::where('room_code', $roomCode)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $date) {
                                                $query->where('date', $date)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->first();
        
                                            $reserved[$key] = $reservation ? ($reservation->status == 1 ? ['reserved' => 2, 'code' => $reservation->code] : ['reserved' => 1, 'code' => $reservation->code]) : 0;
            }
        
            $results[$roomCode] = $reserved;
        }
        return view('index', compact(['schedulesCode'],['schedulesTimes'],['results'],['schedules']));


        
    }
}
