@extends('layouts.app')

@section('title', "Editar a Reserva")

@section('content')
<div class="flex items-center justify-center my-8">
  <h1 class="text-2xl font-semibold leading-tigh py-2">Editar a Reserva</h1>
</div>
@include('includes.validation-form')

<form action="{{ route('reservation.update', [$reservation->code]) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('reservation._partials.form')
</form>

@endsection