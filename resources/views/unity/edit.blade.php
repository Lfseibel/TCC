@extends('layouts.app')

@section('title', "Editar Unidade {$unity->code}")

@section('content')
<div class="flex items-center justify-center my-8">
  <h1 class="text-2xl font-semibold leading-tigh py-2">Editar Unidade {{$unity->code}}</h1>
</div>
@include('includes.validation-form')

<form action="{{route('unity.update', $unity->code)}}" method="post" enctype="multipart/form-data"> 
  @method('PUT')
  @include('unity._partials.form')
</form>
@endsection