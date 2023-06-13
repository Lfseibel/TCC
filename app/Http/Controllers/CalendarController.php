<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarFormRequest;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class CalendarController extends Controller
{
    protected $model;

    public function __construct(Calendar $calendar)
    {
        $this->model = $calendar;
    }

    public function index(Request $request)
    {
        $calendars = $this->model->where('year', 'LIKE', "%{$request->search}%")->paginate(7);
        return view('calendar.index', compact('calendars'));
    }

    public function create()
    {
        return view('calendar.create');
    } 

    public function store(CalendarFormRequest $request)
    {
        if($calendar = DB::table('calendars')->where('startSemester', '<=', $request->startSemester)->where('endSemester', '>=', $request->endSemester)->first())
        {
            $errors = new \Illuminate\Support\MessageBag(['Já existe um calendario que engloba algum dia desse período']);
            return redirect()->back()->with('errors', $errors)->withInput();
        }

        try {
            $this->model->store($request->all());
        } catch (PDOException $exception) {
            // Handle the database error
            if ($exception->errorInfo[1] == 1062) {
                // Handle duplicate key error
                $errors = new \Illuminate\Support\MessageBag(['Calendario já registrado no banco']);
                return redirect()->back()->with('errors', $errors)->withInput();
                // Modify the query and retry
            }
        }
        

        return redirect()->route('calendar.index');
    }

    public function edit($year, $period)
    {
        if(!$calendar = $this->model->where('year', '=', "{$year}")->where('period', '=', "{$period}")->first())
        {
            return redirect()->route('calendar.index');
        }
        return view('calendar.edit', compact('calendar'));
    }

    public function update(CalendarFormRequest $request, $year, $period)
    {
        if(!$calendar = $this->model->where('year', '=', "{$year}")->where('period', '=', "{$period}")->first())
        {
            return redirect()->route('calendar.index');
        }
        $data = $request->only('year', 'period', 'limitDate');

        DB::table('calendars')->where('year', $year)->where('period', $period)->update($data);

        return redirect()->route('calendar.index');
    }

    public function destroy($year, $period)
    {
        if(!$calendar = $this->model->where('year', '=', "{$year}")->where('period', '=', "{$period}")->first())
        {
            return redirect()->route('calendar.index');
        }

        $this->model->where('year', '=', "{$year}")->where('period', '=', "{$period}")->delete();

        return redirect()->route('calendar.index');
    }
}
