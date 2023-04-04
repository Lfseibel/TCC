@extends('layouts.app')

@section('title', 'Salas')

@section('content')


{{auth()->user()->email}}
<article class="flex items-center justify-center flex-col mt-8">
  <div class="flex mb-8">
    <h1 class="text-2xl font-semibold leading-tigh py-2 mr-96">Salas:</h1>
    <a href="{{ route('room.create') }}" class=" bg-green-200 rounded py-2 px-6">Adicionar Sala</a>
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
            Capacidade
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Capacidade R.
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Bloco
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
    @foreach ($rooms as $room)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $room->code }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $room->capacity }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $room->reduced_capacity }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $room->block_code }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('room.edit', $room->code) }}" class="bg-yellow-200 rounded-full py-2 px-6">Editar</a>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form action="{{ route('room.destroy', $room->code) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
              </form>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  </article>

@endsection