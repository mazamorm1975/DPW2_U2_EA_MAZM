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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
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
                  <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10"> 
      <form action="eliminar.php?folio_examen=<?= urlencode($folio_examen) ?>" method="post">
         <div class="row g-3">
              <h1 class="text-center mb-4">Eliminación de registro</h1>
           <div class="col-12 col-md-6 col-lg-4">
            <label for="folio_examen">Folio Examen:</label>
            <input type="text" id="folio_examen" name="folio_examen" value="<?= htmlspecialchars($folio_examen) ?>"/>
        </div class="col-12">
        <br>           
            <input type="submit" class="btn btn-primary w-100" value="Ejecutar Acción"/>
        </div>
      </form>
        </div>
        </div>
        </div>
</body>

</html>