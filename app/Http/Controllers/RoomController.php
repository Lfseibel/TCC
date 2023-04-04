<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomFormRequest;
use App\Models\Block;
use App\Models\Room;
use App\Models\Unity;
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
        $blocks = Block::get(['code']);
        $unities = Unity::get(['code']);
        return view('room.create', compact(['blocks', 'unities']));
    } 

    public function store(RoomFormRequest $request)
    {
        $room = $this->model->store($request->all());

        $unities = $request->input('unities');
        $room->unities()->attach($unities);


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
        $room->unities()->syncWithoutDetaching($unities);

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
