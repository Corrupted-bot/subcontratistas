@extends('layout')

@section('content')
<div class="jumbotron mt-4" >
  <h1>Innovación & Desarrollo</h1>
  @if(isset($userName))
    <h4>Bienvenido {{ $userName }}!</h4>
  @else
    <a href="/signin" class="btn btn-primary btn-large">Click para Iniciar Sesión </a>
  @endif
</div>
@endsection