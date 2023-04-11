<div class="flex items-center justify-center">
<div class="w-1/2 bg-white shadow-md rounded px-8 py-12">
  @csrf
<select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="block_code">
    @if ($blocks)
      @foreach ($blocks as $block)
        <option value="{{ $block->code}}">{{$block->code}} </option>
      @endforeach
    @endif
    <option value="{{$room->block_code ?? old('block_code') ?? NULL }}" selected>{{$room->block_code ?? old('block_code') ??'Escolha o bloco'}} </option>
</select>

  <input type="text" name="code" placeholder="Código:" value="{{$room->code ?? old('code') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="text" name="capacity" placeholder="Capacidade" value="{{$room->capacity ?? old('capacity') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="text" name="reduced_capacity" placeholder="Capacidade Reduzida" value="{{ $room->reduced_capacity ?? old('reduced_capacity') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  
  <label for="unities_multiple" class="block mb-2 text-md font-medium text-gray-900 my-2">Unidades relacionadas:</label>

  <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700" aria-labelledby="dropdownSearchButton">
    @if ($unities)
      @foreach ($unities as $unity)
        @if (($unity->code=='PRG' or $unity->code=='DSG') and Route::currentRouteName() == 'room.create')
        <li>
          <div class="flex items-center p-2 rounded hover:bg-gray-100">
            <input id="{{$unity->code}}" type="checkbox" value="{{$unity->code}}" name="unities[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" checked>
            <label for="{{$unity->code}}" class="w-full ml-2 text-sm font-medium text-gray-900 rounded">{{$unity->code}}</label>
          </div>
        </li>  
        @else
        <li>
          <div class="flex items-center p-2 rounded hover:bg-gray-100">
            <input id="{{$unity->code}}" type="checkbox" value="{{$unity->code}}" name="unities[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" {{in_array($unity->code, old('unities', [])) ? 'checked' : ''}} {{ $room ? ((in_array($unity->code, $room->unities->pluck('code')->toArray())) ? 'checked' : '' ): ''}}>
            <label for="{{$unity->code}}" class="w-full ml-2 text-sm font-medium text-gray-900 rounded">{{$unity->code}}</label>
          </div>
        </li>  
        @endif
        
      @endforeach
    @endif
    
  </ul>

  <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-2">
      Enviar
  </button>
</div>
</div>
  