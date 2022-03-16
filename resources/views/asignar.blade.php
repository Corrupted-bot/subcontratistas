@extends('layout')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.2/bootstrap-duallistbox.css" integrity="sha512-8TCY/k+p0PQ/9+htlHFRy3AVINVaFKKAxZADSPH3GSu3UWo2eTv9FML0hJZrvNQbATtPM4fAw3IS31Yywn91ig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css">



<style>
  .select2-results__option--highlighted {
    background-color: #007da9 !important;
  }

  .select2-selection__rendered {
    line-height: 31px !important;
  }

  .select2-container .select2-selection--single {
    height: 35px !important;
  }

  .select2-selection__arrow {
    height: 34px !important;
  }

  .estilos {
    background-color: rgba(0, 0, 0, 0.8);
    max-width: 100%;
    height: 400px;
    filter: brightness(8.4);
  }
</style>

<div class="container mt-4">

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header" style="
        text-align: center;
        ">
          <b>Filtros</b>
        </div>

        <div class="card-body ">
          <div id="contenedor" class="estilos" style="
                position: absolute;
                width: 295px;
                z-index: 999;
                margin-left: -17px;
                margin-top: -17px;
                height: 268px;
                color: white;
                visibility: hidden;
            ">
            <div class="text-center" style="
                    /* display: flex; */
                    /* align-content: center; */
                    /* justify-content: center; */
                    margin-top: 113px;
                ">
              <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <p>Cargando...</p>
            </div>
          </div>
          <label>Centro de Costo
            <select class="form-select centro_costo" id="centro_costo">
              <option selected disabled>Seleccionar Centro de costo</option>
              <option value="102">102</option>
              <option value="104">104</option>
              <option value="105">105</option>
              <option value="108">108</option>
              <option value="111">111</option>
              <option value="112">112</option>
              <option value="113">113</option>
              <option value="114">114</option>
              <option value="115">115</option>
              <option value="116">116</option>
              <option value="117">117</option>
              <option value="420">420</option>
              <option value="424">424</option>
              <option value="504">504</option>
              <option value="506">506</option>
              <option value="507">507</option>
              <option value="515">515</option>
              <option value="528">528</option>
              <option value="529">529</option>
              <option value="535">535</option>
              <option value="541">541</option>
              <option value="542">542</option>
              <option value="543">543</option>
              <option value="544">544</option>
              <option value="545">545</option>
              <option value="546">546</option>
              <option value="547">547</option>
              <option value="548">548</option>
              <option value="549">549</option>
              <option value="550.1">550.1</option>
              <option value="550.2">550.2</option>
              <option value="550.3">550.3</option>
              <option value="550.4">550.4</option>
              <option value="550.5">550.5</option>
              <option value="550.6">550.6</option>
              <option value="550.7">550.7</option>
              <option value="550.8">550.8</option>
              <option value="550.9">550.9</option>
              <option value="550.10">550.10</option>
              <option value="551">551</option>
              <option value="553">553</option>
              <option value="554">554</option>
              <option value="555">555</option>
              <option value="556">556</option>
              <option value="557">557</option>
              <option value="558">558</option>
              <option value="559">559</option>
              <option value="561">561</option>
              <option value="562">562</option>
              <option value="563">563</option>
              <option value="564">564</option>
              <option value="565">565</option>
              <option value="566">566</option>
              <option value="567">567</option>
              <option value="568">568</option>
              <option value="569">569</option>
              <option value="570">570</option>
              <option value="571">571</option>
              <option value="572">572</option>
              <option value="574">574</option>
              <option value="575">575</option>
              <option value="576">576</option>
              <option value="577">577</option>
              <option value="578">578</option>
              <option value="579">579</option>
              <option value="580">580</option>
              <option value="581">581</option>
              <option value="582">582</option>
              <option value="583">583</option>
              <option value="584">584</option>
              <option value="585">585</option>
              <option value="586">586</option>
              <option value="587.1">587.1</option>
              <option value="587.2">587.2</option>
              <option value="587.3">587.3</option>
              <option value="587.4">587.4</option>
              <option value="588">588</option>
              <option value="589">589</option>
              <option value="590">590</option>
              <option value="591">591</option>
              <option value="592">592</option>
              <option value="593">593</option>
              <option value="595">595</option>
              <option value="596">596</option>
              <option value="597">597</option>
              <option value="598">598</option>
              <option value="599">599</option>
              <option value="601">601</option>
              <option value="602">602</option>
              <option value="603">603</option>
              <option value="604">604</option>
              <option value="605">605</option>
              <option value="606">606</option>
              <option value="607">607</option>
              <option value="608">608</option>
              <option value="609">609</option>
              <option value="610">610</option>
              <option value="611">611</option>
              <option value="612">612</option>
              <option value="613">613</option>
              <option value="614">614</option>
              <option value="615">615</option>
              <option value="616">616</option>
              <option value="617">617</option>
              <option value="618">618</option>
              <option value="619">619</option>
              <option value="901">901</option>
            </select>
          </label>
          <label id="nombre_persona">
            Nombre del Trabajador
            <select class="form-select nombre_persona" disabled>
              <option value="" selected disabled>Seleccionar Trabajador</option>
            </select>
          </label>
          <label>Correo Electronico
            <input value="" disabled id="correo" />
          </label>
          <p id="total">Total de registros: </p>

        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-header" style="
    text-align: center;
