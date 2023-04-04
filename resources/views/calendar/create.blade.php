@extends('layouts.app')

@section('title', 'Novo calendário')

@section('content')
<div class="flex items-center justify-center my-8">
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo Calendário</h1>
</div>
@include('includes.validation-form')

<form action="{{route('calendar.store')}}" method="POST" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('calendar._partials.form')
</form>
@endsection