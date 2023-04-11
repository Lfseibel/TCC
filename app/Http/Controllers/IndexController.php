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
        $capacity = $request->input('capacity');
        $block = $request->input('block');
        $unity = $request->input('unity');
        
        $rooms = Room::where('block_code', 'LIKE', "%{$block}%")
            ->when($unity, function ($query) use ($unity) {
                return $query->whereHas('unities', function ($query) use ($unity) {
                    $query->where('code', 'LIKE', "%{$unity}%");
                });
            })
            ->when($capacity, function ($query) use ($capacity) {
                return $query->where('capacity', '>=', $capacity)->orderBy('capacity', 'asc');
            })
            ->get();
            
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
                                            ->orderByDesc('status')
                                            ->first();                        
                $reserved[$key] = $reservation ? ($reservation->status == 1 ? ['reserved' => 2, 'code' => $reservation->code, 'acronym'  => $reservation->acronym, 'class' => $reservation->class] : ['reserved' => 1, 'code' => $reservation->code]) : 0;
            }
        
            $results[$roomCode] = $reserved;
        }

        $blocks = Block::get('code');

        $unities = Unity::get('code');

        $titleSize = $schedulesCode->count() + 1;

        return view('index', compact(['schedulesCode'],['schedulesTimes'],['results'],['schedules'], ['blocks'], ['unities'], ['rooms'], ['titleSize']));


        
    }

    public function search(Request $request)
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
        $capacity = $request->input('capacity');
        $block = $request->input('block');
        $unity = $request->input('unity');
        
        $rooms = Room::where('block_code', 'LIKE', "%{$block}%")
            ->when($unity, function ($query) use ($unity) {
                return $query->whereHas('unities', function ($query) use ($unity) {
                    $query->where('code', 'LIKE', "%{$unity}%");
                });
            })
            ->when($capacity, function ($query) use ($capacity) {
                return $query->where('capacity', '>=', $capacity)->orderBy('capacity', 'asc');
            })
            ->paginate(9);
            
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
                                            ->orderByDesc('status')
                                            ->first();
        
                $reserved[$key] = $reservation ? ($reservation->status == 1 ? ['reserved' => 2, 'code' => $reservation->code, 'acronym'  => $reservation->acronym, 'class' => $reservation->class] : ['reserved' => 1, 'code' => $reservation->code]) : 0;
            }
        
            $results[$roomCode] = $reserved;
        }

        $blocks = Block::get('code');

        $unities = Unity::get('code');

        $titleSize = $schedulesCode->count() + 1;

        return view('search_index', compact(['schedulesCode'],['schedulesTimes'],['results'],['schedules'], ['blocks'], ['unities'], ['rooms'], ['titleSize']));


        
    }
}
