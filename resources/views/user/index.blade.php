@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Usuarios:</h1>

{{auth()->user()->email}}

@foreach ($users as $user)
  <p>{{$user->email}} -- {{$user->unity_code}} <a href="{{ route('user.edit', $user->email) }}" class="bg-green-200 rounded-full py-2 px-6">Editar</a> <form action="{{ route('user.destroy', $user->email) }}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
</form></p>
@endforeach
@endsection