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
        
        if(auth()->user()->type === 'Direcao' or auth()->user()->type === 'Comum')
        {
            $reservations = $this->model->where('status', 'LIKE', "%{$request->input('status')}%")->where('user_email', '=', auth()->user()->email)->orderByDesc('code')->paginate(7);
        }
        else
        {
            $reservations = $this->model->where('status', 'LIKE', "%{$request->input('status')}%")->orderByDesc('code')->paginate(7);
        }
        return view('reservation.index', compact('reservations'));
    }

    public function create(Request $request)
    {
        if(auth()->user()->type === 'Comum')
        {
            $reservations = $this->model->where('status', '=', "0")->where('user_email', '=', auth()->user()->email)->count();
            if($reservations >= 3)
            {
                return redirect()->back()->withErrors(['error' => 'Seu limite de 3 solicitações foi alcançado, aguarde o administrador aprovar uma reserva para solicitar mais']);
            }
        }

        $rooms = Room::get(['code']);
        $room_code = $request->input('room_code');
        
        $startTime = $request->input('startTime');
        
        $endTime = $request->input('endTime');
        if(!$startDate = $request->input('startDate'))
        {
            $startDate = Carbon::today()->toDateString();
        }
        
        if(!$calendar = DB::table('calendars')->where('startSemester', '<=', $startDate)->where('endSemester', '>=', $startDate)->first())
        {
            return redirect()->back()->withErrors(['error' => 'Não existe um calendario aberto, aguarde o administrador do sistema abrir um para realizar sua reserva']);
        }
        
        $endSemester = $calendar->endSemester;

        return view('reservation.create', compact('rooms','room_code','startTime', 'endTime', 'startDate', 'endSemester'));
    } 

    public function store(ReservationFormRequest $request)
    {
        if(auth()->user()->type === 'Comum')
        {
            $reservations = $this->model->where('status', '=', "0")->where('user_email', '=', auth()->user()->email)->count();
            if($reservations >= 3)
            {
                return redirect()->back()->withErrors(['error' => 'Seu limite de 3 solicitações foi alcançado, aguarde o administrador aprovar uma reserva para solicitar mais']);
            }
        }

        $today = \Illuminate\Support\Carbon::today();
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        if(!$calendar = DB::table('calendars')->where('startSemester', '<=', $today)->where('endSemester', '>=', $today)->first())
        {
            return redirect()->back()->withErrors(['error' => 'Não existe um calendario aberto, aguarde o administrador do sistema abrir um para realizar sua reserva'])->withInput();
        }
        if($startDate < $calendar->startSemester or $endDate > $calendar->endSemester)
        {
            return redirect()->back()->withErrors(['error' => "Reserva indisponível durante as datas solicitadas, o semestre atual começa no dia $calendar->startSemester e termina no dia $calendar->endSemester"])->withInput();
        }
        $roomCode = $request->input('room_code');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $numberTimes =  $request->input('times');
        $days = [
            'Segunda-Feira' => 'Monday',
            'Terca-Feira' => 'Tuesday',
            'Quarta-Feira' => 'Wednesday',
            'Quinta-Feira' => 'Thursday',
            'Sexta-Feira' => 'Friday',
            'Sabado' => 'Saturday',
            'Domingo' => 'Sunday',
        ];
        $weekDay = Carbon::parse($days[$request->input('weekday')])->dayOfWeek;

        $helperStartDate = Carbon::parse($request->input('startDate'));
        //verificar se existe reserva na sala durante o periodo solicitado
        switch ($numberTimes) {
            case 'Uma':
                $checker = FALSE;
                while ($helperStartDate->lte($endDate) and $checker != TRUE) 
                {
                    if ($helperStartDate->dayOfWeek === $weekDay) 
                    {
                        $date = $helperStartDate->format('Y-m-d');
                        $checker = TRUE;
                    }
                    $helperStartDate->addDay();
                }
                $check = Reservation::where('room_code', $roomCode)
                                            ->where('status', 1)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $date) {
                                                $query->where('date', $date)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->exists();
                if($check)
                {
                    return redirect()->back()->withErrors(['error' => 'Já existe uma reserva aprovada neste horario/dia'])->withInput();
                }
                
                break;
            case 'Semanal':
                while ($helperStartDate->lte($endDate)) 
                {
                    if ($helperStartDate->dayOfWeek === $weekDay) 
                    {
                        $date = $helperStartDate->format('Y-m-d');
                        $check = Reservation::where('room_code', $roomCode)
                                            ->where('status', 1)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $date) {
                                                $query->where('date', $date)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->exists();
                        if($check)
                        {
                            return redirect()->back()->withErrors(['error' => 'Já existe uma reserva aprovada neste horario/dia durante o periodo desejado'])->withInput();
                        }
                        $helperStartDate->addDays(6);
                    }
                    $helperStartDate->addDay();
                }
                break;
            case 'Quinzenal':
                while ($helperStartDate->lte($endDate)) 
                {
                    if ($helperStartDate->dayOfWeek === $weekDay) 
                    {
                        $date = $helperStartDate->format('Y-m-d');
                        $check = Reservation::where('room_code', $roomCode)
                                            ->where('status', 1)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $date) {
                                                $query->where('date', $date)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->exists();
                        if($check)
                        {
                            return redirect()->back()->withErrors(['error' => 'Já existe uma reserva aprovada neste horario/dia durante o periodo desejado'])->withInput();
                        }
                        $helperStartDate->addDays(13);
                    }
                    $helperStartDate->addDay();
                }
                break;
            default:
                return redirect()->back()->withErrors(['error' => 'Selecione uma opção valida'])->withInput();
                break;
        }

        $unityCode = auth()->user()->unity->code;
        $check_User_Unity = Unity::whereHas('rooms', function ($query) use ($roomCode) {
            $query->where('code', $roomCode);
        })
        ->where('code', $unityCode)
        ->exists();
        if($check_User_Unity && auth()->user()->type === 'Direcao' or auth()->user()->type === 'Admin')
        {
            $data = $request->merge(['status' => 1])->all();
        }
        else
        {
            if($calendar->limitDate >= $today->toDateString())
            {
                return redirect()->back()->withErrors(['error' => "Sala ainda não liberada pra reserva no periodo atual, somente apos o dia $calendar->limitDate"])->withInput();
            }
        }
        $data = $request->merge(['user_email' => auth()->user()->email])->all();
       
        $reservation_code = $this->model->store($data);

        $startDate = Carbon::parse($request->input('startDate'));
        switch ($numberTimes) {
            case 'Uma':
                $checker = FALSE;
                while ($startDate->lte($endDate) and $checker != TRUE) 
                {
                    if ($startDate->dayOfWeek === $weekDay) 
                    {
                        $date = $startDate->format('Y-m-d');
                        $checker = TRUE;
                    }
                    $startDate->addDay();
                }
                
                DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$date, $reservation_code->code]);
                break;
            case 'Semanal':
                while ($startDate->lte($endDate)) 
                {
                    if ($startDate->dayOfWeek === $weekDay) 
                    {
                        $date = $startDate->format('Y-m-d');
                        DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$date, $reservation_code->code]);
                        $startDate->addDays(6);
                    }
                    $startDate->addDay();
                }
                break;
            case 'Quinzenal':
                
                while ($startDate->lte($endDate)) 
                {
                    if ($startDate->dayOfWeek === $weekDay) 
                    {
                        $date = $startDate->format('Y-m-d');
                        DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$date, $reservation_code->code]);
                        $startDate->addDays(13);
                    }
                    $startDate->addDay();
                }
                break;
            default:
                return redirect()->back()->withErrors(['error' => 'Selecione uma opção valida'])->withInput();
                break;
        }

        return redirect()->route('reservation.index');
    }

    public function see($code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }
        
        foreach ($reservation->reservationDates as $date) {
            foreach ($date->getAttributes() as $key => $value) {
                if ($key === 'date') {
                    $dates[] = $value;
                }
            }
        }
        
        return view('reservation.see', compact('reservation', 'dates'));
    }

    public function edit($code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }
        $roomCode = $reservation->room_code;
        $unityCode = auth()->user()->unity->code;
        $check_User_Unity = Unity::whereHas('rooms', function ($query) use ($roomCode) {
            $query->where('code', $roomCode);
        })
        ->where('code', $unityCode)
        ->exists();
        if(($reservation->status && auth()->user()->type == 'Comum') || ($reservation->status && !$check_User_Unity && auth()->user()->type == 'Direcao') || !auth()->user()->type == 'Admin')
        {
            return redirect()->back()->withErrors(['error' => 'Reserva já aprovada, edição não permitida']);
        }
        
        $rooms = Room::get(['code']);

        $room_code = NULL;
        $startTime = NULL;
        $endTime = NULL;
        $firstDate = $reservation->reservationDates()->first();
        $getter = $firstDate->getAttributes();
        $startDate = $getter['date'];

        
        
        $calendar = DB::table('calendars')->where('startSemester', '<=', $startDate)->where('endSemester', '>=', $startDate)->first();
        $endSemester = $calendar->endSemester;
        return view('reservation.edit', compact('rooms', 'reservation', 'room_code','startTime', 'endTime', 'startDate', 'endSemester'));
    }

    public function update(ReservationFormRequest $request, $code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }

        $unityCode = auth()->user()->unity->code;
        $check_User_Unity = Unity::whereHas('rooms', function ($query) use ($request) {
            $query->where('code', $request->room_code);
        })
        ->where('code', $unityCode)
        ->exists();
        if(!$check_User_Unity && $reservation->status)
        {
            return redirect()->back()->withErrors(['error' => 'Não é possivel modificar sua reserva pois você está solicitando a mudança para uma sala que não pertence a sua unidade'])->withInput();
        }

        $today = \Illuminate\Support\Carbon::today();
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        if(!$calendar = DB::table('calendars')->where('startSemester', '<=', $today)->where('endSemester', '>=', $today)->first())
        {
            return redirect()->back()->withErrors(['error' => 'Não existe um calendario aberto, aguarde o administrador do sistema abrir um para realizar sua reserva'])->withInput();
        }
        if($startDate < $calendar->startSemester or $endDate > $calendar->endSemester)
        {
            return redirect()->back()->withErrors(['error' => "Reserva indisponível durante as datas solicitadas, o semestre atual começa no dia $calendar->startSemester e termina no dia $calendar->endSemester"])->withInput();
        }
        $roomCode = $request->input('room_code');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $numberTimes =  $request->input('times');
        $days = [
            'Segunda-Feira' => 'Monday',
            'Terca-Feira' => 'Tuesday',
            'Quarta-Feira' => 'Wednesday',
            'Quinta-Feira' => 'Thursday',
            'Sexta-Feira' => 'Friday',
            'Sabado' => 'Saturday',
            'Domingo' => 'Sunday',
        ];
        $weekDay = Carbon::parse($days[$request->input('weekday')])->dayOfWeek;
        
        $helperStartDate = Carbon::parse($request->input('startDate'));
        //verificar se existe reserva na sala durante o periodo solicitado
        switch ($numberTimes) {
            case 'Uma':
                $checker = FALSE;
                while ($helperStartDate->lte($endDate) and $checker != TRUE) 
                {
                    if ($helperStartDate->dayOfWeek === $weekDay) 
                    {
                        $date = $helperStartDate->format('Y-m-d');
                        $checker = TRUE;
                    }
                    $helperStartDate->addDay();
                }
                $check = Reservation::where('room_code', $roomCode)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $date) {
                                                $query->where('date', $date)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->where('status', 1)
                                            ->first();
                if($check && $check!=$reservation)
                {
                    return redirect()->back()->withErrors(['error' => 'Já existe uma reserva aprovada neste horario/dia'])->withInput();
                }
                
                break;
            case 'Semanal':
                while ($helperStartDate->lte($endDate)) 
                {
                    if ($helperStartDate->dayOfWeek === $weekDay) 
                    {
                        $date = $helperStartDate->format('Y-m-d');
                        $check = Reservation::where('room_code', $roomCode)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $date) {
                                                $query->where('date', $date)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->where('status', 1)
                                            ->exists();
                        if($check && $check!=$reservation)
                        {
                            return redirect()->back()->withErrors(['error' => 'Já existe uma reserva aprovada neste horario/dia durante o periodo desejado'])->withInput();
                        }
                        $helperStartDate->addDays(6);
                    }
                    $helperStartDate->addDay();
                }
                break;
            case 'Quinzenal':
                while ($helperStartDate->lte($endDate)) 
                {
                    if ($helperStartDate->dayOfWeek === $weekDay) 
                    {
                        $date = $helperStartDate->format('Y-m-d');
                        $check = Reservation::where('room_code', $roomCode)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $date) {
                                                $query->where('date', $date)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->where('status', 1)
                                            ->exists();
                        if($check && $check!=$reservation)
                        {
                            return redirect()->back()->withErrors(['error' => 'Já existe uma reserva aprovada neste horario/dia durante o periodo desejado'])->withInput();
                        }
                        $helperStartDate->addDays(13);
                    }
                    $helperStartDate->addDay();
                }
                break;
            default:
                return redirect()->back()->withErrors(['error' => 'Selecione uma opção valida'])->withInput();
                break;
        }

        if($check_User_Unity && auth()->user()->type === 'Direcao' or auth()->user()->type === 'Admin')
        {
            $data = $request->merge(['status' => 1])->all();
        }
        else
        {
            if($calendar->limitDate >= $today->toDateString())
            {
                return redirect()->back()->withErrors(['error' => "Sala ainda não liberada pra reserva no periodo atual, somente apos o dia $calendar->limitDate"])->withInput();
            }
        }
        $data = $request->merge(['user_email' => $reservation->user_email])->all();
        $reservation->update($data);

        $startDate = Carbon::parse($request->input('startDate'));
        $reservation->reservationDates()->delete();
        switch ($numberTimes) {
            case 'Uma':
                $checker = FALSE;
                while ($startDate->lte($endDate) and $checker != TRUE) 
                {
                    if ($startDate->dayOfWeek === $weekDay) 
                    {
                        $date = $startDate->format('Y-m-d');
                        $checker = TRUE;
                    }
                    $startDate->addDay();
                }
                
                DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$date, $code]);
                break;
            case 'Semanal':
                while ($startDate->lte($endDate)) 
                {
                    if ($startDate->dayOfWeek === $weekDay) 
                    {
                        $date = $startDate->format('Y-m-d');
                        DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$date, $code]);
                        $startDate->addDays(6);
                    }
                    $startDate->addDay();
                }
                break;
            case 'Quinzenal':
                
                while ($startDate->lte($endDate)) 
                {
                    if ($startDate->dayOfWeek === $weekDay) 
                    {
                        $date = $startDate->format('Y-m-d');
                        DB::insert('insert into reservation_dates (date, reservation_code) values (?, ?)', [$date, $code]);
                        $startDate->addDays(13);
                    }
                    $startDate->addDay();
                }
                break;
            default:
                return redirect()->back()->withErrors(['error' => 'Selecione uma opção valida'])->withInput();
                break;
        }

        return redirect()->route('reservation.index');
    }

    public function verify($code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }

        if($reservation->status)
        {
            return redirect()->back()->withErrors(['error' => "Reserva já aprovada"]);
        }
        $startTime = $reservation->startTime;
        $endTime = $reservation->endTime;

        $resDates = $reservation->reservationDates()->get();
        foreach ($resDates as $date) {
            foreach ($date->getAttributes() as $key => $value) {
                if ($key === 'date') 
                {
                    
                    $check = Reservation::where('room_code', $reservation->room_code)
                                            ->where('status', 1)
                                            ->whereHas('reservationDates', function ($query) use ($startTime, $endTime, $value) {
                                                $query->where('date', $value)
                                                      ->where(function ($query) use ($startTime, $endTime) {
                                                        $query->where('startTime', '<', $endTime)
                                                              ->where('endTime', '>', $startTime);
                                                      });
                                            })
                                            ->exists();
                    if($check)
                    {
                        return redirect()->back()->withErrors(['error' => "Não pode ser aprovada pois já existe uma reserva neste horário no dia $value"]);
                    }
                    
                }
            }
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
