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

    .ldld.default:before,
    .ldld.full:before,
    .ldld.ldbtn:before,
    .ldld.bare:before {
        content: " ";
        display: block;
        background: 0;
        animation: ldld-default .5s ease-in-out infinite;
        border-radius: 50%;
        width: 100%;
        height: 100%;
        margin: 0;
        box-sizing: border-box;
        border: 2px solid #3282af !important;
        border-color: #3282af transparent #3282af transparent !important;
    }

    .ldld.default {
        position: absolute;
        z-index: 1;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70px !important;
        height: 80px !important;

    }

    .text-bg-warning {
        color: #000 !important;
        background-color: RGBA(255, 193, 7, var(--bs-bg-opacity, 1)) !important;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.css">
<script src="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.js"></script>
@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-4">
            <div class="card shadow-lg p-3 mb-5 bg-body rounded" style="height: 50rem;">
                <div class="card-header">
                    Contratos de <b>{{ $subcontratista->razon_social }}</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="contratosExternos" class="table table-striped " style="width:100%">
                            <thead style="background-color: #3c8dbc !important;color: white;">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contratos as $contrato)
                                <tr>
                                    <td>{{ $contrato->id }}</td>
                                    <td>{{ $contrato->nombre }}</td>
                                    <td><button type="button" class="btn btn-info" onclick="CargarEstadoPago({{ $contrato->id }},'{{ $contrato->nombre }}')">Estados
                                            de Pago <i class="fa-solid fa-file-lines"></i></button></td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-8">
            <div class="ldld default"></div>

            <div class="card shadow-lg p-3 mb-5 bg-body rounded" style="height: 50rem;" id="tarjetaEstado">
                <div class="card-header" id="tituloEstado">
                    <span id="estadotitulospan" style="visibility: hidden">Estados de Pago del contrato: </span>
                    <span id="titulospan" class="font-weight-bold"></span>
                </div>
                <div class="card-body" id="bodyEstado">
                    <div style="display: flex;justify-content: center;" id="cartaInformacion">
                        <div class="alert alert-warning" role="alert" style="width: -webkit-fill-available;text-align: center;">
                            <h4 class="alert-heading">Información <i class="fa-solid fa-circle-info"></i></h4>
                            <p>Para visualizar los estados de pago es necesario seleccionar un contrato.</p>
                            <hr>
                        </div>
                    </div>
                    <div id="tablaContenedor" style="visibility: hidden">
                        <table id="solicitudes" class="table  table-striped" style="width:100%;">
                            <thead style="background-color: #3c8dbc !important;color: white;">
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Cierre</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal CREAR CONTACTO -->
<div class="modal fade" id="modalCrearContrato" tabindex="-1" aria-labelledby="modalCrearContratoLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearContratoLabel">Agregar Contrato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/contrato" method="POST">
                @csrf
                <div class="modal-body">
                    <input id="id_subcontratista" name="id_subcontratista" value="{{ $subcontratista->id }}" hidden>
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

{{-- MODAL CREAR SOLICITUD --}}
<div class="modal fade" id="modalsolicitud" tabindex="-1" aria-labelledby="modalsolicitudLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalsolicitudLabel">Crear solicitud de estado de pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/solicitudes" id="crearSolicitud">
                <input id="id_contrato" name="id_contrato" value="" hidden>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_cierre">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_cierre" class="form-label">Fecha de Cierre</label>
                        <input type="date" class="form-control" id="fecha_cierre" name="fecha_cierre">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL DE ARCHIVOS --}}
