<?php
session_start();
include "conexion.php";
include "validaciones.php";

// Verifica sesión activa
$idUsuario = $_SESSION['matricula_usuario'] ?? null;
$folio = $_GET['folio_examen'] ?? null;
$aula = $_GET['aula_aplicacion'] ?? null;

// Inicialización
$folio_examen = '';
$id_usuario = '';
$asignatura = '';
$docente_asignatura = '';
$fecha = '';
$hora = '';
$aula = $aula ?? '';

// Si el formulario fue enviado (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folio_examen = $_POST['examen'] ?? '';
    $id_usuario = $_POST['id_usuario'] ?? '';
    $asignatura = $_POST['asignatura'] ?? '';
    $docente_asignatura = $_POST['docente_asignatura'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $aula = $_POST['aula'] ?? '';

    // Validar y formatear la fecha
    if (!empty($fecha)) {
        $fecha = date('Y-m-d', strtotime($fecha));
    } else {
        die('Error: La fecha no puede estar vacía.');
    }

    // Ejecutar UPDATE
    $stmt = $dbh->prepare("
        UPDATE examenes 
        SET folio_examen = :folio_examen, 
            IDUsuario = :IDUsuario, 
            asignatura = :asignatura, 
            docente_asignatura = :docente_asignatura, 
            fecha_aplicacion = :fecha_aplicacion, 
            hora_aplicacion = :hora_aplicacion, 
            aula_aplicacion = :aula_aplicacion 
        WHERE folio_examen = :folio_examen_antiguo
    ");

    $stmt->execute([
        ':folio_examen' => $folio_examen,
        ':IDUsuario' => $id_usuario,
        ':asignatura' => $asignatura,
        ':docente_asignatura' => $docente_asignatura,
        ':fecha_aplicacion' => $fecha,
        ':hora_aplicacion' => $hora,
        ':aula_aplicacion' => $aula,
        ':folio_examen_antiguo' => $folio_examen
    ]);

    echo "<p style='color: green;'>Registro actualizado correctamente.</p>";
} else {
    
    // Obtener datos del examen por folio/aula para mostrar en formulario
    if ($folio && $aula && $idUsuario) {
        $inquiry_results = consultarExamenesPorFolio($dbh, $folio, $aula, $idUsuario);
        if ($inquiry_results && $inquiry_results->rowCount() > 0) {
            $row = $inquiry_results->fetch(PDO::FETCH_ASSOC);
            $folio_examen = $row['folio_examen'];
            $id_usuario = $row['IDUsuario'];
            $asignatura = $row['asignatura'];
            $docente_asignatura = $row['docente_asignatura'];
            $fecha = date('Y-m-d', strtotime($row['fecha_aplicacion']));
            $hora = $row['hora_aplicacion'];
            $aula = $row['aula_aplicacion'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Registro</title>
</head>
<body>
    <header>
        <nav>
            <a href="../archivos_html/index.html">Inicio</a>
            <a href="../archivos_html/registro.html">Registrarse</a>
            <a href="../archivos_html/inicio.html">Iniciar Sesión</a>
        </nav>
    </header>

    <p>Sesión válida para el usuario: <?= htmlspecialchars($idUsuario) ?></p>
    <h1>Modificar Registro</h1>

    <form action="modificar.php?folio_examen=<?= urlencode($folio_examen) ?>&aula_aplicacion=<?= urlencode($aula) ?>" method="post">
        <div>
            <label for="examen">Folio Examen:</label>
            <input type="text" id="examen" name="examen" value="<?= htmlspecialchars($folio_examen) ?>" required />
        </div>
        <br>
        <div>
            <label for="id_usuario">ID Usuario:</label>
            <input type="text" id="id_usuario" name="id_usuario" value="<?= htmlspecialchars($id_usuario) ?>" required />
        </div>
        <br>
        <div>
            <label for="asignatura">Asignatura:</label>
            <input type="text" id="asignatura" name="asignatura" value="<?= htmlspecialchars($asignatura) ?>" />
        </div>
        <br>
        <div>
            <label for="docente_asignatura">Docente de la Asignatura:</label>
            <input type="text" id="docente_asignatura" name="docente_asignatura" value="<?= htmlspecialchars($docente_asignatura) ?>" />
        </div>
        <br>
        <div>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($fecha) ?>" required />
        </div>
        <br>
        <div>
            <label for="hora">Hora:</label>
            <input type="text" id="hora" name="hora" value="<?= htmlspecialchars($hora) ?>" />
        </div>
        <br>
        <div>
            <label for="aula">Aula:</label>
            <input type="text" id="aula" name="aula" value="<?= htmlspecialchars($aula) ?>" />
        </div>
        <br>
      <input type="submit" value="Modificar Registro"/>
    </form>
</body>
</html>
