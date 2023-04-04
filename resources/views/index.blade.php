@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<table class="mx-auto leading-normal shadow-md rounded-lg overflow-scroll mt-4">
  <thead>
    <tr>
      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-900 uppercase tracking-wider"></th>
      {{-- lg:px-2 --}}
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
                      <a href="{{route('reservation.create', ['startTime' => $schedules[$key]->startTime, 'endTime' => $schedules[$key]->endTime,'room_code'=>$roomCode]) }}">---</a>
                      @endif
                      </td>
                    {{-- ? 'Reservado' : '<a href="http://example.com">---</a>' --}}
                @endforeach
      </tr>
    @endforeach
    
  </tbody>
</table>
@endsection