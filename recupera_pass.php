<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $conex = mysqli_connect("localhost", "root", "", "nusuarios");
    $email = mysqli_real_escape_string($conex, $_POST['email']);
    $c = "SELECT *, IFNULL(email, 'registro_nuevo') as email FROM registro_nuevo WHERE email='$email' LIMIT 1";
    $f = mysqli_query($conex, $c);
    $a = mysqli_fetch_assoc($f);

    if (!$a) {
        $mensaje = "<p style='color:red;'>Usuario inexistente</p>";
    } else {
        $token = md5($a['email'] . time() . rand(1000, 9999));
        $clave_nueva = rand(10000000, 99999999);
        $c2 = "INSERT INTO recupera SET email='$email', token='$token', fecha=NOW(), clave_nueva='$clave_nueva' ON DUPLICATE KEY UPDATE token='$token', clave_nueva='$clave_nueva'";
        mysqli_query($conex, $c2);

        $link = "http://localhost/recupera_pass_confirmar.php?e=$email&t=$token";

        $mensaje = <<<EMAIL
        <div class="message">
            <p>Hola <strong>{$a['email']}</strong></p>
            <p>Tu nueva clave es: <code>$clave_nueva</code></p>
            <p><a href="$link">Haz clic aquí para confirmar el cambio</a></p>
            <p>Si tú no solicitaste este cambio, ignora este mensaje.</p>
        </div>
        EMAIL;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #dee6f0, #c8d7ee);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .home-container {
            background-color: white;
            padding: 3rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            text-align: center;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            background-color: #0069d9;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0053b3;
        }

        .message {
            margin-top: 1rem;
            text-align: left;
        }

        code {
            background: lightyellow;
            color: darkred;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h1>Recuperar contraseña</h1>
        <p>Ingresa tu correo para recuperar el acceso</p>

        <form action="recupera_pass.php" method="post">
            <input type="email" name="email" placeholder="Ingrese Email" required>
            <input type="submit" value="Enviar">
        </form>

        <?php if (isset($mensaje)) echo $mensaje; ?>
    </div>
</body>
</html>
