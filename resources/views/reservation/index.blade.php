@extends('layouts.app')

@section('title', 'Reservas')

@section('content')
@include('includes.validation-form')

<article class="flex items-center justify-center flex-col mt-8">
  <div class="flex mb-8">
    <h1 class="text-2xl font-semibold leading-tigh py-2 mr-48">Reservas:</h1>
    <form action="{{ route('reservation.index') }}" method="get" class="flex align-center ">
      @csrf
      <select name="status" class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:bg-white focus:border-unifei-500 mr-24">
        <option value="0" >Pendente</option>
        <option value="1" >Aprovado</option>
        <option value="{{request()->query('status')}}" selected>{{request()->query('status') ?? 'Status'}}</option>
      </select>
      @if ($calendars)
      <select name="calendar" class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:bg-white focus:border-unifei-500 mr-24">
        @foreach ($calendars as $calendar)
          <option value="{{$calendar->year.'.'.$calendar->period}}" >{{$calendar->year.'.'.$calendar->period}}</option>
        @endforeach
        
        <option value="{{request()->query('calendar')}}" selected>{{request()->query('calendar') ?? 'Calendario'}}</option>
      </select>
      @endif
      

      <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mr-24">Pesquisar</button>
    </form>
    <a href="{{ route('reservation.create') }}" class=" bg-green-200 rounded py-2 px-6">Adicionar Reserva</a>
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
          @if (auth()->user()->type === 'Admin')
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Aprovar
          </th>
          @endif
          @if ($notLastCalendar)
          <th
          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
        >
          Importar
        </th>
          @endif
          
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
                <p class="text-green-700">SIM</p>
              @else
                <p class="text-red-700">NÃO</p>
              @endif
              
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <a href="{{ route('reservation.see', $reservation->code) }}" class="bg-green-200 rounded-full hover:bg-green-500 py-2 px-6">Ver</a>
          </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form action="{{ route('reservation.edit', $reservation->code) }}" method="GET">
                @csrf
                <button type="submit" class="rounded-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4">Editar</button>
              </form>
            </td>
            @if (auth()->user()->type === 'Admin')
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form action="{{ route('reservation.verify', $reservation->code) }}" method="POST">
                @method('PUT')
                @csrf
                <button type="submit" class="rounded-full bg-unifei-500 hover:bg-unifei-800 text-white font-bold py-2 px-4">Aprovar</button>
              </form>
            </td>
            @endif
            @if ($notLastCalendar)
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form action="{{ route('reservation.import', $reservation->code) }}" method="POST">
                @csrf
                <button type="submit" class="rounded-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4">Importar</button>
              </form>
            </td>
            @endif
            
        </tr>
    @endforeach
    </tbody>
  </table>
  </article>


  <div class="py-4 flex items-center justify-center">
    {{$reservations->appends(['status'=> request()->get('status', ''),'calendar'=> request()->get('calendar', '')])->links()}}
  </div>

@endsection