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
            echo "¡BIENVENIDO {$usuario['nombre']} {$usuario['apellido_paterno']} {$usuario['apellido_materno']} 
             Has ingresado como {$usuario['tipo_usuario']} !";
            
        } else {
            echo "IDUsuario o contraseña incorrectos.";
        }

    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>