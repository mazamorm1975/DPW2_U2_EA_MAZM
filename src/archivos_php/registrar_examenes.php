<?php
session_start();
include "conexion.php";

$_SESSION['usuario']['IDUsuario'];


$folio_examen = '';
$id_usuario = '';
$asignatura = '';
$docente_asignatura = '';
$fecha_aplicacion = '';
$hora_aplicacion = '';
$aula_aplicacion = $aula_aplicacion ?? '';


if ($dbh != null) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $folio_examen = $_POST['folio_examen'];
        $id_usuario = $_POST['id_usuario'];
        $asignatura = $_POST['asignatura'];
        $docente_asignatura = $_POST['docente_asignatura'];
        $fecha_aplicacion = $_POST['fecha_aplicacion'];
        $hora_aplicacion = $_POST['hora_aplicacion'];
        $aula_aplicacion = $_POST['aula_aplicacion'];  

   

    // Ejecutar INSERT
    $stmt = $dbh->prepare("INSERT INTO examenes (
    folio_examen, 
    IDUsuario, 
    asignatura, 
    docente_asignatura, 
    fecha_aplicacion, 
    hora_aplicacion, 
    aula_aplicacion) VALUES (
    :folio_examen, 
    :id_usuario, 
    :asignatura, 
    :docente_asignatura, 
    :fecha_aplicacion, 
    :hora_aplicacion, 
    :aula_aplicacion
    )");

    $stmt->execute([
        ':folio_examen' => $folio_examen,
        ':id_usuario' => $id_usuario,
        ':asignatura' => $asignatura,
        ':docente_asignatura' => $docente_asignatura,
        ':fecha_aplicacion' => $fecha_aplicacion,
        ':hora_aplicacion' => $hora_aplicacion,
        ':aula_aplicacion' => $aula_aplicacion
    ]);
       echo "<p style='color: green;'>Registro ingresado con exito.</p>";
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro_Examenes</title>
</head>

<body>
    <header>
        <nav>        
            <?php include "nav.php" ?>
        </nav>
    </header>
    <form action="registrar_examenes.php?folio_examen=<?= urlencode($folio_examen) ?>" method="post">
        <h1>Registro Examenes Extraordinarios</h1>
        <hr>
        <br>
        <div>
            <label for="folio_examen">Folio Del Examen</label>
            <input type="text" id="folio_examen" name="folio_examen" type="text" value="<?= htmlspecialchars($folio_examen)?>" />
        </div>
        <br>
        <div>
            <label for="id_usuario">ID_Usuario</label>
            <input type="text" id="id_usuario" name="id_usuario" type="text" value="<?=htmlspecialchars($id_usuario)?>" />
        </div>
        <br>
        <div>
            <label for="asignatura">Asignatura</label>
            <input type="text" id="asignatura" name="asignatura" type="text" value="<?= htmlspecialchars($asignatura)?>" />
        </div>
        <br>
        <div>
            <label for="docente_asignatura">Docente Asignatura</label>
            <input type="text" id="docente_asignatura" name="docente_asignatura" type="text" value="<?= htmlspecialchars($docente_asignatura)?>"/>
        </div>
        <br>
        <div>
            <label for="fecha_aplicacion">Fecha</label>
            <input type="date" id="fecha_aplicacion" name="fecha_aplicacion" value="<?= htmlspecialchars($fecha_aplicacion) ?>"/>
        </div>
        <br>
        <div>
            <label for="hora_aplicacion">Hora</label>
            <input type="text" id="hora_aplicacion" name="hora_aplicacion"  value="<?= htmlspecialchars($hora_aplicacion) ?>"/>
        </div>
        <br>
        <div>
            <label for="aula_aplicacion">Aula</label>
            <input type="text" id="aula_aplicacion" name="aula_aplicacion" value="<?= htmlspecialchars($aula_aplicacion) ?>"/>
        </div>
        <br>
        <div>
            <input type="submit" name="registrar" value="Registrar" />
        </div>
    </form>
</body>

</html>