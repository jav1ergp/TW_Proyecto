<?php
    //Configuración de variables de sesión y BBDD
    $errorUsuarioClave = false;

    if (isset($_POST['cerrar-sesion'])){
        $fecha = date('Y-m-d H:i:s');
        $accion = "El usuario {$_SESSION['usuario']['email']} ha cerrado sesión.";
        $insercionLog = mysqli_query($db, "INSERT INTO Logs (fecha, accion) VALUES ('$fecha', '$accion')");
        $_SESSION = array(); // Limpiar todas las variables de sesión
        session_destroy(); // Destruir la sesión actual
        header("Location: index.php");
    }

    # Verificamos el login
    if (isset($_POST["iniciar-sesion"])){ 
       
        $dbUser = mysqli_query($db, "SELECT * FROM usuarios WHERE email='" . mysqli_real_escape_string($db, $_POST["usuario"]) . "'");
        $user = mysqli_fetch_assoc($dbUser);
        
        //Comprobamos con las funciones de password_verify si el hash almacenado en la BBDD es la contraseña correcta
        if ($dbUser && mysqli_num_rows($dbUser) > 0){
            if (password_verify($_POST["clave"], $user["clave"])){
                $_SESSION["usuario"] = $user;
                $fecha = date('Y-m-d H:i:s');
                $accion = "El usuario {$_SESSION['usuario']['email']} ha iniciado sesión.";
                $insercionLog = mysqli_query($db, "INSERT INTO Logs (fecha, accion) VALUES ('$fecha', '$accion')");
            } else {
                $errorUsuarioClave = true;
            }
        } else {
                $errorUsuarioClave = true;
        }
    }
?>