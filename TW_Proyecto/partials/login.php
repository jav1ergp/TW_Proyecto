<?php
//Configuración de variables de sesión y BBDD
$errorUsuarioClave = false;

if (isset($_POST['cerrar-sesion'])) {
    global $db;
    $fecha = date('Y-m-d H:i:s');
    $accion = "El usuario ha cerrado sesión.";
    mysqli_query($db, "INSERT INTO logs (fecha, descripcion) VALUES ('$fecha', '$accion')");
    session_unset(); // Eliminar todas las variables de sesión 
}

# Verificamos el login
if (isset($_POST["iniciar-sesion"])) {

    $dbUser = mysqli_query($db, "SELECT * FROM usuarios WHERE email='" . mysqli_real_escape_string($db, $_POST["usuario"]) . "'");
    $user = mysqli_fetch_assoc($dbUser);

    //Comprobamos con las funciones de password_verify si el hash almacenado en la BBDD es la contraseña correcta
    if ($dbUser && mysqli_num_rows($dbUser) > 0) {
        if (password_verify($_POST["clave"], $user["clave"])) {
            $_SESSION['usuario'] = $user;
            $fecha = date('Y-m-d H:i:s');
            $accion = "El usuario {$_SESSION['usuario']['email']} ha iniciado sesión.";
            $log = mysqli_query($db, "INSERT INTO logs (fecha, descripcion) VALUES ('$fecha', '$accion')");
        } else {
            $errorUsuarioClave = true;
            $fecha = date('Y-m-d H:i:s');
            $accion = "Un usuario ha intentado iniciar sesión de manera incorrecta.";
            $log = mysqli_query($db, "INSERT INTO logs (fecha, descripcion) VALUES ('$fecha', '$accion')");
        }
    } else {
        $errorUsuarioClave = true;
        $fecha = date('Y-m-d H:i:s');
        $accion = "Un usuario ha intentado iniciar sesión de manera incorrecta.";
        $log = mysqli_query($db, "INSERT INTO logs (fecha, descripcion) VALUES ('$fecha', '$accion')");
    }
}

?>