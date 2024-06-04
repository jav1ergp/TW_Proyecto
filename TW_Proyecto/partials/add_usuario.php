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
?>
<!DOCTYPE html>
<html>
<?php 
    include("partials/head-html.php");
?>

<body>
    <main>
        <div class='listado'>
            <h3>Registro de usuarios</h3>
            <h4>Añadir nuevo usuario</h4>
        </div>
        <?php

        $enviadoCorrectamente = false;
        //Si se le ha dado a añadir usuario, y los campos son válidos, se actualizarán las variables de sesión 
        if (isset($_POST["add-usuario"]) && validarTodosLosCampos()) {
            $enviadoCorrectamente = true;
            actualizarVarSesion(); //Se guardan en variables de sesion y se comprueba saneamiento de datos
        }

        $datosConfirmados = false;

        //Inserción en la base de datos si se le ha dado al botón de confirmar
        if (isset($_POST['confirmar-datos'])) { ?>
            <span class="confirmacion-datos">Se ha añadido un nuevo usuario.</span>
            <?php
            $datosConfirmados = true;
            insertarEnBD();
            $fecha = date('Y-m-d H:i:s');
            $accion = "Se ha añadido al nuevo usuario {$_SESSION['nombre']} con DNI: {$_SESSION['dni']}.";
            $log = mysqli_query($db, "INSERT INTO logs (fecha, descripcion) VALUES ('$fecha', '$accion')");
        }

        // Si se ha presionado el botón de limpiar, limpia los campos del formulario.
        if (isset($_POST['limpiar-formulario'])) {
            $_POST = array();
        }
        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Nombre:
                    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["nombre"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("nombre")) { ?>
                    <p class='error-formulario'>Debe escribir su nombre.</p>
                <?php } ?>


                <label>Apellidos:
                    <input type="text" name="apellidos" value="<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["apellidos"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("apellidos")) { ?>
                    <p class='error-formulario'>Debe escribir sus apellidos.</p>
                <?php } ?>

                <label>Dni:
                    <input type="text" name="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["dni"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("dni")) { ?>
                    <p class='error-formulario'>El DNI no es valido.</p>
                <?php } ?>

                <label>Email:
                    <input type="email" name="email" value="<?php echo isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["email"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("email")) { ?>
                    <p class='error-formulario'>El email no es válido o ya hay alguien registrado con ese
                    email.</p>
                <?php } ?>


                <?php
                if (!$enviadoCorrectamente && !$datosConfirmados) { ?>
                    <div class="clave">
                        <label>Clave:
                            <input type='password' placeholder="Nueva clave" name='clave-nueva' />
                            <input type='password' placeholder="Confirmar nueva clave" name='confirmar-clave-nueva' />
                        </label>
                    </div>

                <?php
                }

                if (hayErrores("clave")) { ?>
                    <p class='error-formulario'>Las claves no coinciden o son menores de 5 digitos.</p>
                <?php } ?>

                <label>Tarjeta de crédito:
                    <input type="text" name="tarjeta" value="<?php echo isset($_POST['tarjeta']) ? $_POST['tarjeta'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["tarjeta"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>
                
                <?php if (hayErrores("tarjeta")) { ?>
                    <p class='error-formulario'>La tarjeta de crédito no es válida.</p>
                <?php } ?>

                <?php if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] === "recepcionista")) { ?>
                    <label>Rol:
                        <select name="rol" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                            <option value="cliente" <?php if (isset($_POST['rol']) && $_POST['rol'] == 'cliente') echo 'selected'; ?>>Cliente</option>
                        </select>
                    </label>
                <?php } else { ?>
                    <label>Rol:
                        <select name="rol" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                            <option value="cliente" <?php if (isset($_POST['rol']) && $_POST['rol'] == 'cliente') echo 'selected'; ?>>Cliente</option>
                            <option value="recepcionista" <?php if (isset($_POST['rol']) && $_POST['rol'] == 'recepcionista') echo 'selected'; ?>>Recepcionista</option>
                            <option value="administrador" <?php if (isset($_POST['rol']) && $_POST['rol'] == 'administrador') echo 'selected'; ?>>Administrador</option>
                        </select>
                    </label>
                <?php } ?>


                <?php
                //Si no se han enviado los datos ni se han confirmado, aparecerá el botón de añadir usuario
                if (!$enviadoCorrectamente && !$datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='add-usuario' value='Añadir usuario'>
                    </label>
                    <?php

                    //Si no se han confirmado, aparecerá el botón de confirmar datos
                } else if (!$datosConfirmados) {
                    ?>
                        <label>
                            <input type='submit' name='confirmar-datos' value='Confirmar datos' />
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
                    <input type="submit" value="Ver Listado" formaction="listado.php">
                </label>
            </form>
        </div>
    </main>

</body>

</html>
