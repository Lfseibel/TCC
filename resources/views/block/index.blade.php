@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')


{{auth()->user()->email}}
<article class="flex items-center justify-center flex-col">
<div class="flex mb-8">
  <h1 class="text-2xl font-semibold leading-tigh py-2 mr-48">Usuarios:</h1>
  <a href="{{ route('block.create') }}" class=" bg-green-200 rounded-full py-2 px-6">Adicionar Usuario</a>
</div>
<div class="flex flex-col">
@foreach ($blocks as $block)
  <div class="flex">
    <p>{{$block->email}} -- {{$user->unity_code}} </p><a href="{{ route('user.edit', $user->email) }}" class="bg-yellow-500 rounded-full py-2 px-6">Editar</a> 
      <form action="{{ route('user.destroy', $user->email) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
      </form>
  </div>
@endforeach
</div>
</article>

@endsection