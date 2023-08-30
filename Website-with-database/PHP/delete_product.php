<?php
require "conect.php";
$con = conecta();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM product_orders WHERE id = $id";
    $res = $con->query($sql);
    if (!$res) {
        echo "Error in query: " . $con->error;
    }
}

header("Location: cart.php");
exit;
?>
