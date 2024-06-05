<?php
require_once 'db_connection.php';
require_once 'operaciones_db.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$db = connect_db();
// Verificar la conexión
if (!$db) {
    die("Error al conectar: " . mysqli_connect_error());
}


// Verificar si se pasó un email de usuario válido
if (isset($_GET['email'])) {
    $email_usuario = mysqli_real_escape_string($db, $_GET['email']);

    // Consultar la información del usuario utilizando el email
    $consulta = "SELECT * FROM usuarios WHERE email = '$email_usuario'";
    $resultado = mysqli_query($db, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // El usuario existe, array para obtener sus datos
        $usuario = mysqli_fetch_assoc($resultado);

        // Guardar los datos del usuario en la sesión
        $_SESSION['usuario'] = $usuario;
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "Email de usuario no válido.";
    exit;
}


?>

<!DOCTYPE html>
<html>

<body>
    <main>
        <div class='listado'>
            <h3>Gestión de usuarios</h3>
            <h4>Editar usuario</h4>
        </div>

        <?php
        
        $enviadoCorrectamente = false;
        if (isset($_POST["modificar-usuario"]) && validarTodosLosCampos2()) {
            $enviadoCorrectamente = true;
            actualizarVarSesion2(); //Se guardan en variables de sesion y se comprueba saneamiento de datos
        }

        $datosConfirmados = false;

        if (isset($_POST['confirmar-datos'])) {
            echo "<span class='confirmacion-datos'>Se han modificado los datos del usuario.</span>";
            $datosConfirmados = true;
            actualizarEnBD();
            $fecha = date('Y-m-d H:i:s');
            $accion = "Se han modificado los datos del usuario {$_SESSION['usuario']['nombre']}.";
            $log = mysqli_query($db, "INSERT INTO logs (fecha, descripcion) VALUES ('$fecha', '$accion')");
        }

        inicializarTodasVarSesion();

        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Nombre:
                    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : $_SESSION['usuario']['nombre']; ?>" disabled>
                </label>

                <label>Apellidos:
                    <input type="text" name="apellidos" value="<?php echo isset($_POST['apellidos']) && !empty($_POST['apellidos']) ? $_SESSION['apellidos'] : $_SESSION['usuario']['apellidos']; ?>" disabled>
                </label>

                <label>Dni:
                    <input type="text" name="dni" value="<?php echo isset($_POST['dni']) && !empty($_POST['dni']) ? $_SESSION['dni'] : $_SESSION['usuario']['dni']; ?>" disabled>
                </label>

                <label>Email:
                    <input type="email" name="email" value="<?php echo isset($_POST['email']) && !empty($_POST['email']) ? $_SESSION['email'] : $_SESSION['usuario']['email']; ?>" disabled>
                </label>
                <?php if (!$enviadoCorrectamente && !$datosConfirmados) { ?>
                    <div class="clave">
                        <label>Clave:
                            <input type='password' placeholder="Nueva clave" name='clave-nueva' />
                            <input type='password' placeholder="Confirmar nueva clave" name='confirmar-clave-nueva' />
                        </label>
                    </div>
                <?php } ?>
                <?php if (hayErrores("clave")) { ?>
                    <p class='error-formulario'>Las claves no coinciden.</p>
                <?php } ?>


                <label>Tarjeta de crédito:
                    <input type="text" name="tarjeta" value="<?php echo isset($_POST['tarjeta']) ? $_POST['tarjeta'] : $_SESSION['usuario']['tarjeta']; ?>"
                    <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>
                <?php if (hayErrores("tarjeta")) { ?>
                    <p class='error-formulario'>El número de tarjeta no es válido.</p>
                <?php } ?>
                
                <label>Rol:
                    <input type='text' name='rol' value='<?php echo isset($_POST['rol']) ? $_POST['rol'] : $_SESSION["usuario"]["rol"];?>' disabled/>
                </label>

                <?php if (!$enviadoCorrectamente && !$datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='modificar-usuario' value='Modificar usuario'>
                    </label>
                <?php } else if (!$datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='confirmar-datos' value='Confirmar datos'/>
                    </label>
                <?php } ?>

                <?php
                //Si se han confirmado los datos de un usuario, aparecerá un boton para limpiar el formulario
                if ($datosConfirmados) { ?>
                <label>
                    <input type='submit' value="Limpiar" formaction="index.php">
                </label>
                <?php } ?>

                <label>
                    <input type="submit" value="Ver Listado" formaction="listado.php">
                </label>
            </form>
        </div>
    </main>
</body>
</html>