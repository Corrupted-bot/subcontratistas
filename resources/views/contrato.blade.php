@extends('layout')
<style>
    .modal-header .btn-close {
        padding: 0.5rem 0.5rem;
        margin: -0.5rem -0.5rem -0.5rem auto;
        background-color: white;
    }

    .modal-header {
        background-color: #3c8dbc !important;
        color: white;
    }
</style>
@section('content')
<div class="container-xxl mt-4">
    <div class="card">
        <div class="card-header">
            Contratos de {{$subcontratista->razon_social}}
        </div>
        <div class="card-body">
            <table id="contratos" class="table table-striped" style="width:100%">
                <thead style="background-color: #3c8dbc !important;color: white;">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contratos as $contrato)
                    <tr>
                        <td>{{$contrato->id}}</td>
                        <td>{{$contrato->nombre}}</td>
                        <td><a class="btn btn-secondary" href="/contratos/{{$subcontratista->id}}">Mostrar Contratos</a></td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCrearSubcontratista" tabindex="-1" aria-labelledby="modalCrearSubcontratistaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearSubcontratistaLabel">Agregar Contrato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/contrato" method="POST">
                @csrf
                <div class="modal-body">
                    <input id="id_subcontratista" name="id_subcontratista" value="{{$subcontratista->id}}" hidden>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection