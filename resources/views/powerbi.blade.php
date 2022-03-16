@extends('layout')

@section('content')
<div class="container py-12">
  @if(isset($userName))
  <!-- <h4>Bienvenido {{ $userName }}!</h4> -->




  <div class="card" style="
        margin-left: -85px;
        width: fit-content;
        position: absolute;
    ">
    <div class="card-header">
      <b>Seleccionar Reporte</b>
    </div>
    <div class="card-body" style="    height: 87px;">
      <select class="form-select" style="width: max-content;" id="select">
        <option value="" disabled selected>Seleccionar reporte</option>
        @foreach($reportes_asiganados as $reporte)
        <option value="{{$reporte->url_reporte}}">{{$reporte->nombre_reporte}}</option>
        @endforeach
      </select>
    </div>
  </div>



  <div id="contenedor-reporte">
    <div id="contenedor-vista">
      <div width="1024" height="1060" style="        width: 100%;
          width: 96%;
          height: 610px;
          margin-left: 146px;">

        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">Información!</h4>
          <p>Selecciona un reporte para visualizarlo.</p>
        </div>

      </div>
      <!-- <div style="
        background-color: #e9e9ed;
        margin-top: -42px;
        width: 102%;
        height: 34px;
        z-index: 999999999;
        position: relative;
        margin-left: -1px;
        ">
    </div> -->
    </div>


  </div>
  @else
  <a href="/signin" class="btn btn-primary btn-large">Click here to sign in</a>
  @endif
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>
  $("#select").change(function() {
    $("#contenedor-vista").remove();
    $('#contenedor-reporte').html(`      <div id="contenedor-vista">
      <iframe title="PowerBi" width="1024" height="1060" src="${$("#select").val()}" frameborder="0" allowFullScreen="true" style="
          width: 96%;
          height: 610px;
          margin-left: 146px;
    
      "></iframe>

      </div>`);
  });
</script>
@endsection