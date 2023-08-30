<?php
session_start();
require "conect.php";
$email = $_POST["email"];
$pass = $_POST["pass"];

$con = conecta();
$contador = 0;

// Consultar si existe un  client con el correo especificado
$sql = "SELECT * FROM client WHERE email = '$email' ";
$res = $con->query($sql);

if (mysqli_num_rows($res) == 1) {
    $fila = $res->fetch_array();

    // Comparar la contraseña ingresada con la encriptada
    if (password_verify($pass, $fila["pass"])) {
        $contador++;
    }

    if ($contador > 0) {
        $_SESSION["id"] = $fila["id"];
        $_SESSION["name"] = $fila["name"];
        header("Location: menu.php"); 
        exit;
    } header("Location: login.php");
}
