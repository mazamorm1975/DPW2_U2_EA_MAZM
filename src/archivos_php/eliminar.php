<?php

//Se inicia sesion y conexion a la base de datos
session_start();
include "conexion.php";
include "validaciones.php";
$_SESSION['usuario']['IDUsuario'];

// Verifica sesión activa
$idUsuario = $_SESSION['matricula_usuario'] ?? null;
$folio_examen = $_POST['folio_examen'] ?? $_GET['folio_examen'] ?? null;
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    if ($folio_examen) {
        // Ejecutar DELETE
        $stmt = $dbh->prepare("DELETE FROM examenes WHERE folio_examen = :folio_examen");
        $stmt->bindParam(':folio_examen', $folio_examen);
        $stmt->execute();
        echo "<p style='color: green;'>Registro eliminado con exito.</p>";
        // Redirigir a la página de consulta después de eliminar
        header("Location: consultar.php");
        exit();
    } else {
        echo "Error: Folio del examen no proporcionado.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar_Registros</title>
</head>

<body>
    <header>
        <nav>
<!--
            <a href="../archivos_html/index.html">Inicio</a>
            <a href="../archivos_html/registro.html">Registrarse</a>
            <a href="../archivos_html/inicio.html">Iniciar Sesion</a>-->
            <?php include "nav.php"; ?>
        </nav>
               
      <form action="eliminar.php?folio_examen=<?= urlencode($folio_examen) ?>" method="post">
           <div>
            <label for="folio_examen">Folio Examen:</label>
            <input type="text" id="folio_examen" name="folio_examen" value="<?= htmlspecialchars($folio_examen) ?>"/>
        </div>
        <br>           
            <input type="submit" value="Eliminar Registro"/>
      </form>

</body>

</html>