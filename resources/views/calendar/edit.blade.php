@extends('layouts.app')

@section('title', "Editar o Calendario {$calendar->year} - {$calendar->period}")

@section('content')
<div class="flex items-center justify-center my-8">
  <h1 class="text-2xl font-semibold leading-tigh py-2">Editar o Calendario {{$calendar->year}} - {{$calendar->period}}</h1>
</div>
@include('includes.validation-form')

<form action="{{ route('calendar.update', [$calendar->year,$calendar->period]) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('calendar._partials.form')
</form>

@endsection