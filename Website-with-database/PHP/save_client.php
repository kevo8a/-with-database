<?php
require "conect.php";
$con = conecta();

$name = $_POST["name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$pass = $_POST["pass"];

// Generar un hash seguro de la contraseña
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

$query = "INSERT INTO client (name, last_name, email, pass) 
          VALUES ('$name', '$last_name', '$email', '$pass_hash')";

$res = $con->query($query);
if ($res) {
    header("Location: login.php");
    exit;
} else {
    echo "Hubo un error al crear el empleado.";
}
?>
