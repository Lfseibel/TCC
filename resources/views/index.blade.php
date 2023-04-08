@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<form action="{{ route('index') }}" method="get" class="flex align-center justify-around my-4">
  <input type="date" name="date" placeholder="Date" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-unifei-500">
  <select class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:bg-white focus:border-unifei-500" name="block">
    @if ($blocks)
      @foreach ($blocks as $block)
        <option value="{{ $block->code}}">{{$block->code}} </option>
      @endforeach
    @endif
    <option value="" selected>Bloco</option>
  </select>
  <select class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:bg-white focus:border-unifei-500" name="unity">
    @if ($unities)
      @foreach ($unities as $unity)
        @if ($unity->code!='PRG' and $unity->code!='DSG')
          <option value="{{ $unity->code}}">{{$unity->code}} </option>
        @endif
      @endforeach
    @endif
    <option value="" selected>Unidade</option>
  </select>
  <input type="text" name="teste" placeholder="Teste" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-unifei-500">
  <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Pesquisar</button>
</form>

<table class="mx-auto leading-normal shadow-md rounded-lg overflow-scroll mt-4">
  <thead>
    <tr>
      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-900 uppercase tracking-wider"></th>
      @foreach ($schedulesCode as $schedule)
          
        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-900 uppercase tracking-wider">{{ $schedule }}</th>
      
      @endforeach
      
    </tr>
  </thead>
  <tbody>
    <td class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider"></td>
    @foreach ($schedulesTimes as $schedule)  
      <td class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-900 uppercase tracking-wider">{{ $schedule->startTime }}-{{$schedule->endTime}}</td>
    @endforeach
  </tbody>
 
  <tbody>
    @foreach ($results as $roomCode => $reserved)
      <tr>
                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm border-r-4">{{ $roomCode }}</td>
                @foreach ($reserved as $key => $reservation)
                    <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                      @if ($reservation && $reservation['reserved']==2)
                      <a href="{{route('reservation.see', $reservation['code']) }}">Reservado</a>
                      @elseif ($reservation && $reservation['reserved']==1)
                      <a href="{{route('reservation.see', $reservation['code']) }}">Solicitado</a>
                      @else
                      <a href="{{route('reservation.create', ['startTime' => $schedules[$key]->startTime, 'endTime' => $schedules[$key]->endTime,'room_code'=>$roomCode,'startDate' => request()->query('date')]) }}">---</a>
                      @endif
                      </td>
                    {{-- ? 'Reservado' : '<a href="http://example.com">---</a>' --}}
                @endforeach
      </tr>
    @endforeach
    
  </tbody>
</table>

<div class="py-4 flex items-center justify-center">
  {{ $rooms->appends(['unity'=> request()->get('unity', ''), 'date'=> request()->get('date', ''), 'block'=> request()->get('block', '')])->links() }}
</div>
@endsection