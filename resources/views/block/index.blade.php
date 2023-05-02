@extends('layouts.app')

@section('title', 'Blocos')

@section('script')
<link href="
{{asset("./css/sweetalert.css")}}
" rel="stylesheet">
<script src="{{asset("./js/sweetalert.js")}}"></script>
<script src="{{asset("./js/bloco.js")}}"></script>
@endsection

@section('content')

<article class="flex items-center justify-center flex-col mt-8">
  <div class="flex mb-8">
    <h1 class="text-2xl font-semibold leading-tigh py-2 mr-96">Blocos:</h1>
    <a href="{{ route('block.create') }}" class=" bg-green-200 rounded py-2 px-6">Adicionar Bloco</a>
  </div>
  <div class="flex flex-col">
  
  </div>
  <table class="leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Codigo
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Editar
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Deletar
          </th>
          
        </tr>
      </thead>
      <tbody>
    @foreach ($blocks as $block)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $block->code }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('block.edit', $block->code) }}" class="bg-yellow-200 rounded-full py-2 px-6">Editar</a>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form id="{{$block->code}}" action="{{ route('block.destroy', $block->code) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="button" onclick="submitDeleteBlock('{{$block->code}}')" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
              </form>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  </article>
  <div class="py-4 flex items-center justify-center">
    {{$blocks->appends(['status'=> request()->get('status', '')])->links()}}
  </div>
@endsection