<?php
session_start();

// ⚠️ Limpia sesión de Google
unset($_SESSION['correo_google']);

$conex = mysqli_connect("localhost", "root", "", "nusuarios");

$mostrar_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['Usuario']);
    $clave = trim($_POST['Clave']);

    if ($usuario !== '' && $clave !== '') {
        $sql = "SELECT * FROM registro_nuevo WHERE Usuario = '$usuario'";
        $resultado = mysqli_query($conex, $sql);

        if ($row = mysqli_fetch_assoc($resultado)) {
            $hash = $row['pass_cifrada'];

            if (password_verify($clave, $hash)) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['user_email'] = $row['EMail']; // Se usará en accesocorrecto.php
                header('Location: accesocorrecto.php');
                exit;
            } else {
                $mostrar_error = true;
            }
        } else {
            $mostrar_error = true;
        }
    } else {
        $mostrar_error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>
<body>

<div class="home-container">
    <h2>Iniciar Sesión</h2>

    <form method="POST">
        <input type="text" name="Usuario" placeholder="Usuario" required>
        <input type="password" name="Clave" placeholder="Contraseña" required>
        <button type="submit" class="btn">Ingresar</button>
    </form>

    <div class="login-link" style="margin-top: 1rem;">
        <a href="recupera_pass.php">¿Olvidaste tu contraseña?</a>
    </div>
</div>

<?php if ($mostrar_error): ?>
<div class="modal-overlay" style="display:flex">
    <div class="modal-box">
        <p>Usuario inexistente o contraseña incorrecta.</p>
        <button class="close-btn" onclick="this.parentElement.parentElement.style.display='none'">Cerrar</button>
    </div>
</div>
<?php endif; ?>

</body>
</html>
