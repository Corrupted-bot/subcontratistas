<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        @import url("//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css");
        @import url(https://fonts.googleapis.com/css?family=Exo:400,500,500italic,400italic,600,600italic,700,700italic,800,800italic,300,300italic);

        .fondo {
            background: url('/img/fondo.png') center center no-repeat fixed;
            background-color: #212529;
            background-size: cover;
            text-align: center;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }



        .login-form {
            width: 404px;
        }

        .login-title {
            font-family: 'Exo', sans-serif;
            text-align: center;
            color: white;
        }

        .login-userinput {
            margin-bottom: 10px;
        }

        .login-button {
            margin-top: 10px;
        }

        .login-button:hover {
            background-color: #000000 !important;
        }

        .login-options {
            margin-bottom: 0px;
        }

        .login-forgot {
            float: right;
        }

        #office:hover {
            filter: brightness(2.75);

        }
    </style>
</head>

<body class="fondo">
    <div class="container login-form" style="    
    background-color: currentcolor;
    height: 473px;
    border-radius: 20px;
    margin-top: 169px;
    margin-left: 36%;
    position: absolute;
    ">
        <h2 class="login-title"><img src="{{ asset('/img/logo.png') }}" style="width: 250px;" /></h2>
        <div class="">
            <div class="panel-body">
                <form method="POST" action="/iniciar-sesion">
                    @csrf
                    <div class="input-group login-userinput">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input id="txtUser" type="text" class="form-control" name="username" placeholder="Usuario" required>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input id="txtPassword" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                        <span id="showPassword" class="input-group-btn">
                            <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                        </span>
                    </div>
                    <button class="btn btn-primary btn-block login-button" style="background-color: #007da9;border-color: #000000;margin-bottom: 10px;" type="submit"><i class="fa fa-sign-in"></i> Iniciar Sesión</button>
                    <a href="/recuperar" style="color: white;margin-top: 2px">
                        ¿Olvidaste tu contraseña?
                    </a>
                    <div class="checkbox login-options">
                    </div>
                </form>
                @if(Session::has('message'))
                <div id="alerta" style="position: sticky;height: 10px;">
                    <div class="alert alert-danger " style="position: sticky;">
                        {{ Session::get('message') }}
                    </div>
                </div>
                @endif
            </div>
            <a href="/signin"><img id="office" src="{{ asset('/img/office-365.png') }}" style="width: 196px;margin-top: 44px;" /></a>
        </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            $("#showPassword").hide();
        }

        $("#txtPassword").on('change', function() {
            if ($("#txtPassword").val()) {
                $("#showPassword").show();
            } else {
                $("#showPassword").hide();
            }
        });

        $(".reveal").on('click', function() {
            var $pwd = $("#txtPassword");
            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
            } else {
                $pwd.attr('type', 'password');
            }
        });
    </script>
</body>

</html>