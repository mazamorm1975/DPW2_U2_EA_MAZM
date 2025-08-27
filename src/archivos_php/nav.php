<?php

if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuario'] === 'ES') {
    echo '
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    </head>
    <nav class="menu-nav p-3 bg-dark text-white">
        <a href="../archivos_html/inicio.html">Inicio</a>
        <a href="../archivos_php/consultar.php">Consultar</a>
        <a href="../archivos_php/registrar_examenes.php">Registrar</a>
        <a href="logout.php">Salir</a>
    </nav>
    ';
} else if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuario'] === 'CE') {
    echo '
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</head>

    <nav class="menu-nav p-3 bg-dark text-white">
        <a href="../archivos_html/inicio.html">Inicio</a>
        <a href="../archivos_php/validar_matricula.php">Consultar</a>
		<a href="../archivos_php/registrar_examenes.php">Registrar</a>
        <a href="../archivos_php/validar_matricula.php">Modificar</a>
        <a href="../archivos_php/eliminar.php">Eliminar</a>
        <a href="logout.php">Salir</a>
    </nav>
    ';
} else{
    echo '
    <nav>
        <a href="../archivos_html/inicio.html">Inicio</a>
        <a href="../archivos_html/registro.html">Registrarse</a>
        <a href="../archivos_html/ingresar.html">Iniciar sesión</a>
    </nav>
    ';
}

?>