@extends('layout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('content')
<div class="container" style="
    /* text-align: center; */
    display: flex;
    justify-content: center;
">
    <div class="card" style="width: 500px;">
        <h5 class="card-header" style="text-align: center">Agregar Reporte</h5>
        <div class="card-body">
            <div class="row lign-items-center">
                <form method="post" action="/api/add/reporte">
                @csrf
                    <div class="col">
                        <div class="mb-3">
                            <label for="NombreReporte" class="form-label">Nombre del Reporte</label>
                            <input type="text" class="form-control" id="NombreReporte" name="NombreReporte">
                        </div>
                        <div class="mb-3">
                            <label for="LinkReporte" class="form-label">Link del Reporte</label>
                            <input type="text" class="form-control" id="LinkReporte" name="LinkReporte">
                        </div>
                        <div style="display: flex;justify-content: flex-start;"><i class="fa-solid fa-circle-info fa-2x" type="button" id="boton-info" onclick="AbrirModal()" data-bs-toggle="tooltip" data-bs-placement="top" title="¿Como obtener el Link?"></i></div>
                        <div class="mb-3" style="text-align: center;">
                            <button type="submit" style="max-width: max-content;" class="btn btn-success btn-lg btn-block" id="botonEnviar">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
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
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModalExito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pasos para obtener el Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function AbrirModal() {
        $('#myModalExito').modal('show');
    }
</script>

@endsection