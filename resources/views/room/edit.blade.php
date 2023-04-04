@extends('layouts.app')

@section('title', "Editar a Sala {$room->code}")

@section('content')
<div class="flex items-center justify-center my-8">
  <h1 class="text-2xl font-semibold leading-tigh py-2">Editar a Sala - {{$room->code}}</h1>
</div>
@include('includes.validation-form')

<form action="{{ route('room.update', [$room->code]) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('room._partials.form')
</form>

@endsection