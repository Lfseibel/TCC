<div class="flex items-center justify-center">
<div class="w-1/2 bg-white shadow-md rounded px-8 py-12">
  @csrf
  <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="type">
 
    <option value="Admin" selected> Admin </option>
    <option value="Direcao" selected> Direcao </option>
    <option value="Portaria" selected> Portaria </option>
    <option value="Comum" selected> Comum </option>
    <option value="NULL" selected>{{$reservation->user ?? old('user_name') ??'Escolha o tipo'}} </option>
</select>
  <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-unifei-500 focus:border-unifei-500 block w-full p-2.5 my-2" name="unity_code">
 
            @if ($unities)
              @foreach ($unities as $unity)
                <option value="{{ $unity->code}}" selected>{{$unity->code}} </option>
              @endforeach
            @endif
            <option value="{{ $user->unity_code ?? old('code') ?? NULL }}" selected>{{$reservation->user ?? old('user_name') ??'Escolha a Unidade'}} </option>
  </select>
  <input type="email" name="email" placeholder="E-mail:" value="{{ $user->email ?? old('email') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <input type="password" name="password" placeholder="Senha:" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline my-2">
  <button type="submit" class="w-full shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-2">
      Enviar
  </button>
</div>
</div>
  