">
          <b>Asignación de Reportes</b>
        </div>
        <div class="card-body" style="    display: flex;
                  justify-content: center;
              ">
          <form id="demoform" action="/api/add/asignar" method="get" style="width: 600px;">
            @csrf
            <select multiple="multiple" size="10" name="duallistbox_demo1[]" id="select2">

            </select>
            <input id="prodId" name="prodId" type="hidden" value="">
            <br>
            <button type="submit" class="btn btn-success btn-block" id="botonEnviar">Guardar</button>
          </form>

        </div>
      </div>
      @if(Session::has('message'))
      <div class="alert alert-success mt-2 mb-2">
        {{ Session::get('message') }}
      </div>
      @endif
    </div>
    <div class="col">

    </div>
  </div>

</div>
<!-- <script src="http://code.jquery.com/jquery-1.9.0.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.2/jquery.bootstrap-duallistbox.js" integrity="sha512-hRO4YVWE+x8AYSMHzjmUDFvzGu6hBQKaTfMHACH+mmrbQj34rbHpgMqo/9yQvl1GibrxqxvTB6P0oClLGHKzsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script>
  var demo = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({
    infoText: 'Total de opciones seleccionadas / no seleccionadas {0} elementos',
    filterPlaceHolder: 'Buscar',
    infoText: 'Total de opciones seleccionadas / no seleccionadas {0} elementos',
    infoTextEmpty: 'Lista vacía',
    nonSelectedListLabel: 'Lista de Reportes',
    selectedListLabel: 'Lista de Reportes asignadas',

  });
  $(document).ready(function() {

    $('.centro_costo').select2();
    $('.nombre_persona').select2();


    $(".centro_costo").change(function() {

      $(".nombre_persona").empty();
      $("#correo").val("")
      // $('.nombre_persona').select2({
      //   data: data
      // });
      $(".estilos").css("visibility", "visible")
      $.get(`api/user/${$(".centro_costo").val()}`, function(data, status) {
        $(".nombre_persona").html(`<option value="" selected disabled>Seleccionar Trabajador</option>`);

        var datos = []
        for (x of data) {
          datos.push({
            id: x.mail,
            text: x.displayName
          })
        }
        $(".nombre_persona").select2({
          data: datos
        })
        $(".estilos").css("visibility", "hidden")
        $(".nombre_persona").prop("disabled", false);
        $("#total").text("Total de registros: " + datos.length)

        // console.log(datos)
      });
      $(".nombre_persona").change(function() {
        $("#correo").val($(".nombre_persona").val())
        $("#prodId").val($(".nombre_persona").val())
        $.get(`/api/get/asignaciones/${$(".nombre_persona").val()}`, function(data, status) {
          console.log(data);
          $("#select2").html(data);
          demo.bootstrapDualListbox('refresh');
        })




      });
    });
    // $(".nombre_persona").change(function(){
    //   alert($(".nombre_persona").val());
    // });



  });
</script>



@endsection