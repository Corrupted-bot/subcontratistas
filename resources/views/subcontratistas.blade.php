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
<style>
    .login-button:hover {
        background-color: #000000 !important;
    }
</style>
@section('content')
<div class="container-xxl mt-4">
    <div class="card">
        <div class="card-header">
            Mantenedor de Subcontratistas
        </div>
        <div class="card-body">
            <table id="subcontratistas" class="table table-striped" style="width:100%">
                <thead style="background-color: #3c8dbc !important;color: white;">
                    <tr>
                        <th>Id</th>
                        <th>Razon Social</th>
                        <th>Representante Legal</th>
                        <th>Numero de Contacto</th>
                        <th>Contacto Comerical</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Persona JeJ</th>
                        <th>Disciplina</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcontratistas as $subcontratista)
                    <tr>
                        <td>{{$subcontratista->id}}</td>
                        <td>{{$subcontratista->razon_social}}</td>
                        <td>{{$subcontratista->representante_legal}}</td>
                        <td>{{$subcontratista->numero_contacto}}</td>
                        <td>{{$subcontratista->contacto_comercial}}</td>
                        <td>{{$subcontratista->direccion}}</td>
                        <td>{{$subcontratista->correo}}</td>
                        <td>{{$subcontratista->persona_jej}}</td>
                        <td>{{$subcontratista->disciplina}}</td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-secondary me-md-2" href="/contrato/{{$subcontratista->id}}">Mostrar Contratos</a>
                                @if(count(DB::table("usuarios")->where("id_subcontratista",$subcontratista->id)->get())>0)
                                <button type="button" class="fa-solid fa-user-plus btn btn-success fa-2x" style="align-self: center;" disabled></button>
                                @else
                                <i type="button" class="fa-solid fa-user-plus btn btn-success fa-2x" style="align-self: center;" data-bs-toggle="modal" data-bs-target="#modalCrearCuenta" onclick="CambiarID({{$subcontratista->id}})"></i>
                                @endif
                            </div>
                        </td>

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
                <h5 class="modal-title" id="modalCrearSubcontratistaLabel">Agregar Subcontratista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="subcontratistas" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="razonsocial" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" id="razonsocial" name="razonsocial">
                            </div>
                            <div class="mb-3">
                                <label for="contacto" class="form-label">Número de Contacto</label>
                                <input type="tel" class="form-control" id="contacto" name="contacto">
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="mb-3">
                                <label for="personajej" class="form-label">Persona JeJ</label>
                                <input type="text" class="form-control" id="personajej" name="personajej">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="representantelegal" class="form-label">Representante Legal</label>
                                <input type="text" class="form-control" id="representantelegal" name="representantelegal">
                            </div>
                            <div class="mb-3">
                                <label for="contactocomercial" class="form-label">Contacto Comercial</label>
                                <input type="tel" class="form-control" id="contactocomercial" name="contactocomercial">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electronico</label>
                                <input type="email" class="form-control" id="correo" name="correo">
                            </div>
                            <div class="mb-3">
                                <label for="disciplina" class="form-label">Disciplina</label>
                                <input type="text" class="form-control" id="disciplina" name="disciplina">
                            </div>
                        </div>
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
<!-- Modal -->
<div class="modal fade" id="modalCrearCuenta" tabindex="-1" aria-labelledby="modalCrearCuentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearCuentaLabel">Agregar Subcontratista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="/api/add/usuario">
                @csrf
                <div class="modal-body">
                    <input id="id_subcontratista" name="id_subcontratista" hidden>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="correo_usuario" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo_usuario" name="correo_usuario">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input class="form-control" id="password" type="password" name="password" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function CambiarID(id) {
        $("#id_subcontratista").val(id)
        // console.log($("#id_subcontratista").val())
    }
</script>
@endsection