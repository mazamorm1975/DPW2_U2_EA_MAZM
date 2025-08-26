<!DOCTYPE html>
<html lang="es">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="bg-light">

<?php
session_start();
session_unset();
session_destroy();

// Iniciar nueva sesión
session_start();
include "conexion.php"; // debe crear $dbh con PDO


if (isset($_POST['ingresar'])) {
    $IDUsuario = $_POST['IDUsuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($IDUsuario) || empty($password)) {
        echo "Por favor llena todos los campos.";
        exit;
    }

    try {
        
        $stmt = $dbh->prepare("SELECT * FROM usuarios WHERE IDUsuario = :IDUsuario AND password = :password");

        $stmt->bindParam(':IDUsuario', $IDUsuario);
        $stmt->bindParam(':password', $password); 

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

           
        $_SESSION['usuario'] = [
        'IDUsuario' => $usuario['IDUsuario'],
        'nombre' => $usuario['nombre'],
        'apellido_paterno' => $usuario['apellido_paterno'],
        'apellido_materno' => $usuario['apellido_materno'],
        'tipo_usuario' => $usuario['tipo_usuario'] // Esto es lo clave
         ];
         
            include "nav.php"; // para mostrar la barra de navegación
            echo '¡BIENVENIDO ' . htmlspecialchars($usuario['nombre']) . ' ' . htmlspecialchars($usuario['apellido_paterno']) . ' ' . htmlspecialchars($usuario['apellido_materno']) . 
                ' Has ingresado como ' . htmlspecialchars($usuario['tipo_usuario']) . '!';       
            
        } else {
            echo "IDUsuario o contraseña incorrectos.";
        }

    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>

</body>
</html>
