@extends('layouts.app')

@section('title', 'Editar Unidade')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Editar Unidade {{ $unity->code }}</h1>

@include('includes.validation-form')

<form action="{{route('unity.update', $unity->code)}}" method="post" enctype="multipart/form-data"> 
  @method('PUT')
  @include('unity._partials.edit-form')
</form>
@endsection