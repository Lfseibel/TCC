@extends('layouts.app')

@section('title', "Editar o Usuário {$user->email}")

@section('content')
<div class="flex items-center justify-center my-8">
    <h1 class="text-2xl font-semibold leading-tigh py-2">Editar o Usuário -- {{$user->email}}</h1>
</div>
@include('includes.validation-form')

<form action="{{ route('user.update', $user->email) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('user._partials.form')
</form>

@endsection