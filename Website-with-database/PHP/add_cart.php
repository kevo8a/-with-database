<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

require "conect.php";
$con = conecta();

// Obtener el id del producto a agregar al carrito
$id = $_GET["id"];
$sql = "SELECT * FROM productos WHERE id = $id";
$res = $con->query($sql);
$row = $res->fetch_array();
$name = $row["name"];
$code = $row["code"];
$amount = 1;
$cost = $row["cost"];

// Verificar si el producto ya está en el carrito
$query = "SELECT * FROM product_orders WHERE id_product = '$code'";
$res = $con->query($query);

if ($res->num_rows > 0) {
    // El producto ya está en el carrito, actualiza la cantidad
    $row = $res->fetch_array();
    $amount = $row["amount"] + 1;
    $query = "UPDATE product_orders SET amount = $amount WHERE id_product = '$code'";
} else {
    // El producto no está en el carrito, inserta un nuevo registro
    $query = "INSERT INTO product_orders (name, id_product, price, amount) 
              VALUES ('$name', '$code', '$cost', $amount)";
}

$res = $con->query($query);

if ($res) {
    header("Location: cart.php");
    exit;
} else {
    echo "Error in query: " . $con->error;
}
?>
