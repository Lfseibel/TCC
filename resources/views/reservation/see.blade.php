@extends('layouts.app')

@section('title', 'Visualizar reserva ')

@section('script')
<link href="
{{asset("./css/sweetalert.css")}}
" rel="stylesheet">
<script src="{{asset("./js/sweetalert.js")}}"></script>
<script src="{{asset("./js/reservation.js")}}"></script>
@endsection

@section('content')
@include('includes.validation-form')
<div class="flex items-center justify-center my-8">
  <h1 class="text-2xl font-semibold leading-tigh py-2">Visualizar reserva</h1>
</div>

<div class="flex items-center justify-center">
  <div class="w-1/2 bg-white shadow-md rounded px-8 py-12">
    
  <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="room_code" disabled>
    <option value="{{ $reservation->room_code }}" selected>{{$reservation->room_code}} </option>
  </select>

  <input type="text" name="acronym" placeholder="Sigla:" value="{{ $reservation->acronym }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" disabled>
  <input type="text" name="class" placeholder="Turma:" value="{{ $reservation->class }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" disabled>
    <textarea rows="1" name="description" class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" placeholder="Descrição" disabled>{{ $reservation->description }}</textarea>
    <textarea rows="1" name="observation" class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2 mt-4" placeholder="Observação" disabled>{{ $reservation->observation }}</textarea>
    <input type="text" name="responsible" placeholder="Responsável:" value="{{ $reservation->responsible }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" disabled>
    <label>Hora de começo</label>
    <input type="time" name="startTime" placeholder="Horario começo:" value="{{ $reservation->startTime }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" disabled>
    <label>Hora de fim</label>
    <input type="time" name="endTime" placeholder="Horario fim:" value="{{ $reservation->endTime }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" disabled>
    
    
    @if ($dates)
    <h2>Dias reservados:</h2>
    @foreach ($dates as $date)
    <div class="flex items-center ">
    <input type="date" value="{{ $date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" disabled>
    @if (auth()->user()->type === 'Admin')
    <form id="{{$date}}" action="{{ route('reservationdate.destroy', [$reservation->code,$date]) }}" method="POST">
      @method('DELETE')
      @csrf
      <button type="button" onclick="submitDeleteReserveDate('{{$date}}')" class="rounded-full bg-red-500 hover:bg-red-700 text-white "><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      </button>
    </form>
    @endif
    
  </div>
  @endforeach
  @else
  <h2>Nenhum dia reservado</h2>
    @endif
   

    @if (auth()->user()->type === 'Admin' && !$reservation->status)
      <form action="{{ route('reservation.verify', $reservation->code) }}" method="POST">
        @method('PUT')
        @csrf
        <button type="submit" class="w-full rounded-full bg-unifei-500 hover:bg-unifei-800 text-white font-bold mt-4 py-2 px-4">Aprovar</button>
      </form>
    @endif
    @if ($reservation->user_email == auth()->user()->email or auth()->user()->type === 'Admin')
      <form id="{{$reservation->code}}" action="{{ route('reservation.destroy', $reservation->code) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="button" onclick="submitDeleteReservation('{{$reservation->code}}')" class="w-full rounded-full bg-red-500 hover:bg-red-700 text-white font-bold  mt-8 py-2 px-4">Deletar</button>
      </form>
    @endif
    

    
  </div>
  </div>
@endsection