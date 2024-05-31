<?php
require_once 'db_connection.php';
require_once 'operaciones_db_hab.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$db = connect_db();
// Verificar la conexión
if (!$db) {
    die("Error al conectar: " . mysqli_connect_error());
}


// Verificar si se pasó un email de usuario válido
if (isset($_GET['numero'])) {
    $numero_habitacion = mysqli_real_escape_string($db, $_GET['numero']);

    // Consultar la información del usuario utilizando el email
    $consulta = "SELECT * FROM habitacion WHERE numero = '$numero_habitacion'";
    $resultado = mysqli_query($db, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // El usuario existe, array para obtener sus datos
        $habitacion = mysqli_fetch_assoc($resultado);

        // Guardar los datos del usuario en la sesión
        $_SESSION['habitacion'] = $habitacion;
    } else {
        echo "Numero no encontrado.";
        exit;
    }
} else {
    echo "Numero de habitacion no válido.";
    exit;
}


?>

<!DOCTYPE html>
<html>

<body>
    <main>
        <div class='listado'>
            <h3>Gestión de Habitaciones</h3>
            <h4>Editar habitacion</h4>
        </div>

        <?php
        
        $enviadoCorrectamente = false;
        if (isset($_POST["modificar-habitacion"]) && validarTodosLosCampos2()) {
            $enviadoCorrectamente = true;
            actualizarVarSesion2(); //Se guardan en variables de sesion y se comprueba saneamiento de datos
        }

        $datosConfirmados = false;

        if (isset($_POST['confirmar-habitacion'])) {
            echo "<span class='confirmacion-datos'>Se han modificado los datos de la habitacion.</span>";
            $datosConfirmados = true;
            actualizarEnBD();
        }

        inicializarTodasVarSesion();
        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Numero-Habitacion:
                    <input type="text" name="numero" value="<?php echo isset($_POST['numero']) && !empty($_POST['numero']) ? $_SESSION['numero'] : $_SESSION['habitacion']['numero']; ?>" disabled>
                </label>

                <label>Capacidad:
                    <input type="text" name="capacidad" placeholder="Numero" value="<?php echo isset($_POST['capacidad']) ? $_SESSION['capacidad'] : $_SESSION['habitacion']['capacidad']; ?>"
                    <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>
                <?php
                if (hayErrores("capacidad")) { ?>
                    <p class='error-formulario'>Debe escribir la capacidad de la habitacion.</p>
                <?php } ?>
            

                <label>Precio:
                    <input type="text" name="precio" placeholder="Numero" value="<?php echo isset($_POST['precio']) ? $_SESSION['precio'] : $_SESSION['habitacion']['precio']; ?>"
                    <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("precio")) { ?>
                    <p class='error-formulario'>Debe escribir el precio de la habitacion .</p>
                <?php } ?>


                <label>Descripción:
                    <textarea name="descripcion" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                    <?php echo isset($_POST['descripcion']) ? $_SESSION['descripcion'] : $_SESSION['habitacion']['descripcion']; ?></textarea>
                </label>

                <?php
                if (hayErrores("descripcion")) { ?>
                    <p class='error-formulario'>Debe escribir la descripción de la habitación.</p>
                <?php } ?>

                <?php if (!$enviadoCorrectamente && !$datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='modificar-habitacion' value='Modificar habitacion'>
                    </label>
                <?php } else if (!$datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='confirmar-habitacion' value='Confirmar habitacion'/>
                    </label>
                <?php } ?>

                <label>
                    <input type="submit" value="Ver Listado" formaction="listado_hab.php">
                </label>
            </form>
        </div>
    </main>
</body>
</html>