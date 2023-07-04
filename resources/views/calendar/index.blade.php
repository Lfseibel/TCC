@extends('layouts.app')

@section('title', 'Calendarios')
@section('script')
<link href="
{{asset("./css/sweetalert.css")}}
" rel="stylesheet">
<script src="{{asset("./js/sweetalert.js")}}"></script>
<script src="{{asset("./js/calendario.js")}}"></script>
@endsection
@section('content')

<article class="flex items-center justify-center flex-col mt-8">
  <div class="flex mb-8">
    <h1 class="text-2xl font-semibold leading-tigh py-2 mr-96">Calendarios:</h1>
    <a href="{{ route('calendar.create') }}" class=" bg-green-200 rounded py-2 px-6">Adicionar Calendario</a>
  </div>
  <div class="flex flex-col">
  
  </div>
  <table class="leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Ano
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Periodo
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Data Limite
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Editar
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Deletar
          </th>
          
        </tr>
      </thead>
      <tbody>
    @foreach ($calendars as $calendar)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $calendar->year }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $calendar->period }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $calendar->limitDate }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('calendar.edit', [$calendar->year,$calendar->period]) }}" class="bg-yellow-200 rounded-full py-2 px-6">Editar</a>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <form id="{{$calendar->year}},{{$calendar->period}}" action="{{ route('calendar.destroy', [$calendar->year,$calendar->period]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="button" class="delete-button rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
              </form>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  </article>
  <div class="py-4 flex items-center justify-center">
    {{$calendars->appends(['status'=> request()->get('status', '')])->links()}}
  </div>
@endsection