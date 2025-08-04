<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Validar_Matricula</title>
</head>
<body>
    <header>
        <nav>
                <a href="../archivos_html/index.html">Inicio</a>
                <a href="../archivos_html/registro.html">Registrarse</a>
                <a href="../archivos_html/inicio.html">Iniciar Sesion</a>
        </nav>
    </header>
    
    <br>
    <br>
    <form id="form2" action="validar_matricula.php" method="get">
        <label for="matricula">Matricula:</label>
        <input type="text" id="matricula" name="matricula" />
        <input type="submit" name="validar" value="Validar"/>
    </form>
    <br>
    <br>
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
                <th scope="col"></th>
                <th scope="col"></th>                
            </tr>
        </thead>
        <tbody>
    <?php
      session_start();
      include "conexion.php";
      include "validaciones.php";

      if (isset($_GET['validar']) && isset($_GET['matricula'])) {
        $matricula = $_GET['matricula'];
        $idUsuario = obtenerIDUsuarioPorMatricula($dbh, $matricula);
        
        if($idUsuario !==null){
            
            $filas =  consultarExamenes($dbh, $idUsuario);
            $filas->setFetchMode(PDO::FETCH_ASSOC);
            $registros = $filas->fetchAll();

            if(count($registros) > 0) {
                $usuario = $registros[0];
            echo '
                <div style="text-align: center; margin-bottom: 10px;">
                <strong>Estudiante:</strong> ' . $usuario['nombre'] . ' ' . $usuario['apellido_paterno'] . ' ' . $usuario['apellido_materno'] . '
                <h1>Examenes Registrados</h1>
                </div>
            ';
         
        foreach ($registros as $fila) {
           echo "<tr>
            <td>{$fila['folio_examen']}</td>
            <td>{$fila['IDUsuario']}</td>
            <td>{$fila['asignatura']}</td>
            <td>{$fila['docente_asignatura']}</td>
            <td>{$fila['fecha_aplicacion']}</td>
            <td>{$fila['hora_aplicacion']}</td>
            <td>{$fila['aula_aplicacion']}</td>
            <td><a href='../archivos_php/modificar.php?folio_examen={$fila['folio_examen']}&aula_aplicacion={$fila['aula_aplicacion']}&{$fila['IDUsuario']}'>editar</a></td>
            <td><a href='../archivos_php/eliminar.php?folio_examen={$fila['folio_examen']}'>borrar</a></td>
            </tr>";
                }
            } else {
            echo "<tr><td colspan='7'>No hay examenes registrados.</td></tr>";
           }
           $_SESSION['matricula_usuario']=$matricula;
} else {
        echo "<tr><td colspan='7'>Matrícula no encontrada.</td></tr>";
    }

}
    ?>         
        </tbody>
    </table>

</body>
</html>
