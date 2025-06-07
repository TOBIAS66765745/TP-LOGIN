<?php
session_start();

require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('683790377939-kjicued7l59g1npoonn93fn0ss9q69om.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/config.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token["error"])) {
        $client->setAccessToken($token['access_token']);

        // Limpiar posibles sesiones anteriores (por si hay mezcla)
        unset($_SESSION['correo']);
        
        $oauth = new Google_Service_Oauth2($client);
        $userData = $oauth->userinfo->get();

        $_SESSION['correo_google'] = $userData->email;

        // Redirigir al acceso correcto
        header('Location: accesocorrecto.php');
        exit();
    }
}

// Si falla el login
header('Location: index.php');
exit();
