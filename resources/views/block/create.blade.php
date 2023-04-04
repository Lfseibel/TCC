@extends('layouts.app')

@section('title', 'Novo bloco')

@section('content')
<div class="flex items-center justify-center my-8">
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo Bloco</h1>
</div>
@include('includes.validation-form')

<form action="{{route('block.store')}}" method="POST" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('block._partials.form')
</form>
@endsection