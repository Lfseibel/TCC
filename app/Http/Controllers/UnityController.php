<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnityFormRequest;
use App\Models\Unity;
use Illuminate\Http\Request;

class UnityController extends Controller
{
    protected $model;

    public function __construct(Unity $unity)
    {
        $this->model = $unity;
    }

    public function index(Request $request)
    {
        $unities = $this->model->where('code', 'LIKE', "%{$request->search}%")->paginate(7);
        return view('unity.index', compact('unities'));
    }

    public function create()
    {
        return view('unity.create');
    } 

    public function store(UnityFormRequest $request)
    {
        $this->model->store($request->all());

        return redirect()->route('unity.index');
    }

    public function edit($code)
    {
        if(!$unity = $this->model->find($code))
        {
            return redirect()->route('unity.index');
        }
        return view('unity.edit', compact('unity'));
    }

    public function update(UnityFormRequest $request, $code)
    {
        if(!$unity = $this->model->find($code))
        {
            return redirect()->route('unity.index');
        }
        $data = $request->only('name');


        $unity->update($data);

        return redirect()->route('unity.index');
    }

    public function destroy($code)
    {
        if(!$unity = $this->model->find($code))
        {
            return redirect()->route('unity.index');
        }
        
        $unity->delete();

        return redirect()->route('unity.index');
    }
}
