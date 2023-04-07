<div class="flex items-center justify-center">
  <div class="w-1/2 bg-white shadow-md rounded px-8 py-12">
    @csrf
    <input type="text" name="year" placeholder="Ano:" value="{{ $calendar->year ?? old('year') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
    <input type="text" name="period" placeholder="Período:" value="{{ $calendar->period ?? old('period') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
    <label>Data límite das reservas:</label>
    <input type="date" name="limitDate" placeholder="Data límite:" value="{{ $calendar->limitDate ?? old('limitDate') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
    <label>Inicio do semestre:</label>
    <input type="date" name="startSemester" placeholder="Inicio do semestre:" value="{{ $calendar->startSemester ?? old('startSemester') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
    <label>Fim do semestre:</label>
    <input type="date" name="endSemester" placeholder="Fim do semestre:" value="{{ $calendar->endSemester ?? old('endSemester') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
    <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
        Enviar
    </button>
  </div>
  </div>