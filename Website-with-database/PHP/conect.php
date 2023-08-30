<?php

define("HOST",'localhost');
define("BD",'empresa');
define("USER_BD",'root');
define("PASS_BD",'');

// Función para conectarse a la base de datos
function conecta(){
    $conexion = new mysqli(HOST, USER_BD, PASS_BD, BD);
    return $conexion;
}
?>
