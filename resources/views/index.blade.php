@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<table class="mx-auto leading-normal shadow-md rounded-lg overflow-hidden mt-4">
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
    @foreach ($results as $roomCode => $schedules)
      <tr>
                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm border-r-4">{{ $roomCode }}</td>
                @foreach ($schedules as $reserved)
                    <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">{!! $reserved ? 'Reservado' : '<a href="http://example.com">---</a>' !!}</td>
                @endforeach
      </tr>
    @endforeach
    
  </tbody>
</table>
@endsection