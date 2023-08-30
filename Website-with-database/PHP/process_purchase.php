<?php
require "conect.php";
$con = conecta();

// Obtener información de la compra
$sql = "SELECT * FROM product_orders";
$res = $con->query($sql);
$products = array();
$total = 0;
while ($row = $res->fetch_array()) {
    $id = $row["id"];
    $name = $row["name"];
    $amount = $row["amount"];
    $price = $row["price"];
    $subtotal = $amount * $price;
    $total += $subtotal;

    $products[] = array(
        "id" => $id,
        "name" => $name,
        "amount" => $amount,
        "price" => $price,
        "subtotal" => $subtotal
    );
}

// Insertar la compra en la base de datos
$sql = "INSERT INTO purchases (total) VALUES ($total)";
$res = $con->query($sql);
if (!$res) {
    echo "Error in query: " . $con->error;
    exit();
}
$purchase_id = $con->insert_id;

// Insertar los productos comprados en la tabla "order_items"
foreach ($products as $product) {
    $id = $product["id"];
    $name = $product["name"];
    $amount = $product["amount"];
    $subtotal = $product["subtotal"];
    $sql = "INSERT INTO order_items (order_id, product_id, name, amount, subtotal, total) VALUES ($purchase_id, $id, '$name', $amount, $subtotal, $total)";
    $res = $con->query($sql);
    if (!$res) {
        echo "Error in query: " . $con->error;
        exit();
    }
}

// Eliminar productos del carrito
$sql = "DELETE FROM product_orders";
$res = $con->query($sql);
if (!$res) {
    echo "Error in query: " . $con->error;
    exit();
}

// Redirigir a la página de confirmación
header("Location: purchases.php");
exit();
?>
