<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomFormRequest;
use App\Models\Block;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Unity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $model;

    public function __construct(Room $room)
    {
        $this->model = $room;
    }

    public function index(Request $request)
    {
        $rooms = $this->model->where('code', 'LIKE', "%{$request->search}%")->paginate(7);
        return view('room.index', compact('rooms'));
    }

    public function create()
    {
        $blocks = Block::get(['code']);
        $unities = Unity::get(['code']);
        $room = [];
        return view('room.create', compact(['blocks', 'unities', 'room']));
    } 

    public function reservations($room)
    {
        $room = Room::where('code', 'LIKE', "%{$room}%")->first();

        // $reservations = $room->reservations->whereNotNull('acronym')
        // ->whereIn('frequency', [1, 2])->sortBy('weekday');

        // $weekStart = Carbon::now()->startOfWeek();
        // $weekEnd = Carbon::now()->endOfWeek();
        // $reservations = $room->reservations()
        //     ->whereNotNull('acronym')
        //     ->whereIn('frequency', [1, 2])
        //     ->whereHas('reservationDates', function ($query) use ($weekStart, $weekEnd) {
        //         $query->whereBetween('date', [$weekStart, $weekEnd]);
        //     })
        //     ->get();
            $schedules = Schedule::orderBy('startTime', 'asc')->get();
            $startOfWeek = Carbon::parse('monday this week');
            $endOfWeek = Carbon::parse('sunday this week');
            $roomCode = $room->code;
            // Loop over the days of the week
            for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++) {
                $date = $startOfWeek->copy()->addDays($dayOfWeek - 1);
                
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
                                                ->whereNotNull('acronym')
                                                ->first();                        
                    $reserved[$key] = $reservation ? ($reservation->status == 1 ? ['reserved' => 2, 'code' => $reservation->code, 'acronym'  => $reservation->acronym, 'class' => $reservation->class] : ['reserved' => 1, 'code' => $reservation->code]) : 0;
                }
            
                $results[$dayOfWeek] = $reserved;
            }

       

        $schedulesCode = Schedule::orderBy('startTime')->pluck('code');
        $schedulesTimes = Schedule::selectRaw("DATE_FORMAT(startTime, '%H:%i') as startTime, DATE_FORMAT(endTime, '%H:%i') as endTime")
        ->orderBy('startTime', 'asc')
        ->get();


        $dias = [
            1 => 'Segunda',
            2 => 'Terça',
            3 => 'Quarta',
            4 => 'Quinta',
            5 => 'Sexta',
            6 => 'Sábado',
            7 => 'Domingo'
          ];

        return view('room.roomres', compact(['schedulesCode', 'schedulesTimes', 'results', 'roomCode', 'dias']));
    }

    public function store(RoomFormRequest $request)
    {
        $room = $this->model->store($request->all());

        $unities = $request->input('unities');
        $room->unities()->syncWithoutDetaching($unities);


        return redirect()->route('room.index');
    }

    public function edit($code)
    {
        if(!$room = $this->model->find($code))
        {
            return redirect()->route('room.index');
        }
        $blocks = Block::get(['code']);
        $unities = Unity::get(['code']);
        return view('room.edit', compact(['room', 'blocks', 'unities']));
    }

    public function update(roomFormRequest $request, $code)
    {
        if(!$room = $this->model->find($code))
        {
            return redirect()->route('room.index');
        }

        $room->update($request->all());
        $unities = $request->input('unities');
        $room->unities()->sync($unities);

        return redirect()->route('room.index');
    }

    public function destroy($code)
    {
        if(!$room = $this->model->find($code))
        {
            return redirect()->route('room.index');
        }
        
        $room->delete();

        return redirect()->route('room.index');
    }
}
