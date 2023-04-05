<div class="flex items-center justify-center">
<div class="w-1/2 bg-white shadow-md rounded px-8 py-12">
  @csrf
  <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="room_code">
    @if ($rooms)
      @foreach ($rooms as $room)
        <option value="{{ $room->code}}">{{$room->code}} </option>
      @endforeach
    @endif
    <option value="{{ $room->unity_code ?? old('room_code') ?? NULL }}" selected>{{$reservation->room_code ?? old('room_code') ?? $room_code ??'Escolha a Sala'}} </option>
</select>
<select  name="times" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2">
  <option value="Uma">Uma</option>
  <option value="Semanal">Semanal</option>
  <option value="Quinzenal">Quinzenal</option>
  <option value="{{ old('times') ?? NULL }}" selected>{{ old('times') ??'Escolha a quantidade de vezes'}} </option>
</select>
<select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="weekday">
  <option value="Segunda-Feira">Segunda-Feira</option>
  <option value="Terca-Feira">Terca-Feira</option>
  <option value="Quarta-Feira">Quarta-Feira</option>
  <option value="Quinta-Feira">Quinta-Feira</option>
  <option value="Sexta-Feira">Sexta-Feira</option>
  <option value="Sabado">Sabado</option>
  <option value="Domingo">Domingo</option>
  <option value="{{ old('weekday') ?? NULL }}" selected>{{ old('weekday') ?? 'Escolha o dia da semana '}} </option>
</select>
  <input type="text" name="acronym" placeholder="Sigla:" value="{{ $reservation->acronym ?? old('acronym') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="text" name="class" placeholder="Turma:" value="{{ $reservation->class ?? old('class') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <textarea rows="1" name="description" class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" placeholder="Descrição">{{ $reservation->description ?? old('description') }}</textarea>
  <textarea rows="1" name="observation" class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2 mt-4" placeholder="Observação">{{ $reservation->observation ?? old('observation') }}</textarea>
  <input type="text" name="responsible" placeholder="Responsável:" value="{{ $reservation->responsible ?? old('responsible') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  
  <input type="date" name="startDate" placeholder="Data começo:" value="{{ $reservation->startTime ?? old('startTime') ?? $startTime}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="date" name="endDate" placeholder="Data fim:" value="{{ $reservation->endTime ?? old('endTime') ?? $endTime }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="time" name="startTime" placeholder="Horario começo:" value="{{ $reservation->startTime ?? old('startTime') ?? $startTime}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="time" name="endTime" placeholder="Horario fim:" value="{{ $reservation->endTime ?? old('endTime') ?? $endTime }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  
  <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-2">
      Enviar
  </button>
</div>
</div>
  