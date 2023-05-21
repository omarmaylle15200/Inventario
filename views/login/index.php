<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="./public/css/login.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center  h-100">
            <div class="col-4" id="divLogin">
                <div class="card" id="cardLogin">
                    <div class="body">
                        <div class="row mt-4 mb-2">
                            <div class="col text-center">
                                <p style="font-weight: bold;font-size: 25px;">Iniciar sesión</p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8">
                                <label for="txtUsuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="txtUsuario">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-4">
                            <div class="col-md-8">
                                <label for="txtClave" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" id="txtClave">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-3">
                            <div class="d-grid gap-2 col-8 mx-auto">
                                <button class="btn btn-primary" type="button" id="btnIniciarSesion">Iniciar sesión</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="./public/js/login.js"></script>
</body>

</html>