<?php
$conex = mysqli_connect("localhost", "root", "", "nusuarios");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Usuario'], $_POST['password'])) {
    $usuario = $_POST['Usuario'];
    $clave = $_POST['password'];

    $consulta = "SELECT * FROM registro_nuevo WHERE Usuario='$usuario'";
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        if (password_verify($clave, $fila['pass_cifrada'])) {
            echo "<h3 class='ok'>¡Bienvenido $usuario!</h3>";
            header("refresh:2;url=accesocorrecto.php");
            exit;
        } else {
            echo "<h3 class='bad'>Contraseña incorrecta</h3>";
        }
    } else {
        echo "<h3 class='bad'>Usuario no encontrado</h3>";
    }
} else {
    echo "<h3 class='bad'>Acceso no permitido</h3>";
    exit;
}
?>
