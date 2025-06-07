<?php
require_once 'vendor/autoload.php';

$clientID = '683790377939-kjicued7l59g1npoonn93fn0ss9q69om.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/config.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

$login_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
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

        .home-container h1 {
            margin-bottom: 1rem;
            color: #333;
        }

        .home-container p {
            margin-bottom: 2rem;
            color: #666;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
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

        .google-register {
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid #ccc;
            color: #444;
        }

        .google-register img {
            width: 20px;
            margin-right: 10px;
        }

        .login-link, .forgot-link {
            margin-top: 1rem;
            font-size: 14px;
            color: #333;
        }

        .login-link a, .forgot-link a {
            color: #0069d9;
            text-decoration: none;
        }

        .login-link a:hover, .forgot-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h1>Bienvenido</h1>
        <p>Inicia sesión con tu cuenta o accede con Google.</p>

        <a href="/login.php" class="btn">Iniciar sesión</a>

        <a href="<?php echo $login_url; ?>" class="btn google-register">
            <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo">
            Iniciar sesión con Google
        </a>

        <div class="login-link">
            ¿No tienes una cuenta? <a href="/alta.php">Regístrate aquí</a>
        </div>

        <div class="forgot-link">
            ¿Olvidaste tu contraseña? <a href="/recupera_pass.php">Recupérala aquí</a>
        </div>
    </div>
</body>
</html>
