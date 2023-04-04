<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationFormRequest;
use App\Models\Calendar;
use App\Models\Reservation;
use App\Models\ReservationDate;
use App\Models\Room;
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
        $data = $request->merge(['user_email' => auth()->user()->email])->all();
        $reservation_code = $this->model->store($data);

        $today = \Illuminate\Support\Carbon::today();
        // $newData['date'] = '2023-02-02';
        // $newData['code'] = $reservation_code->code;
        // dd($newData);
        // $this->resDate->store($newData);
        
        DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$today, $reservation_code->code]);

        if(!$limitDate_semester = DB::table('calendars')->where('limitDate', '>', $today)->orderBy('limitDate', 'asc')->first())
        {
            //Semestre não aberto
            dd('nao aberto');
        }


        // $startDate = Carbon::parse($request->start_date);
        // $endDate = Carbon::parse($request->end_date);
        
        $limitDate = Carbon::parse($request->limit_date);
        // $interval = $request->interval; // e.g. '1 week'
    
        // while ($startDate->lessThanOrEqualTo($endDate) && $startDate->lessThanOrEqualTo($limitDate)) {
        //     $reservation = new Reservation;
        //     $reservation->start_date = $startDate->toDateString();
        //     $reservation->end_date = $startDate->copy()->add($interval)->subDay()->toDateString();
        //     $reservation->save();
        
        //     $startDate->add($interval);
        // }

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
