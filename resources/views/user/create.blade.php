@extends('layouts.app')

@section('title', 'Novo usuario')

@section('content')
<div class="flex items-center justify-center my-8">
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo Usuário</h1>
</div>
@include('includes.validation-form')

<form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('user._partials.form')
</form>
@endsection