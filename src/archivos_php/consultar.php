<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Consulta_Examenes</title>
</head>

<body>
    <nav>
        <a href="../archivos_html/index.html">Inicio</a>
        <a href="../archivos_html/registro.html">Registrarse</a>
        <a href="../archivos_html/inicio.html">Iniciar Sesion</a>
    </nav>
    <h1>Consulta Examenes Registrados</h1>
 
    <table>
        <thead>
            <tr>
                <th scope="col">Folio del examen</th>
                <th scope="col">ID del usuario</th>
                <th scope="col">Asignatura</th>
                <th scope="col">Docente de la asignatura</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Aula</th>
            </tr>
        </thead>
        <tbody>
    <?php
      session_start();
      include "conexion.php";
      include "validaciones.php";
      if (isset($_SESSION['usuario']['IDUsuario'])) {
        $idUsuario = $_SESSION['usuario']['IDUsuario'];
        $filas =  consultarExamenes($dbh, $idUsuario);
      
         // Obtener todos los resultados como array asociativo
        $resultados = $filas->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultados) > 0) {
        $usuario = $resultados[0]; 
        echo '
            <div style="text-align: center; margin-bottom: 10px;">
            <strong>Estudiante:</strong> ' . htmlspecialchars($usuario['nombre']) . ' ' . htmlspecialchars($usuario['apellido_paterno']) . ' ' . htmlspecialchars($usuario['apellido_materno']) . '
            </div>
        ';
        // Volver al primer registro para el foreach
        foreach ($resultados as $fila) {
           echo "<tr>
            <td>{$fila['folio_examen']}</td>
            <td>{$fila['IDUsuario']}</td>
            <td>{$fila['asignatura']}</td>
            <td>{$fila['docente_asignatura']}</td>
            <td>{$fila['fecha_aplicacion']}</td>
            <td>{$fila['hora_aplicacion']}</td>
            <td>{$fila['aula_aplicacion']}</td>
            </tr>";
                }
            } else {
            echo "<tr><td colspan='7'>No hay examenes registrados.</td></tr>";
           }
        } 
    ?>
         
        </tbody>
    </table>
</body>
</html>