<!DOCTYPE html>
<html lang="es">

<head>
    <title>HEXTECH STORE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/product_list.css">
    <script type="text/javascript" src="index.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
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
        <table class="table table-bordered">
            <tbody>
                <?php
                    require "conect.php";
                    $con = conecta();
                    $sql = "SELECT * FROM productos WHERE status = 1 and removed = 0";
                    $res = $con->query($sql);
                    $counter = 0;
                    while ($fila = $res->fetch_array()) {
                        $id          = $fila["id"];
                        $name        = $fila["name"];
                        $code        = $fila["code"];
                        $cost        = $fila["cost"];
                        $stock       = $fila["stock"];
                        $image       = $fila["archive"];
                        if ($counter % 3 == 0) {
                            echo "<tr>";
                        }
                        echo '<td class="col-md-4">';
                        if (!empty($image)) {
                            echo '<div class="product-image-wrapper"><img src="../../b_corregidoo/products/'.$image.'" class="img-responsive product-image"></div>';
                        }
                        
                        echo '<h3>'.$name.'</h3>';
                        echo '<p><strong>Code:</strong> '.$code.'</p>';
                        echo '<p><strong>Price:</strong> $'.$cost.'</p>';
                        echo '<button type="button" class="btn btn-primary" onclick="location.href=\'add_cart.php?id=' . $id . '\'">Buy</button>';
                        echo '<button type="button" class="btn btn-primary" onclick="location.href=\'description_product.php?id='.$id.'\'">Description</button>';
                        echo '</td>';
                        if ($counter % 3 == 2) {
                            echo "</tr>";
                        }
                        $counter++;
                    }
                    if ($counter % 3 != 0) {
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <div class="footer-content">
            <p>&copy; <?php echo date("Y"); ?> HEXTECH STORE. Todos los derechos reservados.</p>
            <p><a href="#">Términos y condiciones</a></p>
            <div class="social-media">
                <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
            </div>
        </div>
    </footer>
</body>
</body>

</html>