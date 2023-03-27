<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomFormRequest;
use App\Models\Room;
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
        $rooms = $this->model->where('code', 'LIKE', "%{$request->search}%")->get();
        return view('room.index', compact('rooms'));
    }

    public function create()
    {
        return view('room.create');
    } 

    public function store(RoomFormRequest $request)
    {
        $this->model->store($request->all());

        return redirect()->route('room.index');
    }

    public function edit($code)
    {
        if(!$room = $this->model->find($code))
        {
            return redirect()->route('room.index');
        }
        return view('room.edit', compact('room'));
    }

    public function update(roomFormRequest $request, $code)
    {
        if(!$room = $this->model->find($code))
        {
            return redirect()->route('room.index');
        }
        $data = $request->only('name');


        $room->update($data);

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
