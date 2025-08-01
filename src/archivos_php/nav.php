<?php


if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuario'] === 'ES') {
    echo '
    <nav>
        <a href="../archivos_html/inicio.html">Inicio</a>
        <a href="../archivos_php/consultar.php">Consultar</a>
        <a href="../archivos_html/registrar_examenes.html">Registrar</a>
        <a href="logout.php">Salir</a>
    </nav>
    ';
} else if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuario'] === 'CE') {
    echo '
    <nav>
        <a href="../archivos_html/inicio.html">Inicio</a>
        <a href="../archivos_php/validar_matricula.php">Consultar</a>
		<a href="../archivos_html/registrar_examenes.html">Registrar</a>
        <a href="../archivos_php/modificar.php">Modificar</a>
        <a href="../archivos_html/eliminar.html">Eliminar</a>
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