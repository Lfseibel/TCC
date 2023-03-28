@extends('layouts.app')

@section('title', 'Reservas')

@section('content')


{{auth()->user()->email}}
<article class="flex items-center justify-center flex-col mt-8">
  <div class="flex mb-8">
    <h1 class="text-2xl font-semibold leading-tigh py-2 mr-96">Reservas:</h1>
    <a href="{{ route('reservation.create') }}" class=" bg-green-200 rounded py-2 px-6">Adicionar Reserva</a>
  </div>
  <div class="flex flex-col">
  
  </div>
  <table class="leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Sala
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Materia
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Responsavel
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Deferido
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Visualizar
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
    @foreach ($reservations as $reservation)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $reservation->room_code }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $reservation->acronym }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $reservation->responsible }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              @if ($reservation->status)
                <p class="text-green">SIM</p>
              @else
                <p class="text-red">NÃO</p>
              @endif
              
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <a href="{{ route('reservation.see', $reservation->code) }}" class="bg-green-200 rounded-full py-2 px-6">Ver</a>
          </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('reservation.edit', $reservation->code) }}" class="bg-yellow-200 rounded-full py-2 px-6">Editar</a>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form action="{{ route('reservation.destroy', $reservation->code) }}" method="POST">
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