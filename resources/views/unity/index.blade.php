@extends('layouts.app')

@section('title', 'Unidades')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Unidades:</h1>

@foreach ($unities as $unity)
  <p>{{$unity->code}} -- {{$unity->name}} <a href="{{ route('unity.edit', $unity->code) }}" class="bg-green-200 rounded-full py-2 px-6">Editar</a> <form action="{{ route('unity.destroy', $unity->code) }}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
</form></p>
@endforeach
@endsection