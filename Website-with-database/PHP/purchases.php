<?php
require "conect.php";
$con = conecta();

// Obtener información de las compras
$sql = "SELECT * FROM purchases";
$res = $con->query($sql);
$purchases = array();
while ($row = $res->fetch_array()) {
    $id = $row["id"];

    // Obtener los productos comprados
    $sql_items = "SELECT * FROM order_items WHERE order_id = $id";
    $res_items = $con->query($sql_items);
    $items = array();
    $total = 0;
    while ($row_items = $res_items->fetch_array()) {
        $product_name = $row_items["name"];
        $amount = $row_items["amount"];
        $subtotal = $row_items["subtotal"];
        $total = $row_items["total"];
        $items[] = array(
            "product_name" => $product_name,
            "amount" => $amount,
            "subtotal" => $subtotal
        );
    }

    $purchases[] = array(
        "id" => $id,
        "total" => $total,
        "items" => $items
    );
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Compras realizadas</title>
    <link rel="stylesheet" type="text/css" href="../CSS/purchases.css">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../IMG/LOGO/LOGO.jpg">HEXTECH STORE</a>
        </div>
        <div class="menu">
            <a href="product_list.php">PRODUCTS</a>
            <a href="contact.php">CONTACT</a>
            <a href="cart.php">CART</a>
            <a href="purchases.php">ORDERS</a>
            <a href="log_out.php">LOG OUT</a>
        </div>
    </nav>

    <h1>Compras realizadas</h1>
    <table>
        <tr>
            <th>Id de compra</th>
            <th>Productos comprados</th>
            <th>Total</th>
        </tr>
        <?php foreach ($purchases as $purchase) : ?>
            <tr>
                <td><?php echo $purchase["id"]; ?></td>
                <td>
                    <table>
                        <tr>
                            <th>Nombre del producto</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                        <?php foreach ($purchase["items"] as $item) : ?>
                            <tr>
                                <td><?php echo substr($item["product_name"], 0, 20); ?></td>
                                <td><?php echo $item["amount"]; ?></td>
                                <td>$<?php echo $item["subtotal"]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </td>
                <td>$<?php echo $purchase["total"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <footer>
        <div class="footer-content">
            <p>&copy; <?php echo date("Y"); ?> HEXTECH STORE. Todos los derechos reservados.</p>
            <p><a href="#">Términos y condiciones</a></p>
            <div class="social-media">
                <a href="#" class="social-media-link"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#" class="social-media-link"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#" class="social-media-link"><i class="fab fa-instagram"></i> Instagram</a>
            </div>
        </div>
    </footer>
</body>

</html>
