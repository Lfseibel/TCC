<div class="flex items-center justify-center">
<div class="w-1/2 bg-white shadow-md rounded px-8 py-12">
  @csrf
  <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="room_code">
    @if ($rooms)
      @foreach ($rooms as $room)
        <option value="{{ $room->code}}">{{$room->code}} </option>
      @endforeach
    @endif
    <option value="{{ old('room_code') ?? $reservation->room_code ?? $room_code ?? NULL }}" selected>{{old('room_code') ?? $reservation->room_code ?? $room_code ??'Escolha a Sala'}} </option>
  </select>
<select  name="frequency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2">
  <option value="Uma">Uma</option>
  <option value="Semanal">Semanal</option>
  <option value="Quinzenal">Quinzenal</option>
  <option value="{{ old('frequency') ?? $reservation->frequency ?? NULL }}" selected>{{ old('frequency') ?? $reservation->frequency ??'Escolha a quantidade de vezes'}} </option>
</select>

<select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="weekday">
  <option value="Segunda-Feira">Segunda-Feira</option>
  <option value="Terca-Feira">Terca-Feira</option>
  <option value="Quarta-Feira">Quarta-Feira</option>
  <option value="Quinta-Feira">Quinta-Feira</option>
  <option value="Sexta-Feira">Sexta-Feira</option>
  <option value="Sabado">Sabado</option>
  <option value="Domingo">Domingo</option>
  <option value="{{ old('weekday') ?? $reservation->weekday ?? NULL }}" selected>{{ old('weekday') ?? $reservation->weekday ??'Escolha o dia da semana'}} </option>
</select>
  <input type="text" name="acronym" placeholder="Sigla:" value="{{ old('acronym') ?? $reservation->acronym ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="text" name="class" placeholder="Turma:" value="{{ old('class') ?? $reservation->class ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <textarea rows="1" name="description" class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" placeholder="Descrição">{{ old('description') ?? $reservation->description ?? NULL }}</textarea>
  <textarea rows="1" name="observation" class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2 mt-4" placeholder="Observação">{{old('observation') ?? $reservation->observation ?? NULL}}</textarea>
  <input type="text" name="responsible" placeholder="Responsável:" value="{{  old('responsible') ?? $reservation->responsible ?? NULL }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <label>Data de início</label>
  <input type="date" name="startDate" placeholder="Data começo:" value="{{ old('startDate') ?? $reservation->startDate ?? $startDate ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <label>Data de fim</label>
  <input type="date" name="endDate" placeholder="Data fim:" value="{{ old('endDate') ?? $reservation->endDate ?? $endSemester ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <label>Hora de começo</label>
  <input type="time" name="startTime" placeholder="Horario começo:" value="{{ old('startTime') ?? $reservation->startTime ?? $startTime ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <label>Hora de fim</label>
  <input type="time" name="endTime" placeholder="Horario fim:" value="{{ old('endTime') ?? $reservation->endTime ?? $endTime ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  
  <button type="submit" onclick="teste()" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-2">
      Enviar
  </button>

  {{-- <select id="mySelect" onchange="showInputs()">
    
    <option value="option1">1</option>
    <option value="option2">2</option>
    <option value="option3">3</option>
    <option value="" selected>Quantidade de dias</option>
  </select> --}}

  {{-- <div id="inputs">
    <div id="input1" style="display: none;"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="weekday">
      <option value="Segunda-Feira">Segunda-Feira</option>
      <option value="Terca-Feira">Terca-Feira</option>
      <option value="Quarta-Feira">Quarta-Feira</option>
      <option value="Quinta-Feira">Quinta-Feira</option>
      <option value="Sexta-Feira">Sexta-Feira</option>
      <option value="Sabado">Sabado</option>
      <option value="Domingo">Domingo</option>
      <option value="{{ old('weekday') ?? NULL }}" selected>{{ old('weekday') ??'Escolha o dia da semana'}} </option>
    </select>
    <label>Hora de começo</label>
  <input type="time" name="startTime" placeholder="Horario começo:" value="{{ old('startTime') ?? $reservation->startTime ?? $startTime ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <label>Hora de fim</label>
  <input type="time" name="endTime" placeholder="Horario fim:" value="{{ old('endTime') ?? $reservation->endTime ?? $endTime ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  
  </div>
    <div id="input2" style="display: none;"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="weekday">
      <option value="Segunda-Feira">Segunda-Feira</option>
      <option value="Terca-Feira">Terca-Feira</option>
      <option value="Quarta-Feira">Quarta-Feira</option>
      <option value="Quinta-Feira">Quinta-Feira</option>
      <option value="Sexta-Feira">Sexta-Feira</option>
      <option value="Sabado">Sabado</option>
      <option value="Domingo">Domingo</option>
      <option value="{{ old('weekday') ?? NULL }}" selected>{{ old('weekday') ??'Escolha o dia da semana'}} </option>
    </select>
    <label>Hora de começo</label>
  <input type="time" name="startTime" placeholder="Horario começo:" value="{{ old('startTime') ?? $reservation->startTime ?? $startTime ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <label>Hora de fim</label>
  <input type="time" name="endTime" placeholder="Horario fim:" value="{{ old('endTime') ?? $reservation->endTime ?? $endTime ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  
  </div>
    <div id="input3" style="display: none;"><select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="weekday">
      <option value="Segunda-Feira">Segunda-Feira</option>
      <option value="Terca-Feira">Terca-Feira</option>
      <option value="Quarta-Feira">Quarta-Feira</option>
      <option value="Quinta-Feira">Quinta-Feira</option>
      <option value="Sexta-Feira">Sexta-Feira</option>
      <option value="Sabado">Sabado</option>
      <option value="Domingo">Domingo</option>
      <option value="{{ old('weekday') ?? NULL }}" selected>{{ old('weekday') ??'Escolha o dia da semana'}} </option>
    </select>
    <label>Hora de começo</label>
    <input type="time" name="startTime" placeholder="Horario começo:" value="{{ old('startTime') ?? $reservation->startTime ?? $startTime ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
    <label>Hora de fim</label>
    <input type="time" name="endTime" placeholder="Horario fim:" value="{{ old('endTime') ?? $reservation->endTime ?? $endTime ?? NULL}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
    </div>
  </div> --}}
</div>
</div>
  