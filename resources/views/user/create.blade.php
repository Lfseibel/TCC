@extends('layouts.app')

@section('title', 'Novo usuario')

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">Novo Usuário</h1>

@include('includes.validation-form')

<form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('user._partials.form')
</form>
@endsection