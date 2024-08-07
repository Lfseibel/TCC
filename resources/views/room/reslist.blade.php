@extends('layouts.app')

@section('title', 'Relatório-Sala')

@section('content')

<article class="flex items-center justify-center flex-col mt-8">
  <h1 class="mb-6">Lista de reservas na sala {{$roomCode}}:</h1>
  <table class="leading-normal shadow-md rounded-lg overflow-hidden">
  <thead>
        <tr>
          
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Materia
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Responsavel
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Deferido
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Inicio
          </th>
          <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
          >
            Fim
          </th>
         
  
          
        </tr>
      </thead>
  <tbody>
  
@foreach ($reservations as $reservation)
        <tr>
          
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $reservation->acronym }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $reservation->responsible }}
                
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              @if ($reservation->status)
                <p class="text-green-700">SIM</p>
              @else
                <p class="text-red-700">NÃO</p>
              @endif
              
            </td>       
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $reservation->startTime }}
                
            </td><td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              
              {{ $reservation->endTime }}
                
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  </article>
@endsection