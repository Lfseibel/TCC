<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationFormRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $model;

    public function __construct(Reservation $reservation)
    {
        $this->model = $reservation;
    }

    public function index(Request $request)
    {
        $reservations = $this->model->where('code', 'LIKE', "%{$request->search}%")->get();
        return view('reservation.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservation.create');
    } 

    public function store(ReservationFormRequest $request)
    {
        $this->model->store($request->all());

        return redirect()->route('reservation.index');
    }

    public function edit($code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }
        return view('reservation.edit', compact('reservation'));
    }

    public function update(reservationFormRequest $request, $code)
    {
        if(!$reservation = $this->model->find($code))
        {
            return redirect()->route('reservation.index');
        }
        $data = $request->only('name');


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
