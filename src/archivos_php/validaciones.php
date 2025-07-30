<?php

function Validacion_Registro_Usuario($arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11) {
    
    if (empty($arg1) || empty($arg2) || empty($arg3) || empty($arg4) || empty($arg5) || empty($arg6) || empty($arg7) || empty($arg8) || empty($arg9) || empty($arg10) || empty($arg11)) {
        return "Todos los campos son obligatorios.";
    }
    
    if (!filter_var($arg7, FILTER_VALIDATE_EMAIL)) {
        return "El correo electrónico no es válido.";
    }
    
    if (!preg_match('/^[0-9]{10}$/', $arg8)) {
        return "El número de teléfono debe tener 10 dígitos.";
    }
    
    if ($arg10 !== $arg11) {
    return "Las contraseñas no coinciden.";
    }

   
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $arg10)) {
    return "La contraseña debe tener al menos 8 caracteres, incluyendo letras, números y un carácter especial.";
    }



    return true;
}

function validarIDUsuarioExistente($conexion, $idUsuario) {
    $sql = "SELECT COUNT(*) FROM usuarios WHERE IDUsuario = :idUsuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->execute();

    $existe = $stmt->fetchColumn(); // Devuelve el número de filas encontradas
    return $existe > 0;
}

function validarTipoUsuario($conexion, $arg1){
    $sql = "SELECT tipo_usuario FROM usuarios WHERE IDUsuario = $arg1";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $existe = $stmt->fetchcolumn();
    return $existe > 0;
}

function consultarExamenes($conexion, $idUsuario) {
    $sql = "SELECT t2.*, t1.nombre, t1.apellido_paterno, t1.apellido_materno
                FROM examenes t2
                INNER JOIN usuarios t1 ON t1.IDUsuario = t2.IDUsuario
                WHERE t1.IDUsuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$idUsuario]);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}






?>