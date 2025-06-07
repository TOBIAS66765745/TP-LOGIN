<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registro-box {
            background: white;
            padding: 20px;
            border: 1px solid #ccc;
            width: 320px;
            border-radius: 8px;
        }

        .registro-box h3 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .ok { color: green; text-align: center; }
        .bad { color: red; text-align: center; }
    </style>
</head>
<body>
    <?php
    $conex = mysqli_connect("localhost", "root", "", "nusuarios");
    ?>
    <div class="registro-box">
        <h3>Registro de Usuario</h3>
        <form action="alta.php" method="post">
            <input type="text" name="nombre" placeholder="Nuevo Nombre">
            <input type="text" name="apellido" placeholder="Nuevo Apellido">
            <input type="text" name="email" placeholder="Ingresar Email">
            <input type="text" name="Usuario" placeholder="Ingresar Usuario">
            <input type="password" name="password" placeholder="Ingrese Contraseña">
            <input type="password" name="Cpassword" placeholder="Confirme Contraseña">
            <input type="submit" name="Enviar" value="Registrar">
        </form>

        <?php    
        if(isset($_POST['Enviar'])) {
            if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['Usuario']) >= 1 && strlen($_POST['password']) >= 1 && $_POST['password'] === $_POST['Cpassword']) {
                $Nombre = trim($_POST['nombre']);
                $Apellido = trim($_POST['apellido']);
                $EMail = trim($_POST['email']);
                $Usuario = trim($_POST['Usuario']);
                $Clave = trim($_POST['password']);
                $pass_cifrada = password_hash($Clave, PASSWORD_DEFAULT, array("cost" => 10));
                $consulta = "INSERT INTO registro_nuevo (Nombre, Apellido, EMail, Usuario, pass_cifrada) VALUES ('$Nombre','$Apellido','$EMail','$Usuario','$pass_cifrada')";
                $resultado = mysqli_query($conex, $consulta);
                if ($resultado) {
                    echo '<h3 class="ok">¡Te has inscripto correctamente!</h3>';
                    header("refresh:5;url=accesocorrecto.php");
                } else {
                    echo '<h3 class="bad">¡Ups ha ocurrido un error!</h3>';
                }
            } else {
                echo '<h3 class="bad">¡Por favor complete los campos correctamente!</h3>';
            }
        }
        ?>
    </div>
</body>
</html>
