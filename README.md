# TP-LOGIN
index.php
Es la página principal. Desde acá se puede acceder al login tradicional o iniciar sesión con Google. También hay enlaces para registrarse o recuperar la contraseña.

login.php
Se encarga de validar el usuario y la contraseña contra los datos guardados en la base de datos. Si todo está bien, se inicia la sesión y se redirige al panel de acceso. También se asegura de eliminar cualquier sesión de Google que esté activa.

config.php
Este archivo gestiona el login con Google. Cuando el usuario autoriza la app, se guarda su correo y se lo redirige al panel de acceso.

accesocorrecto.php
Es la página que se muestra luego de iniciar sesión. Muestra el correo con el que se ingresó, ya sea desde la base de datos o desde Google. También tiene el botón para cerrar sesión.

cerrar_sesion.php
Se encarga de cerrar completamente la sesión, borrando cualquier dato guardado, tanto de Google como del login tradicional.

recupera_pass.php
Permite solicitar la recuperación de contraseña. Si el correo existe, se genera un token y una clave temporal, y se muestra un enlace para confirmar el cambio de contraseña.

recupera_pass_confirmar.php
Al hacer clic en el enlace del mail, este archivo se encarga de verificar el token, cambiar la contraseña en la base de datos y eliminar el token para que no pueda volver a usarse
