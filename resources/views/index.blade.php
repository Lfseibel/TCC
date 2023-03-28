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
    @foreach ($rooms as $room)
    <td>{{$room->code}}</td>
    <td>{{$room->reservations}}</td>
    @endforeach
    
    <td>Reservado</td>
    <td>aaa</td>
    <td>aaa</td>
    <td>aaa</td>
    <td>aaa</td>
    <td>aaa</td>
  </tbody>
    
@endsection