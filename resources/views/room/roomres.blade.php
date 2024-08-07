@extends('layouts.app')

@section('title', 'Aulas-Semana')

@section('content')
<div class="flex items-center justify-center my-8">
  <h1 class="text-2xl font-semibold leading-tigh py-2">Sala: {{$roomCode}}</h1>
</div>
<table class="mx-auto leading-normal shadow-md rounded-lg overflow-scroll mt-4">
  <thead>
    
    <tr class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-900 uppercase tracking-wider">
    <th colspan="{{20}}" class="py-3">Turmas da Semana </th> 
    </tr>
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
    @for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++)
      <tr>
                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm border-r-4">{{ $dias[$dayOfWeek] }}</td>
                <?php $counter = 0; ?>
                    @foreach ($results[$dayOfWeek] as $reservation)
                        
                        <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if ($reservation && $reservation['reserved'] == 2 && $reservation['acronym'])
                            <a href="{{route('reservation.see', $reservation['code']) }}">{{ $reservation['acronym'] }}.{{ $reservation['class'] }}</a>
                            @else
                            <a href="{{route('reservation.create', ['startTime' => $schedulesTimes[$counter]->startTime, 'endTime' => $schedulesTimes[$counter]->endTime,'room_code'=>$roomCode,'weekday' => ($dayOfWeek >= 1 && $dayOfWeek <= 5) ? $dias[$dayOfWeek] . '-Feira' : $dias[$dayOfWeek]]) }}">---</a>
                            @endif
                        </td>
                        <?php $counter++; ?>
                    @endforeach
                
      </tr>
    @endfor
    
  </tbody>
</table>
<footer class="flex items-center justify-center my-8"><a href="{{route('room.report',  $roomCode) }}" class="bg-green-200 rounded-full hover:bg-green-500 py-2 px-6">Relatório de Reservas</a></footer>

@endsection