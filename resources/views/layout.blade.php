<!DOCTYPE html>
<html>

<head>
  <title>Subcontratistas</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="icon" href="{{ asset('img/favicon.ico') }}">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    .dt-button {
      padding: 0 !important;
      border: none !important;
    }

    .buttons-colvis {

      width: 100px;
      height: 40px;
      background-color: #007da9 !important;
      color: white !important;

    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container ">
      <a href="/"><img src="{{ asset('/img/logo.png') }}" style="
    width: 150px;
" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <!-- mx-auto -->
          <li class="nav-item">
            <a href="/" class="nav-link {{$_SERVER['REQUEST_URI'] == '/' ? ' active' : ''}}">Inicio</a>
          </li>
          @if(isset($userName))
          @if(is_numeric($department))

          <li class="nav-item" data-turbolinks="false">
            <a href="/contratos/subcontratista" class="nav-link{{$_SERVER['REQUEST_URI'] == '/contratos/subcontratista' ? ' active' : ''}}">Estados de Pago</a>
          </li>

          @else

          <li class="nav-item" data-turbolinks="false">
            <a href="/a" class="nav-link{{$_SERVER['REQUEST_URI'] == '/a' ? ' active' : ''}}">Admin</a>
          </li>
          <li class="nav-item" data-turbolinks="false">
            <a href="/subcontratistas" class="nav-link{{$_SERVER['REQUEST_URI'] == '/subcontratistas' ? ' active' : ''}}">Subcontratistas</a>
          </li>

          @endif
          @endif
        </ul>
        <ul class="navbar-nav justify-content-end">
          @if(isset($userName))
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              @if(isset($user_avatar))
              <img src="{{ $user_avatar }}" class="rounded-circle align-self-center mr-2" style="width: 32px;">
              @else
              <i class="far fa-user-circle fa-lg rounded-circle align-self-center mr-2" style="width: 32px;"></i>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <h5 class="dropdown-item-text mb-0">{{ $userName }}</h5>
              <p class="dropdown-item-text text-muted mb-0">{{ $userEmail }}</p>
              @if(is_numeric($department))
              <p class="dropdown-item-text text-muted mb-0" style="width: 258px;"><?php $usuario = DB::table("subcontratistas")->where("id",$department)->get();
              print_r($usuario[0]->razon_social);
              ?></p>
              @else
              <p class="dropdown-item-text text-muted mb-0" style="width: 258px;">{{ $department }}</p>
              @endif
              <div class="dropdown-divider"></div>
              @if(is_numeric($department))
              <a href="/cerrar-sesion" class="dropdown-item">Cerrar Sesión</a>
              @else
              <a href="/signout" class="dropdown-item">Cerrar Sesión</a>
              @endif
            </div>
          </li>
          @else
          <li class="nav-item">
            <a href="/signin" class="nav-link">Iniciar Sesión</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <main role="main">
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
      <p class="mb-3">{{ session('error') }}</p>
      @if(session('errorDetail'))
      <pre class="alert-pre border bg-light p-2"><code>{{ session('errorDetail') }}</code></pre>
      @endif
    </div>
    @endif

    @yield('content')
  </main>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#subcontratistas').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        },
        "lengthChange": false,
        "lengthMenu": [
          [7],
          [7]
        ],
        dom: 'Bfrtip',
        buttons: [{

            title: 'Casos Ingresados',
            text: '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearSubcontratista">Agregar Subcontratista <i class="fa-solid fa-plus"></i></button>',
          }, 
          // {
          //   //Botón para Excel
          //   extend: 'excel',
          //   exportOptions: {
          //     columns: [0, 1, 2, 3, 4]
          //   },
          //   excelStyles: { // Add an excelStyles definition
          //     cells: "2", // to row 2
          //     style: { // The style block
          //       font: { // Style the font
          //         name: "Arial", // Font name
          //         size: "14", // Font size
          //         color: "FFFFFF", // Font Color
          //         b: false, // Remove bolding from header row
          //       },
          //       fill: { // Style the cell fill (background)
          //         pattern: { // Type of fill (pattern or gradient)
          //           color: "457B9D", // Fill color
          //         }
          //       }
          //     }
          //   },
          //   footer: false,
          //   title: 'Casos Ingresados',
          //   filename: 'Casos_Ingresados',

          //   //Aquí es donde generas el botón personalizado
          //   text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>',
          // },
          // {
          //   //Botón para Excel
          //   extend: 'pdf',
          //   footer: false,
          //   title: 'Casos Ingresados',
          //   exportOptions: {
          //     columns: [0, 1, 2, 3, 4]
          //   },

          //   //Aquí es donde generas el botón personalizado
          //   text: '<button class="btn btn-danger">Exportar a PDF <i class="fas fa-file-pdf"></i></button>',
          // },

          {
            extend: 'colvis',
            columns: ':not(.noVis)',

          },

        ],
      });
      $('#contratos').DataTable({
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
        buttons: [{

            title: 'Casos Ingresados',
            text: '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearContrato">Agregar Contrato <i class="fa-solid fa-plus"></i></button>',
          }, 
          // {
          //   //Botón para Excel
          //   extend: 'excel',
          //   exportOptions: {
          //     columns: [0, 1, 2, 3, 4]
          //   },
          //   excelStyles: { // Add an excelStyles definition
          //     cells: "2", // to row 2
          //     style: { // The style block
          //       font: { // Style the font
          //         name: "Arial", // Font name
          //         size: "14", // Font size
          //         color: "FFFFFF", // Font Color
          //         b: false, // Remove bolding from header row
          //       },
          //       fill: { // Style the cell fill (background)
          //         pattern: { // Type of fill (pattern or gradient)
          //           color: "457B9D", // Fill color
          //         }
          //       }
          //     }
          //   },
          //   footer: false,
          //   title: 'Casos Ingresados',
          //   filename: 'Casos_Ingresados',

          //   //Aquí es donde generas el botón personalizado
          //   text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>',
          // },
          // {
          //   //Botón para Excel
          //   extend: 'pdf',
          //   footer: false,
          //   title: 'Casos Ingresados',
          //   exportOptions: {
          //     columns: [0, 1, 2, 3, 4]
          //   },

          //   //Aquí es donde generas el botón personalizado
          //   text: '<button class="btn btn-danger">Exportar a PDF <i class="fas fa-file-pdf"></i></button>',
          // },

          // {
          //   extend: 'colvis',
          //   columns: ':not(.noVis)',

          // },

        ],
      });
    });

  </script>

</body>

</html>