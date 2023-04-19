@extends('layouts.app')

@section('script')
<script src="{{asset("./js/reservation.js")}}"></script>
@endsection

@section('title', 'Nova reserva')

@section('content')
<div class="flex items-center justify-center my-8">
<h1 class="text-2xl font-semibold leading-tigh py-2">Nova Reserva</h1>
</div>
@include('includes.validation-form')

<form action="{{route('reservation.store')}}" method="POST" enctype="multipart/form-data"> 
  {{-- enctype é pra upload de arquivos funcionar --}}
  @include('reservation._partials.form')
</form>
@endsection