<div class="modal fade" id="archivosModal" tabindex="-1" aria-labelledby="archivosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archivosModalLabel">Archivos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="archivosTabla" class="table table-striped table-bordered" style="width:100%;">
                    <thead style="background-color: #053f60 !important;color: white;">
                        <tr>
                            <th>Id</th>
                            <th>Nombre del Archivo</th>
                            <th>Estado</th>
                            <th>Herramientas</th>
                            <th>Subir Archivo</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center">
                        <tr>
                            <td>1</td>
                            <td>Listado de trabajadores</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Contrato de trabajadores</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Cert. de Insp. Del Trabajo F30-1</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Cert. de Insp. Del Trabajo F30</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Liquidaciones firmadas</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Suma libro asistencia</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Pagos previsionales</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Finiquitos</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Libro de Asistencia (fotocopia)</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Libro de Remuneraciones</td>
                            <td><span class="badge rounded-pill text-bg-warning">Pendiente</span></td>
                            <td>
                                <i type="button" class="fa-solid fa-download fa-1x btn btn-secondary"></i>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="file" id="formFile">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" >Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        $('#contratosExternos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
            },
            "lengthChange": false,
            "lengthMenu": [
                [7],
                [7]
            ],
            "paging": false,
            dom: 'Bfrtip',
            buttons: []

        });
        $("#crearSolicitud").submit(function(event) {
            var token = '{{ csrf_token() }}';
            var data = {
                id_contrato: $("#id_contrato").val(),
                fecha_inicio: $("#fecha_inicio").val(),
                fecha_cierre: $("#fecha_cierre").val(),
                _token: token
            };
            $.ajax({
                type: "post",
                url: "/solicitudes",
                data: data,
                success: function(msg) {
                    console.log(msg);
                    Actualizar();
                    // console.log(msg);
                    // window.location.replace("/");
                }
            });
            event.preventDefault();
            $("#fecha_cierre").val("");
            $("#fecha_inicio").val("");
            $('#modalsolicitud').modal('hide');
        });
    });

    function CargarEstadoPago(id, nombre) {

        console.log(nombre);
        $("#id_contrato").val(id);
        $("#solicitudes").dataTable().fnDestroy();
        (new ldLoader({
            root: ".ldld.default"
        })).on();
        $("#tarjetaEstado").addClass("placeholder");
        $("#tituloEstado").addClass("placeholder");
        $("#bodyEstado").addClass("placeholder");
        $("#cartaInformacion").css("display", "none");
        $("#titulospan").text(nombre);
        $("#tablaContenedor").css("visibility", "visible");
        //GENERAR TABLA DE DATOS
        $('#solicitudes').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
            },
            "lengthChange": false,
            "ajax": `/solicitudes/${id}`,
            "paging": false,
            scrollY: '40rem',
            scrollCollapse: true,
            dom: 'Bfrtip',
            columnDefs: [{
                    width: 30,
                    targets: 0,
                    "className": "text-center",
                },
                {
                    width: 200,
                    targets: 4,
                    "className": "text-center",
                }
            ],
            buttons: [],
            "columns": [{
                    "data": "id",
                }, {
                    "data": null,
                    render: function(data, type, row, meta) {
                        // console.log(data.revocado)
                        var d = new Date(data.fecha_inicio);
                        var datestring = (d.getDate() + 1) + "-" + (d.getMonth() + 1) + "-" + d
                            .getFullYear();

                        return data.fecha_inicio;

                    }
                }, {
                    "data": null,
                    render: function(data, type, row, meta) {
                        // console.log(data.revocado)
                        var d = new Date(data.fecha_cierre);
                        var datestring = (d.getDate() + 1) + "-" + (d.getMonth() + 1) + "-" + d
                            .getFullYear();
                        return data.fecha_cierre;

                    }
                }, {
                    "data": null,
                    render: function(data, type, row, meta) {
                        // console.log(data.revocado)
                        if (data.estado == 0) {
                            return type === 'display' ?
                                `<span class="badge rounded-pill text-bg-warning">En Proceso</span>` :
                                data;
                        }

                    }
                },
                {
                    "data": null,
                    render: function(data, type, row, meta) {

                        return type === 'display' ?
                            `<button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#archivosModal">Archivos <i class="fa-solid fa-folder"></i></button>` :
                            data;


                    }
                }
            ],
        });

        setTimeout(() => {

            (new ldLoader({
                root: ".ldld.default"
            })).off();
            $("#estadotitulospan").css("visibility", "visible");
            $("#tarjetaEstado").removeClass("placeholder");
            $("#tituloEstado").removeClass("placeholder");
            $("#bodyEstado").removeClass("placeholder");
            $("#solicitudes").css("visibility", "visible");
        }, 2000);

    }

    function Actualizar() {
        $('#solicitudes').DataTable().ajax.reload();
    }
</script>
@endsection