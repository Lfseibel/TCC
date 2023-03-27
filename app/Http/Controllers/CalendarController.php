<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarFormRequest;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    protected $model;

    public function __construct(Calendar $calendar)
    {
        $this->model = $calendar;
    }

    public function index(Request $request)
    {
        $calendars = $this->model->where('year', 'LIKE', "%{$request->search}%")->get();
        return view('calendar.index', compact('calendars'));
    }

    public function create()
    {
        return view('calendar.create');
    } 

    public function store(CalendarFormRequest $request)
    {
        $this->model->store($request->all());

        return redirect()->route('calendar.index');
    }

    public function edit($code)
    {
        if(!$calendar = $this->model->find($code))
        {
            return redirect()->route('calendar.index');
        }
        return view('calendar.edit', compact('calendar'));
    }

    public function update(CalendarFormRequest $request, $code)
    {
        if(!$calendar = $this->model->find($code))
        {
            return redirect()->route('calendar.index');
        }
        $data = $request->only('name');


        $calendar->update($data);

        return redirect()->route('calendar.index');
    }

    public function destroy($code)
    {
        if(!$calendar = $this->model->find($code))
        {
            return redirect()->route('calendar.index');
        }
        
        $calendar->delete();

        return redirect()->route('calendar.index');
    }
}
