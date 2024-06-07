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
?>
<!DOCTYPE html>
<html>
<?php
include ("partials/head-html.php");
?>

<body>
    <main>
        <div class='listado'>
            <h3>Registro de habitaciones</h3>
            <h4>Añadir nueva habitacion</h4>
        </div>
        <?php

        $enviadoCorrectamente = false;
        //Si se le ha dado a añadir usuario, y los campos son válidos, se actualizarán las variables de sesión 
        if (isset($_POST["add-habitacion"]) && validarTodosLosCampos()) {
            $enviadoCorrectamente = true;
            actualizarVarSesion(); //Se guardan en variables de sesion y se comprueba saneamiento de datos
        }

        $datosConfirmados = false;

        //Inserción en la base de datos si se le ha dado al botón de confirmar
        if (isset($_POST['confirmar-habitacion'])) { ?>
            <span class="confirmacion-datos">Se ha añadido una nueva habitacion.</span>
            <?php
            $datosConfirmados = true;
            insertarEnBD();
            $fecha = date('Y-m-d H:i:s');
            $accion = "Se ha añadido nueva habitación.";
            $log = mysqli_query($db, "INSERT INTO logs (fecha, descripcion) VALUES ('$fecha', '$accion')");
        }

        // Si se ha presionado el botón de limpiar, limpia los campos del formulario.
        if (isset($_POST['limpiar-formulario'])) {
            $_POST = array();
        }
        ?>

        <div class="formulario-editar">
            <form action="" method="POST" novalidate>
                <label>Numero-Habitacion:
                    <input type="text" name="numero" value="<?php echo isset($_POST['numero']) ? $_POST['numero'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["numero"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados)
                              echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("numero")) { ?>
                    <p class='error-formulario'>Debe escribir la capacidad de la habitacion o ya hay alguna habitacion
                        registrada con ese numero.</p>
                <?php } ?>


                <label>Capacidad:
                    <input type="text" name="capacidad" placeholder="Numero" value="<?php echo isset($_POST['capacidad']) ? $_POST['capacidad'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["capacidad"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados)
                              echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("capacidad")) { ?>
                    <p class='error-formulario'>Debe escribir la capacidad de la habitacion.</p>
                <?php } ?>


                <label>Precio:
                    <input type="text" name="precio" placeholder="Numero" value="<?php echo isset($_POST['precio']) ? $_POST['precio'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["precio"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados)
                              echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("precio")) { ?>
                    <p class='error-formulario'>Debe escribir el precio de la habitacion .</p>
                <?php } ?>



                <label>Descripción:
                    <textarea name="descripcion" rows="4" cols="50" <?php if ($enviadoCorrectamente || $datosConfirmados)
                        echo "disabled"; ?>>
                    <?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : ""; ?></textarea>
                </label>

                <?php
                if (hayErrores("descripcion")) { ?>
                    <p class='error-formulario'>Debe escribir la descripción de la habitación.</p>
                <?php } ?>


                <?php
                //Si no se han enviado los datos ni se han confirmado, aparecerá el botón de añadir usuario
                if (!$enviadoCorrectamente && !$datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='add-habitacion' value='Añadir habitacion'>
                    </label>
                    <?php

                    //Si no se han confirmado, aparecerá el botón de confirmar datos
                } else if (!$datosConfirmados) {
                    ?>
                        <label>
                            <input type='submit' name='confirmar-habitacion' value='Confirmar habitacion' />
                        </label>
                <?php } ?>

                <?php
                //Si se han confirmado, aparecerá un boton para limpiar el formulario y otro para ver el listado de usuarios
                if ($datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='limpiar-formulario' value='Limpiar'>
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