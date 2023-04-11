@extends('layouts.app')

@section('title', "Editar horário {$schedule->code}")

@section('content')
<div class="flex items-center justify-center my-8">
<h1 class="text-2xl font-semibold leading-tigh py-2">Editar Horário {{$schedule->code}}</h1>
</div>
@include('includes.validation-form')

<form action="{{route('schedule.update', $schedule->code)}}" method="POST" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('schedule._partials.form')
</form>
@endsection