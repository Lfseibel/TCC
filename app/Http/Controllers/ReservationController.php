<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationFormRequest;
use App\Models\Calendar;
use App\Models\Reservation;
use App\Models\ReservationDate;
use App\Models\Room;
use App\Models\Unity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    protected $model;
    protected $resDate;

    public function __construct(Reservation $reservation, ReservationDate $resDate)
    {
        $this->model = $reservation;
        $this->resDate = $resDate;
    }

    public function index(Request $request)
    {
        
        if(auth()->user()->type === 'professor')
        {
            $reservations = $this->model->where('code', 'LIKE', "%{$request->search}%")->where('user_email', '=', auth()->user()->email)->get();
        }
        else
        {
            $reservations = $this->model->where('code', 'LIKE', "%{$request->search}%")->get();
        }
        return view('reservation.index', compact('reservations'));
    }

    public function create(Request $request)
    {
        $rooms = Room::get(['code']);
        $room_code = $request->input('room_code');
        
        $startTime = $request->input('startTime');
        
        $endTime = $request->input('endTime');
        return view('reservation.create', compact('rooms','room_code','startTime', 'endTime'));
    } 

    public function store(ReservationFormRequest $request)
    {
        $roomCode = $request->input('room_code');
        $unityCode = auth()->user()->unity->code;
        $check_User_Room = Unity::whereHas('rooms', function ($query) use ($roomCode) {
            $query->where('code', $roomCode);
        })
        ->where('code', $unityCode)
        ->exists();

        if($check_User_Room)
        {
            $data = $request->merge(['status' => 1])->all();
        }
        else
        {
            $today = \Illuminate\Support\Carbon::today();
            if(DB::table('calendars')->where('limitDate', '>', $today)->orderBy('limitDate', 'asc')->exists())
            {
                return redirect()->back()->withErrors(['error' => 'Sala não liberada pra reserva no periodo atual'])->withInput();
            }
        }
        $data = $request->merge(['user_email' => auth()->user()->email])->all();
       
        $reservation_code = $this->model->store($data);
        
        $days = [
            'Segunda-Feira' => 'Monday',
            'Terca-Feira' => 'Tuesday',
            'Quarta-Feira' => 'Wednesday',
            'Quinta-Feira' => 'Thursday',
            'Sexta-Feira' => 'Friday',
            'Sabado' => 'Saturday',
            'Domingo' => 'Sunday',
        ];
        #dd(Carbon::parse($days[$request->input('weekday')])->dayOfWeek);
       
        $startDate = Carbon::parse($request->input('startDate'));
        $endDate = Carbon::parse($request->input('endDate'));
        $weekDay = Carbon::parse($days[$request->input('weekday')])->dayOfWeek;

        //se e quinzenal
        // while ($startDate->lte($endDate)) {
        //     if ($startDate->dayOfWeek === $weekDay) 
        //     {
        //         $date = $startDate->format('Y-m-d');
        //         DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$date, $reservation_code->code]);
        //         $startDate->addDays(13);
        //     }
        //     $startDate->addDay();
        // }

        //se e semanal
        while ($startDate->lte($endDate)) {
            if ($startDate->dayOfWeek === $weekDay) 
            {
                $date = $startDate->format('Y-m-d');
                DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$date, $reservation_code->code]);
                $startDate->addDays(6);
            }
            $startDate->addDay();
        }

        return redirect()->route('reservation.index');
    }

    public function edit($code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }
        $data['status'] = 1;

        $reservation->update($data);
        return view('reservation.edit', compact('reservation'));
    }

    public function update($code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }
        
        $data['status'] = 1;

        $reservation->update($data);

        return redirect()->route('reservation.index');
    }

    public function destroy($code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }
        
        $reservation->delete();

        return redirect()->route('reservation.index');
    }
}
