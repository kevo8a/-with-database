<!DOCTYPE html>
<html>

<head>
    <title>Nuevo empleado</title>
    <link rel="stylesheet" type="text/css" href="../CSS/registrer_client.css">
    <script src="../JS/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../JS/index.js"></script>
</head>

<body>
    <h1>Create your Account</h1>
    <form method="post" action="save_client.php" enctype="multipart/form-data">
        <label for="name">Name: <input type="text" id="name" name="name" required></label>
        </br>
        <label for="last_name">Last: <input type="text" id="last_name" name="last_name" required></label>
        </br>
        <label for="email">Email: <input type="email" id="email" name="email"  required onblur="validate_email();"></label>
        
        <div id="message"></div>
        </br>
        <label for="pass">Contraseña: <input type="password" id="pass" name="pass" required></label>
        </br>
        <button type="submit" >Create Account</button> 
    </form>
</body>

</html>
