<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: 1login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>B</title>
    <link rel="stylesheet" type="text/css" href="../CSS/cart.css">
    <script src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="index.js"></script>
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../IMG/LOGO/LOGO.jpg">HEXTECH STORE</a>
        </div>
        <div class="menu">
            <a href="menu.php">MENU</a>
            <a href="product_list.php">PRODUCTS</a>
            <a href="contact.php">CONTACT</a>
            <a href="purchases.php">ORDERS</a>
            <a href="log_out.php">LOG OUT</a>
        </div>
    </nav>

    <div class="table">
        <div class="fila">
            <div class="col">
            </div>
        </div>
        <div class="fila">
            <div class="title">Cart</div>
        </div>
        <div class="fila">
            <div class="col">Product</div>|
            <div class="col">Amount</div>|
            <div class="col">Price</div>|
            <div class="col">Subtotal</div>|
            <div class="col">Delete</div>
        </div>
        <?php
        require "conect.php";
        $con            = conecta();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $amount = $_POST["amount"];
            $sql = "UPDATE product_orders SET amount = $amount WHERE id = $id";
            $res = $con->query($sql);
            if (!$res) {
                echo "Error in query: " . $con->error;
            }
        }
        $sql            = "SELECT * FROM product_orders";
        $res            = $con->query($sql);
        $total = 0;
        while ($row = $res->fetch_array()) {
            $id             = $row["id"];
            $name           = $row["name"];
            $amount         = $row["amount"];
            $price          = $row["price"];
            $subtotal       = $amount * $price;
            $total          += $subtotal;

            echo "<div class='fila'>";
            echo "<div class='col'>$name</div>";
            echo "<div class='col'><form method='post'><input type='hidden' name='id' value='$id'><input type='number' name='amount' value='$amount' min='1' max='100' onchange='this.form.submit()'></form></div>";
            echo "<div class='col'>$$price</div>";
            echo "<div class='col'>$$subtotal</div>";
            echo "<div class='col'><form method='get' action='delete_product.php'><input type='hidden' name='id' value='$id'><input type='submit' value='Delete'></form></div>";
            echo "</div>";
        }
        ?>
        <div class="fila">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"><strong>Total:</strong> $<?php echo $total; ?></div>
            <div class="col">
                <form method="post" action="process_purchase.php">
                    <input type="submit" value="Finalize Purchaze">
            </div>

        </div>
    </div>
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