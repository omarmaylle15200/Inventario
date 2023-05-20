<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css">
</head>

<body>
    <?php $this->showMessages(); ?>
    <div id="login-main">
        <h2>Iniciar sesión</h2>
        <p>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete="off">
        </p>
        <p>
            <label for="password">password</label>
            <input type="password" name="password" id="password" autocomplete="off">
        </p>
        <p>
            <button id="btnIniciarSesion" type="button">Iniciar Sesión</button>
        </p>
        <p>
            ¿No tienes cuenta? <a href="<?php echo constant('URL'); ?>signup">Registrarse</a>
        </p>
    </div>
    <script src="<?php echo constant('URL'); ?>public/js/login.js"></script>
</body>

</html>