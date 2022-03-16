<!DOCTYPE html>
<html>

<head>
  <title>Innovación & Desarrollo</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">





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
            <a href="/" class="nav-link {{$_SERVER['REQUEST_URI'] == '/' ? ' active' : ''}}">Home</a>
          </li>
          @if(isset($userName))
          <li class="nav-item" data-turbolinks="false">
            <a href="/crear/reporte" class="nav-link{{$_SERVER['REQUEST_URI'] == '/crear/reporte' ? ' active' : ''}}">Agregar Reporte</a>
          </li>
          <li class="nav-item" data-turbolinks="false">
            <a href="/ver/reportes" class="nav-link{{$_SERVER['REQUEST_URI'] == '/ver/reportes' ? ' active' : ''}}">Reportes</a>
          </li>
          <li class="nav-item" data-turbolinks="false">
            <a href="/asignar" class="nav-link{{$_SERVER['REQUEST_URI'] == '/asignar' ? ' active' : ''}}">Asignar</a>
          </li>
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
              <p class="dropdown-item-text text-muted mb-0" style="width: 258px;">{{ $department }}</p>

              <div class="dropdown-divider"></div>
              <a href="/signout" class="dropdown-item">Cerrar Sesión</a>
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
  <main role="main" class="container mt-4">
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
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
</body>

</html>