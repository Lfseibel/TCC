@extends('layouts.app')

@section('title', "Editar o Bloco {$block->code}")

@section('content')
<div class="flex items-center justify-center my-8">
  <h1 class="text-2xl font-semibold leading-tigh py-2">Editar o Bloco -- {{$block->code}}</h1>
</div>
@include('includes.validation-form')

<form action="{{ route('block.update', $block->code) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('block._partials.form')
</form>

@endsection