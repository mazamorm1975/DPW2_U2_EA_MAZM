<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Validar_Matricula</title>
</head>
<body>
    <header>
        <nav class="menu-nav p-3 bg-dark text-white">
            <?php include "nav.php"; ?>
        </nav>
    </header>
    
    <br><br>
    <form id="form2" action="validar_matricula.php" method="get" class="container">
        <label for="matricula">Matricula:</label>
        <input type="text" id="matricula" name="matricula" />
        <input type="submit" name="validar" value="Validar" class="btn btn-success"/>
    </form>
    
    <br><br>
    <div class="container">
        <table class="table table-success table-striped table-bordered">
            <thead>
                <tr>
                    <th>Folio del examen</th>
                    <th>ID del usuario</th>
                    <th>Asignatura</th>
                    <th>Docente de la asignatura</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Aula</th>
                    <th colspan="2" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
              include "conexion.php";
              include "validaciones.php";

              if (isset($_GET['validar']) && isset($_GET['matricula'])) {
                $matricula = $_GET['matricula'];
                $idUsuario = obtenerIDUsuarioPorMatricula($dbh, $matricula);
                
                if ($idUsuario !== null) {
                    $filas = consultarExamenes($dbh, $idUsuario);
                    $filas->setFetchMode(PDO::FETCH_ASSOC);
                    $registros = $filas->fetchAll();

                    if (count($registros) > 0) {
                        $usuario = $registros[0];
                        echo '
                            <div class="text-center mb-3">
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
                                <td>
                                    <a href='../archivos_php/modificar.php?folio_examen={$fila['folio_examen']}&aula_aplicacion={$fila['aula_aplicacion']}&id_usuario={$fila['IDUsuario']}'
                                       class='btn btn-sm btn-primary'>
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <a href='../archivos_php/eliminar.php?folio_examen={$fila['folio_examen']}'
                                       class='btn btn-sm btn-danger'
                                       onclick='return confirm(\"¿Seguro que deseas borrar este registro?\");'>
                                        Borrar
                                    </a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No hay exámenes registrados.</td></tr>";
                    }
                    $_SESSION['matricula_usuario'] = $matricula;
                } else {
                    echo "<tr><td colspan='9' class='text-center'>Matrícula no encontrada.</td></tr>";
                }
              }
            ?>         
            </tbody>
        </table>
    </div>
</body>
</html>
 