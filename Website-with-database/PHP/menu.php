<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}
require "conect.php";
$con = conecta();
// Obtener una imagen aleatoria de la carpeta "banners"
$bannerFiles = glob("../../b_corregidoo/.//BANNERS/" . "*");

$sql = "SELECT * FROM productos WHERE status = 1 and removed = 0 ORDER BY RAND() LIMIT 3";
$res = $con->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>HEXTECH STORE</title>
    <link rel="stylesheet" type="text/css" href="../CSS/menu.css">
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

    <div class="contenido">
        <h1>BIENVENIDO <?php echo strtoupper($_SESSION["name"]); ?></h1>
        <img src="<?php echo $bannerFiles[array_rand($bannerFiles)] ?>" alt="Banner">
    </div>
    <table class="table table-bordered">
            <?php
            $counter = 0;
            while ($fila = $res->fetch_array()) {
                $id          = $fila["id"];
                $name        = $fila["name"];
                $cost        = $fila["cost"];
                $image       = $fila["archive"];
                if ($counter % 3 == 0) {
                    echo "<tr>";
                }
                echo '<td class="col-md-4">';
                if (!empty($image)) {
                    echo '<div class="product-image-wrapper"><img src="../../b_corregidoo/products/' . $image . '" class="img-responsive product-image"></div>';
                }

                echo '<h3>' . $name . '</h3>';
                echo '<p><strong>Price:</strong> $' . $cost . '</p>';
                echo '<button type="button" class="btn btn-primary" onclick="location.href=\'description_product.php?id=' . $id . '\'">Check It</button>';
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