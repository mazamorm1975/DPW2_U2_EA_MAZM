<?php

    include "conexion.php";
    include "validaciones.php";
    $IDUsuario = $_POST['IDUsuario'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno']; 
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];       
    $telefono = $_POST['telefono'];
    $tipo_usuario = $_POST['tipo_usuario']; 
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

     
    if ($dbh != null) {
        if(isset($_POST['registrar'])) {
            $validacion = Validacion_Registro_Usuario(
                $IDUsuario, $nombre, $apellido_paterno, $apellido_materno,
                $edad, $sexo, $email, $telefono, $tipo_usuario, $password, $confirmar
            );

        

            if ($validacion !== true) {
                echo $validacion;
                exit;
            }

            if (validarIDUsuarioExistente($dbh, $_POST['IDUsuario'])) {
                echo "IDUsuario ya existe.";
                exit;
            }

        } else {
            echo "No se ha enviado el formulario.";
            exit;
        }
    $stmt = $dbh->prepare("INSERT INTO usuarios (
        IDUsuario, nombre, apellido_paterno, apellido_materno,
        edad, sexo, email, telefono, tipo_usuario, password
    ) VALUES (
        :IDUsuario, :nombre, :apellido_paterno, :apellido_materno,
        :edad, :sexo, :email, :telefono, :tipo_usuario, :password
    )");

        $result = $stmt->execute([
        ':IDUsuario' => $IDUsuario,
        ':nombre' => $nombre,
        ':apellido_paterno' => $apellido_paterno,
        ':apellido_materno' => $apellido_materno,
        ':edad' => $edad,
        ':sexo' => $_POST['sexo'],
        ':email' => $email,
        ':telefono' => $telefono,
        ':tipo_usuario' => $tipo_usuario,
        ':password' => $password
    ]);

    
    if ($result && $stmt->rowCount() > 0) {
        echo "Registro insertado correctamente.";
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Error SQL: " . $errorInfo[2];
    }


    echo "<br>Base de datos conectada: " . $dbh->query("SELECT DATABASE()")->fetchColumn();
}
?>