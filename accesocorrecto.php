<?php
session_start();

$correo = '';

// Validar sesión activa (ya sea tradicional o Google)
if (isset($_SESSION['user_email'])) {
    $correo = $_SESSION['user_email'];
} elseif (isset($_SESSION['correo_google'])) {
    $correo = $_SESSION['correo_google'];
} elseif (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Correcto</title>
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

        .access-container {
            background-color: white;
            padding: 3rem 2.5rem;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            text-align: center;
        }

        .access-container h1 {
            margin-bottom: 1rem;
            color: #333;
        }

        .access-container p {
            margin-bottom: 2rem;
            color: #666;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0069d9;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .btn:hover {
            background-color: #0053b3;
        }
    </style>
</head>
<body>
    <div class="access-container">
        <h1>Bienvenido</h1>
        <p>Has iniciado sesión con: <strong><?php echo htmlspecialchars($correo); ?></strong></p>
        <a href="cerrar_sesion.php" class="btn">Cerrar sesión</a>
    </div>
</body>
</html>
