@extends('layouts.app')

@section('title', 'Nova Unidade')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Nova Unidade</h1>

@include('includes.validation-form')

<form action="{{route('unity.store')}}" method="post"> 
  @include('unity._partials.form')
</form>
@endsection