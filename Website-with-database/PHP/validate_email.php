<?php
require "conect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $con = conecta();

    $sql = "SELECT * FROM client WHERE email = '$email'";

    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'The email ' . $email . ' already exists.'));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success', 'message' => 'Email available.'));
    }
}
