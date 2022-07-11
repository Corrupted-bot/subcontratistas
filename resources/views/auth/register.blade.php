@extends('layout')


<?php

use App\Models\Subcontratista;

 $subcontratista = Subcontratista::find($_GET['subcontratista']);?>
@section('content')
<style>
    .login-button:hover {
        background-color: #000000 !important;
    }
</style>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header" style="text-align:center">
                    <b>Registrar Usuarios Externos</b>
                </div>
                <div class="card-body">
                    <form method="POST" action="/api/add/usuario">
                    @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input class="form-control" id="password" type="password" name="password" />
                        </div>
                        <button class="btn btn-primary btn-block login-button" style="background-color: #007da9;border-color: #000000;" type="submit"> Registrar <i class="fa fa-sign-in"></i></button>
                    </form>
                </div>
                @if(Session::has('message'))
                <div id="alerta" style="display:flex;justify-content: center;">
                    <div class="alert alert-success mt-2 mb-2" style="width: max-width; text-align: center;">
                        {{ Session::get('message') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection