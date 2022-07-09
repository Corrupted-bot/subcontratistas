<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity));
        }

        .boton-enviar:hover {
            background-color: #000 !important;
        }
    </style>
</head>
<div class="container">
    <div class="row" style="min-height: 60vh;display: flex;justify-content: center;align-content: center;">

        <div class="col">
        </div>
        <div class="col">
            <div style="display: flex;justify-content: center;" class="mb-3">
                <img src="/img/logo.png" style="width: 300px;">
            </div>
            <div class="card">
                <div class="card-header" style="font-size: 0.875rem;line-height: 1.25rem;">
                    ¿Olvidaste tu contraseña? No hay problema. Simplemente díganos su dirección de correo electrónico y le enviaremos su contraseña.
                </div>
                <div class="card-body">
                    <form method="POST" action="/recuperar-pass">
                    @csrf
                        <label style="font-size: 0.875rem;line-height: 1.25rem;" for="email">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <div style="display: flex;justify-content: center;">

                            <button type="submit" class="btn btn-success mt-3 boton-enviar" style="background-color: #007daa;">Recuperar contraseña</button>

                        </div>
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
        <div class="col">
        </div>
    </div>
</div>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>