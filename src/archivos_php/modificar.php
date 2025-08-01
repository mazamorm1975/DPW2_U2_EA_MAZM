<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar_Registros</title>
</head>

<body>
    <header>
        <nav>
            <a href="../archivos_html/index.html">Inicio</a>
            <a href="../archivos_html/registro.html">Registrarse</a>
            <a href="../archivos_html/inicio.html">Iniciar Sesion</a>
        </nav>
    </header>

    <p>Sesion valida para el usuario: <?php session_start(); echo $_SESSION["matricula_usuario"] ?></p>
    <h1>Modificar Registro</h1>
</body>

</html>