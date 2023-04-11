<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleFormRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $model;

    public function __construct(Schedule $schedule)
    {
        $this->model = $schedule;
    }

    public function index(Request $request)
    {
        $schedules = $this->model->where('code', 'LIKE', "%{$request->search}%")->orderBy('startTime', 'asc')->paginate(7);
        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedule.create');
    } 

    public function store(ScheduleFormRequest $request)
    {
        $this->model->store($request->all());

        return redirect()->route('schedule.index');
    }

    public function edit($code)
    {
        if(!$schedule = $this->model->find($code))
        {
            return redirect()->route('schedule.index');
        }
        return view('schedule.edit', compact('schedule'));
    }

    public function update(ScheduleFormRequest $request, $code)
    {
        if(!$schedule = $this->model->find($code))
        {
            return redirect()->route('schedule.index');
        }
        $data = $request->only('name');


        $schedule->update($data);

        return redirect()->route('schedule.index');
    }

    public function destroy($code)
    {
        if(!$schedule = $this->model->find($code))
        {
            return redirect()->route('schedule.index');
        }
        
        $schedule->delete();

        return redirect()->route('schedule.index');
    }
}
