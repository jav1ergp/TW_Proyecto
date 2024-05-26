<?php
require_once 'db_connection.php';

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
        $_SESSION['reserva'] = $usuario;
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "Email de usuario no válido.";
    exit;
}

function validarTodosLosCampos3()
{
    $num_huespedesValida = campoEsValido3("num_huespedes");
    $f_entradaValida = campoEsValido3("fecha_entrada");
    $f_salidaValida = campoEsValido3("fecha_salida");

    return  $num_huespedesValida && $f_entradaValida && $f_salidaValida;
}
function campoEsValido3($campo)
{
    global $db;

    switch ($campo) {
        case "num_huespedes":
            if (isset($_POST[$campo]) && is_numeric($_POST[$campo]) && $_POST[$campo] > 0) {
                return true;
            }
        break;

        case "fecha_entrada":
            if (isset($_POST[$campo])) {
                $fechaEntrada = strtotime($_POST[$campo]);
                $hoy = strtotime(date("Y-m-d"));
                if ($fechaEntrada > $hoy) {
                    return true;
                }
            }
        break;
    
        case "fecha_salida":
            if (isset($_POST[$campo])) {
                $fechaEntrada = isset($_POST['fecha_entrada']) ? strtotime($_POST['fecha_entrada']) : null;
                $fechaSalida = strtotime($_POST[$campo]);
                if ($fechaEntrada && $fechaSalida > $fechaEntrada) {
                    return true;
                }
            }
        break;
    }

    return false;
}
 //Función que comprueba si hay errores en un campo.
function hayErrores3($campo)
{
    switch ($campo) {
        case "num_huespedes":
            return (isset($_POST['añadir-reserva']) || isset($_POST['modificar-reserva'])) && !campoEsValido3($campo);
        case 'comentarios':
            return (isset($_POST['añadir-reserva']) || isset($_POST['modificar-reserva']));
        case "fecha_entrada":
            return (isset($_POST['añadir-reserva']) || isset($_POST['modificar-reserva'])) && !campoEsValido3($campo);
        case "fecha_salida":
            return (isset($_POST['añadir-reserva']) || isset($_POST['modificar-reserva'])) && !campoEsValido3($campo);
    }
}

function actualizarVarSesion3()
{
    $_SESSION['num_huespedes'] = htmlentities(strip_tags($_POST['num_huespedes']));
    $_SESSION['comentarios'] = htmlentities(strip_tags($_POST['comentarios']));
    $_SESSION['fecha_entrada'] = htmlentities(strip_tags($_POST['fecha_entrada']));
    $_SESSION['fecha_salida'] = htmlentities(strip_tags($_POST['fecha_salida']));
    
}

function inicializarVarSesion3($campo) {
    global $enviadoCorrectamente;
    global $datosConfirmados;
    if (!$datosConfirmados && !$enviadoCorrectamente) {
        $_SESSION[$campo] = $_SESSION["reserva"][$campo];
    }
}

function inicializarTodasVarSesion3() {
    inicializarVarSesion3("email");
    inicializarVarSesion3("num_huespedes");
    inicializarVarSesion3("comentarios");
    inicializarVarSesion3("fecha_entrada");
    inicializarVarSesion3("fecha_salida");
}

function insertarEnBD3()
{
    global $db;
    //Insertar todos los datos en la tabla FALTA AÑADIR AQUI BUSCAR HABITACION
    $email = $_SESSION["email"];
    $num_huespedes = $_SESSION["num_huespedes"];
    $comentarios = $_SESSION["comentarios"];
    $fecha_entrada = $_SESSION["fecha_entrada"];
    $fecha_salida = $_SESSION["fecha_salida"];

    mysqli_query($db, "INSERT INTO reservas (email, num_huespedes, comentarios, fecha_entrada, fecha_salida, tarjeta, rol) 
        VALUES ('$email', '$num_huespedes', '$comentarios', '$fecha_entrada', '$fecha_salida'");
}

?>

<!DOCTYPE html>
<html>

<body>
    <main>
        <div class='listado'>
            <h3>Reservas</h3>
            <h4>Añadir reserva</h4>
        </div>

        <?php

        $enviadoCorrectamente = false;
        if (isset($_POST["añadir-reserva"]) && validarTodosLosCampos3()) {
            $enviadoCorrectamente = true;
            actualizarVarSesion3(); //Se guardan en variables de sesion y se comprueba saneamiento de datos
        }

        $datosConfirmados = false;

        if (isset($_POST['confirmar-reserva'])) {
            echo "<span class='confirmacion-datos'>Se ha confirmado la reserva del usuario.</span>";
            $datosConfirmados = true;
            insertarEnBD3();
        }

        inicializarVarSesion3("email");

        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Email:
                    <input type="email" name="email"
                        value="<?php echo isset($_POST['email']) && !empty($_POST['email']) ? $_SESSION['email'] : $_SESSION['reserva']['email']; ?>"
                        disabled>
                </label>

                <label>Número de personas:
                    <input type="number" name="num_huespedes" value="<?php echo isset($_POST['num_huespedes']) ? $_POST['num_huespedes'] : ''; ?>" required>
                </label>
                <?php if (hayErrores3("num_huespedes")) { ?>
                    <p class='error-formulario'>Por favor, introduce un número válido de personas.</p>
                <?php } ?>

                <label>Comentarios del cliente:
                    <textarea name="comentarios" rows="4"
                        cols="50"><?php echo isset($_POST['comentarios']) ? $_POST['comentarios'] : ''; ?></textarea>
                </label>

                <label>Día de entrada:
                    <input type="date" name="fecha_entrada"
                        value="<?php echo isset($_POST['fecha_entrada']) ? $_POST['fecha_entrada'] : ''; ?>" required>
                </label>
                <?php if (hayErrores3("fecha_entrada")) { ?>
                    <p class='error-formulario'>Por favor, selecciona una fecha de entrada válida.</p>
                <?php } ?>

                <label>Día de salida:
                    <input type="date" name="fecha_salida"
                        value="<?php echo isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : ''; ?>" required>
                </label>
                <?php if (hayErrores3("fecha_salida")) { ?>
                    <p class='error-formulario'>Por favor, selecciona una fecha de salida válida.</p>
                <?php } ?>

                <?php if (!$enviadoCorrectamente && !$datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='añadir-reserva' value='Añadir reserva'>
                    </label>
                <?php } else if (!$datosConfirmados) { ?>
                        <label>
                            <input type='submit' name='confirmar-reserva' value='Confirmar reserva' />
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