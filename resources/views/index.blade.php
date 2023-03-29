@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<table>
  <thead>
    <tr>
      <th></th>
      @foreach ($schedulesCode as $schedule)
          
        <th>{{ $schedule->code }}</th>
      
      @endforeach
    </tr>
  </thead>
  <tbody>
    <td ></td>
    @foreach ($schedulesTimes as $schedule)  
      <td>{{ $schedule->startTime }} -- {{$schedule->endTime}}</td>
    @endforeach
  </tbody>
 
  <tbody>
    @foreach ($results as $roomCode => $schedules)
      <tr>
                <td>{{ $roomCode }}</td>
                @foreach ($schedules as $reserved)
                    <td>{!! $reserved ? 'Reservado' : '<a href="http://example.com">Link</a>' !!}</td>
                @endforeach
      </tr>
    @endforeach
    
  </tbody>
    
@endsection