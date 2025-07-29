<?php
session_start();
session_unset();
session_destroy();
header('Location: ../archivos_html/inicio.html');
exit;
?>