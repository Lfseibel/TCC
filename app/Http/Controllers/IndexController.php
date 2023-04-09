<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Unity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $schedulesCode = Schedule::orderBy('startTime')->pluck('code');
        $schedulesTimes = Schedule::selectRaw("DATE_FORMAT(startTime, '%H:%i') as startTime, DATE_FORMAT(endTime, '%H:%i') as endTime")
        ->orderBy('startTime', 'asc')
        ->get();

        if($request->date)
        {
            $date = Carbon::parse($request->date);
        }
        else
        {
            $date = Carbon::today();
        }
        
        $block = $request->input('block');
        $unity = $request->input('unity');

        if($unity)
        {
            $rooms = Room::where('block_code', 'LIKE', "%{$block}%")
            ->whereHas('unities', function ($query) use ($unity) {
                $query->where('code', $unity);
            })
            ->paginate(9);
        }
        else
        {
            $rooms = Room::where('block_code', 'LIKE', "%{$request->block}%")->paginate(9);
        }
        
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

        $blocks = Block::get('code');

        $unities = Unity::get('code');

        return view('index', compact(['schedulesCode'],['schedulesTimes'],['results'],['schedules'], ['blocks'], ['unities'], ['rooms']));


        
    }
}
