<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}
require "conect.php";
$con = conecta();
$id = $_GET["id"];
$sql = "SELECT * FROM productos WHERE id = $id";
$res = $con->query($sql);
$fila = $res->fetch_array();

$name       = $fila["name"];
$code       = $fila["code"];
$cost       = $fila["cost"];
$stock      = $fila["stock"];
$image      = $fila["archive"];
$description = $fila["description"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>HEXTECH STORE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/description_product.css">
</head>

<body>
    <div class="container">
        <div class="menu">
            <a href="menu.php">MENU</a>
            <a href="contact.php">CONTACT</a>
            <a href="cart.php">CART</a>
            <a href="purchases.php">ORDERS</a>
            <a href="log_out.php">LOG OUT</a>
        </div>
        <div class="product-details">
            <div class="product-image">
                <?php
                if (!empty($image)) {
                    echo '<img src="../../b_corregidoo/products/' . $image . '" class="img-responsive">';
                }
                ?>
            </div>
            <div class="product-info">
                <h2><?php echo $name; ?></h2>
                <p><strong>Code:</strong> <?php echo $code; ?></p>
                <p><strong>Price:</strong> $ <?php echo $cost; ?></p>
                <p><strong>Stock:</strong> <?php echo $stock; ?></p>
                <p><strong>Description:</strong></br> <?php echo $description; ?></p>
                <div class="buttons">
                    <button class="btn btn-primary"><a href="add_cart.php?id=<?php echo $id; ?>">Agregar al carrito</a></button>
                </div>

            </div>
        </div>
        <button class="btn btn-primary"><a href="product_list.php">Back to Product List</a></button>
    </div>
    </div>
</body>

</html>