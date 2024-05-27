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
        $_SESSION['usuario_editar'] = $usuario;
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "Email de usuario no válido.";
    exit;
}


function actualizar_admin($campo){
    global $db;
    if ($_SESSION["$campo"] != $_SESSION["usuario_editar"]["$campo"]){
        $query = mysqli_query($db, "UPDATE usuarios SET $campo = '" . mysqli_real_escape_string($db, $_SESSION["$campo"]) . "' WHERE email = '" . mysqli_real_escape_string($db, $_SESSION["usuario_editar"]["email"]) . "'");
        if ($query && mysqli_affected_rows($db) > 0) {
            // La consulta se ejecutó correctamente y se actualizaron filas en la base de datos
            $fecha = date('Y-m-d H:i:s');
            $accion = "El administrador {$_SESSION['usuario']['email']} ha editado el perfil de {$_SESSION['usuario_editar']['email']}.";
            //$insercionLog = mysqli_query($db, "INSERT INTO Logs (fecha, accion) VALUES ('$fecha', '$accion')");
            // Actualiza la variable de sesión con el nuevo valor
            $_SESSION["usuario_editar"]["$campo"] = $_SESSION["$campo"];

            if ($_SESSION["usuario"]["email"] == $_SESSION["usuario_editar"]["email"]){
                $_SESSION["usuario"]["$campo"] = $_SESSION["$campo"];
            }
        } else {
            // La consulta falló o no se realizaron cambios en la base de datos
        }
    }
}

function actualizarEnBD_admmin(){
    actualizar_admin("nombre");
    actualizar_admin("apellidos");
    actualizar_admin("dni");
    actualizar_admin("clave");
    actualizar_admin("tarjeta");
    actualizar_admin("rol");
}

function actualizarVarSesion_admin(){
    $_SESSION['nombre'] = htmlentities(strip_tags($_POST['nombre']));
    $_SESSION['apellidos'] = htmlentities(strip_tags($_POST['apellidos']));
    $_SESSION['dni'] = htmlentities(strip_tags($_POST['dni']));
    $_SESSION['tarjeta'] = htmlentities(strip_tags($_POST['tarjeta']));
    $_SESSION['rol'] = htmlentities(strip_tags($_POST['rol']));
    if (!empty($_POST['clave-nueva'])) {
        $hash = password_hash(htmlentities(strip_tags($_POST['clave-nueva'])), PASSWORD_DEFAULT);
        $_SESSION['clave'] = $hash;
    }
}

function inicializarVarSesion_admin($campo) {
    global $enviadoCorrectamente;
    global $datosConfirmados;
    if (!$datosConfirmados && !$enviadoCorrectamente) {
        $_SESSION[$campo] = $_SESSION["usuario_editar"][$campo];
    }
}

function inicializarTodasVarSesion_admin(){
    inicializarVarSesion_admin("nombre");
    inicializarVarSesion_admin("apellidos");
    inicializarVarSesion_admin("dni");
    inicializarVarSesion_admin("clave");
    inicializarVarSesion_admin("tarjeta");
    inicializarVarSesion_admin("rol");
}


function validarTodosLosCampos_admin()
{
    $nombreValido = campoEsValido("nombre");
    $apellidosValidos = campoEsValido("apellidos");
    $dniValido = campoEsValido("dni");
    $claveValida = campoEsValido("clave");
    $tarjetaValida = campoEsValido("tarjeta");
  
    return $nombreValido && $apellidosValidos && $dniValido && $claveValida && $tarjetaValida;
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
        if (isset($_POST["modificar-usuario"]) && validarTodosLosCampos_admin()) {
            $enviadoCorrectamente = true;
            actualizarVarSesion_admin(); //Se guardan en variables de sesion y se comprueba saneamiento de datos
        }

        $datosConfirmados = false;

        if (isset($_POST['confirmar-datos'])) {
            echo "<span class='confirmacion-datos'>Se han modificado los datos del usuario.</span>";
            $datosConfirmados = true;
            actualizarEnBD_admmin();
        }

        inicializarTodasVarSesion_admin();

        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Nombre:
                    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_SESSION['nombre'] : $_SESSION['usuario_editar']['nombre']; ?>" 
                    <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("nombre")) { ?>
                    <p class='error-formulario'>Debe escribir su nombre.</p>
                <?php } ?>


                <label>Apellidos:
                    <input type="text" name="apellidos" value="<?php echo isset($_POST['apellidos']) && !empty($_POST['apellidos']) ? $_SESSION['apellidos'] : $_SESSION['usuario_editar']['apellidos']; ?>" 
                    <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("apellidos")) { ?>
                    <p class='error-formulario'>Debe escribir sus apellidos.</p>
                <?php } ?>


                <label>Dni:
                    <input type="text" name="dni" value="<?php echo isset($_POST['dni']) && !empty($_POST['dni']) ? $_SESSION['dni'] : $_SESSION['usuario_editar']['dni']; ?>" 
                    <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("dni")) { ?>
                    <p class='error-formulario'>El DNI no es valido.</p>
                <?php } ?>


                <label>Email:
                    <input type="email" name="email" value="<?php echo isset($_POST['email']) && !empty($_POST['email']) ? $_SESSION['email'] : $_SESSION['usuario_editar']['email']; ?>" disabled>
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
                    <input type="text" name="tarjeta" value="<?php echo isset($_POST['tarjeta']) ? $_SESSION['tarjeta'] : $_SESSION['usuario_editar']['tarjeta']; ?>"
                    <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                </label>
                <?php if (hayErrores("tarjeta")) { ?>
                    <p class='error-formulario'>El número de tarjeta no es válido.</p>
                <?php } ?>
                
                <label>Rol:
                    <select name="rol" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                        <option value="cliente" <?php echo (isset($_POST['rol']) ? $_SESSION['rol'] : $_SESSION['usuario_editar']['rol']) == 'cliente' ? 'selected' : ''; ?>>Cliente</option>
                        <option value="recepcionista" <?php echo (isset($_POST['rol']) ? $_SESSION['rol'] : $_SESSION['usuario_editar']['rol']) == 'recepcionista' ? 'selected' : ''; ?>>Recepcionista</option>
                        <option value="administrador" <?php echo (isset($_POST['rol']) ? $_SESSION['rol'] : $_SESSION['usuario_editar']['rol']) == 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                    </select>
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
