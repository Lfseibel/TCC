<div class="flex items-center justify-center">
<div class="w-1/2 bg-white shadow-md rounded px-8 py-12">
  @csrf
<select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="block_code">
    @if ($blocks)
      @foreach ($blocks as $block)
        <option value="{{ $block->code}}">{{$block->code}} </option>
      @endforeach
    @endif
    <option value="{{ old('block_code') ?? NULL }}" selected>{{old('block_code') ??'Escolha o bloco'}} </option>
</select>

  <input type="text" name="code" placeholder="Código:" value="{{ old('code') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="text" name="capacity" placeholder="Capacidade" value="{{ old('capacity') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="text" name="reduced_capacity" placeholder="Capacidade Reduzida" value="{{ old('reduced_capacity') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  
  <label for="unities_multiple" class="block mb-2 text-md font-medium text-gray-900 my-2">Unidades relacionadas:</label>
  <select name="unities[]" id="unities_multiple" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2" multiple>
    @if ($unities)
      @foreach ($unities as $unity)
        <option value="{{ $unity->code }}" >{{$unity->code}} </option>
      @endforeach
    @endif
    
  </select>

  <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-2">
      Enviar
  </button>
</div>
</div>
  