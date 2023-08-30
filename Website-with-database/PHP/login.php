<!DOCTYPE html>
<html>

<head>
    <title>HEXTECH STORE</title>
    <script src="../JS/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../JS/index.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">


</head>

<body>
    <img src="../../b_corregidoo/LOGO/LOGO.jpg" alt="Logo" class="logo">
    <form action="validate_user.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required><br><br>
        <button type="submit">Sign In</button>

    </form>
    <form action="register_client.php">
        <button type="submit">Create</button>
        </br>If you don't have account registrer HERE!!!
    </form>
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

</html>