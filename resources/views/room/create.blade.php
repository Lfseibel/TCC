@extends('layouts.app')

@section('title', 'Nova Sala')

@section('content')
<div class="flex items-center justify-center my-8">
<h1 class="text-2xl font-semibold leading-tigh py-2">Nova Sala</h1>
</div>
@include('includes.validation-form')

<form action="{{route('room.store')}}" method="POST" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('room._partials.form')
</form>
@endsection