<?php
    $dbname="instituto";
    $user="root";
    $password="#Cu213lona1993";
    $options=array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
        PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_OBJ);
    try {
        $dsn = "mysql:host=localhost;dbname=$dbname";
        $dbh =  new PDO($dsn, $user, $password, $options);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit;
    }
?>
