<?php
session_start();
$conex = mysqli_connect("localhost", "root", "", "nusuarios");

$email = $_GET['e'] ?? $_POST['email'] ?? '';
$token = $_GET['t'] ?? $_POST['token'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clave_nueva'])) {
    $clave_nueva = trim($_POST['clave_nueva']);
    $hash = password_hash($clave_nueva, PASSWORD_DEFAULT, ['cost' => 10]);

    $verif = mysqli_query($conex, "SELECT * FROM recupera WHERE email='$email' AND token='$token' LIMIT 1");
    if (mysqli_fetch_assoc($verif)) {
        mysqli_query($conex, "UPDATE registro_nuevo SET pass_cifrada='$hash' WHERE email='$email' LIMIT 1");
        mysqli_query($conex, "DELETE FROM recupera WHERE email='$email' LIMIT 1");

        $_SESSION['rta'] = "✅ Contraseña actualizada correctamente. Ya podés iniciar sesión.";
        header("Location: login.php");
        exit;
    } else {
        $error = "❌ Token inválido o expirado.";
    }
} else {
    if ($email && $token) {
        $validar = mysqli_query($conex, "SELECT * FROM recupera WHERE email='$email' AND token='$token' LIMIT 1");
        if (!mysqli_fetch_assoc($validar)) {
            $error = "❌ Token inválido o expirado.";
        }
    } else {
        $error = "Faltan datos necesarios en el enlace.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Recuperación</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #f2f2f2;
        }

        .form-container {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 10px;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 1.2rem;
            color: #333;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .error {
            color: #b30000;
            margin-top: 10px;
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        .back-link {
            margin-top: 20px;
            display: block;
            text-align: center;
            text-decoration: none;
            color: #007bff;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Restablecer Contraseña</h2>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
        <a href="login.php" class="back-link">Volver al inicio</a>
    <?php elseif ($email && $token): ?>
        <form method="POST">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <input type="password" name="clave_nueva" placeholder="Nueva Contraseña" required>
            <button type="submit">Actualizar Contraseña</button>
        </form>
        <a href="login.php" class="back-link">Volver al inicio</a>
    <?php endif; ?>
</div>

</body>
</html>
