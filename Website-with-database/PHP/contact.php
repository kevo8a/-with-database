<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Server settings
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'kevin2154442724@gmail.com'; // SMTP username
        $mail->Password = '2154442724'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('kevin2154442724@gmail.com', 'dasd');
        $mail->addAddress('kevin8arocha@gmail.com', 'asd'); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $_POST['subject']; // Use the subject from the form
        $mail->Body = $_POST['message']; // Use the message from the form

        $mail->send();
        $successMessage = 'Message has been sent';
    } catch (Exception $e) {
        $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>HEXTECH STORE</title>
    <link rel="stylesheet" type="text/css" href="../CSS/contact.css">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../IMG/LOGO/LOGO.jpg">HEXTECH STORE</a>
        </div>
        <div class="menu">
            <a href="menu.php">MENU</a>
            <a href="product_list.php">PRODUCTS</a>
            <a href="cart.php">CART</a>
            <a href="purchases.php">ORDERS</a>
            <a href="log_out.php">LOG OUT</a>
        </div>
    </nav>
    <h1>DANOS TU OPINION!!!</h1>

    <?php if (isset($successMessage)) { ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php } ?>

    <?php if (isset($errorMessage)) { ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php } ?>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="subject">Asunto:</label>
        <input type="text" name="subject" id="subject" required><br><br>

        <label for="message">Mensaje:</label><br>
        <textarea name="message" id="message" rows="5" required></textarea><br><br>

        <input type="submit" value="Enviar">
    </form>
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
