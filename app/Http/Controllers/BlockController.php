<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockFormRequest;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    protected $model;

    public function __construct(Block $block)
    {
        $this->model = $block;
    }

    public function index(Request $request)
    {
        $blocks = $this->model->where('code', 'LIKE', "%{$request->search}%")->get();
        return view('block.index', compact('blocks'));
    }

    public function create()
    {
        return view('block.create');
    } 

    public function store(BlockFormRequest $request)
    {
        $this->model->store($request->all());

        return redirect()->route('block.index');
    }

    public function edit($code)
    {
        if(!$block = $this->model->find($code))
        {
            return redirect()->route('block.index');
        }
        return view('block.edit', compact('block'));
    }

    public function update(BlockFormRequest $request, $code)
    {
       
        if(!$block = $this->model->find($code))
        {
            return redirect()->route('block.index');
        }
        $data = $request->only('code');


        $block->update($data);

        return redirect()->route('block.index');
    }

    public function destroy($code)
    {
        if(!$block = $this->model->find($code))
        {
            return redirect()->route('block.index');
        }
        
        $block->delete();

        return redirect()->route('block.index');
    }
}
