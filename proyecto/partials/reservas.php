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

    return $num_huespedesValida && $f_entradaValida && $f_salidaValida;
}
function campoEsValido3($campo)
{
    global $db;

    if (isset($_POST[$campo])) {
        // Escapar la entrada del usuario
        $noSQL = mysqli_real_escape_string($db, $_POST[$campo]);
    }

    switch ($campo) {
        case "num_huespedes":
            if (isset($noSQL) && is_numeric($noSQL) && $noSQL > 0 && AsignarHabitacion($noSQL) !== null) {
                return true;
            }
            break;

        case "fecha_entrada":
            if (isset($noSQL)) {
                $fechaEntrada = strtotime($noSQL);
                $hoy = strtotime(date("Y-m-d"));
                if ($fechaEntrada >= $hoy) {
                    return true;
                }
            }
            break;

        case "fecha_salida":
            if (isset($noSQL)) {
                $fechanoSQL = isset($_POST['fecha_entrada']) ? mysqli_real_escape_string($db, $_POST['fecha_entrada']) : null;
                $fechaEntrada = $fechanoSQL ? strtotime($fechanoSQL) : null;
                $fechaSalida = strtotime($noSQL);
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
    global $db;
    if (isset($_POST['email_cliente'])) {
        $_SESSION['email_cliente'] = $_POST['email_cliente'];
    }

    $num_huespedes = $_POST['num_huespedes'];
    $numero = AsignarHabitacion($num_huespedes);
    $_SESSION['numero'] = $numero;
    $numero_habitacion = mysqli_real_escape_string($db, $numero);

    // Consultar la información de la habitacion utilizando el numero
    $consulta = "SELECT * FROM habitacion WHERE numero = '$numero_habitacion'";
    $resultado = mysqli_query($db, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // El usuario existe, array para obtener sus datos
        $habitacion = mysqli_fetch_assoc($resultado);

        // Guardar los datos del usuario en la sesión
        $_SESSION['habitacion'] = $habitacion; //esto es para que actualizar() de operaciones_db_hab cambie el estado
    }
    $_SESSION['num_huespedes'] = htmlentities($_POST['num_huespedes']);
    $_SESSION['comentarios'] = htmlentities($_POST['comentarios']);
    $_SESSION['fecha_entrada'] = htmlentities($_POST['fecha_entrada']);
    $_SESSION['fecha_salida'] = htmlentities($_POST['fecha_salida']);
    $_SESSION['estado'] = 'Pendiente';
}

function insertarEnBD3()
{
    global $db;

    if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] === "recepcionista")) {
        $email = $_SESSION['email_cliente'];
    } else {
        $email = $_SESSION['reserva']['email'];
    }
    $numero = $_SESSION['numero'];
    $num_huespedes = $_SESSION["num_huespedes"];
    $comentarios = $_SESSION["comentarios"];
    $fecha_entrada = $_SESSION["fecha_entrada"];
    $fecha_salida = $_SESSION["fecha_salida"];
    $_SESSION['estado'] = 'Confirmada';
    $estado = 'Confirmada';
    mysqli_query($db, "INSERT INTO reserva (email, numero, capacidad, comentarios, dia_entrada, dia_salida, estado) 
        VALUES ('$email', '$numero', '$num_huespedes', '$comentarios', '$fecha_entrada', '$fecha_salida', '$estado')");
}

function actualizar3($campo)
{
    global $db;
    // Escapar el campo y el valor para la consulta SQL
    $campo_escapado = mysqli_real_escape_string($db, $campo);
    $valor_escapado = mysqli_real_escape_string($db, $_SESSION[$campo]);

    if ($_SESSION["reserva"][$campo] != $_SESSION[$campo]) {
        $query = "UPDATE reserva SET $campo_escapado = '$valor_escapado' WHERE numero = '" . mysqli_real_escape_string($db, $_SESSION["reserva"]["numero"]) . "'";
        $result = mysqli_query($db, $query);
        if ($result && mysqli_affected_rows($db) > 0) {
            $_SESSION["reserva"][$campo] = $_SESSION[$campo];
        }
    }
}

function AsignarHabitacion($capacidad)
{
    global $db;
    // Consulta para encontrar una habitación operativa con capacidad mayor o igual a la demandada
    $stmt = $db->prepare("
        SELECT h.numero
        FROM habitacion h
        WHERE h.capacidad >= ? AND h.estado = 'operativa'
        ORDER BY h.capacidad ASC
        LIMIT 1
    ");

    // Ejecutar la consulta pasando la capacidad como parámetro
    $stmt->bind_param("i", $capacidad);
    $stmt->execute();

    // Obtener el resultado de la consulta
    $resultado = $stmt->get_result();
    $habitacion = $resultado->fetch_assoc();

    // Devolver el número de la habitación si se encuentra una disponible, de lo contrario devolver null
    return $habitacion ? $habitacion['numero'] : null;
}

function obtenerClientes()
{
    // Configura los detalles de la base de datos
    global $db;

    // Consulta para obtener todos los clientes
    $stmt = $db->prepare("SELECT * FROM usuarios");
    $stmt->execute();

    // Almacena el resultado de la consulta
    $resultado = $stmt->get_result();

    // Inicializa un array vacío para almacenar los clientes
    $clientes = [];

    // Itera sobre los resultados y agrega cada cliente al array
    while ($cliente = $resultado->fetch_assoc()) {
        $clientes[] = $cliente;
    }

    // Cierra el statement y devuelve el array de clientes
    $stmt->close();
    return $clientes;
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
            inicializarVarSesion($_SESSION['estado']);
            actualizar('estado');
        }

        $datosConfirmados = false;

        if (isset($_POST['confirmar-reserva'])) {
            echo "<span class='confirmacion-datos'>Se ha confirmado la reserva del usuario.</span>";
            $datosConfirmados = true;
            insertarEnBD3();
            actualizar('estado');
        }

        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <?php
                if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] === "recepcionista")):
                    // Obtén la lista de clientes de la base de datos
                    $clientes = obtenerClientes(); // Esta función debe ser definida para obtener los clientes de la base de datos
                    ?>
                    <label>Email:
                        <select type="email" name="email_cliente" <?php if ($enviadoCorrectamente || $datosConfirmados)
                            echo "disabled"; ?>>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?php echo $cliente['email']; ?>">
                                    <?php echo $cliente['email'] . ' - ' . $cliente['nombre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                <?php else: ?>
                    <label>Email:
                        <input type="email" name="email"
                            value="<?php echo isset($_POST['email']) && !empty($_POST['email']) ? $_SESSION['email'] : $_SESSION['reserva']['email']; ?>"
                            disabled>
                    </label>
                <?php endif; ?>

                <?php if ($enviadoCorrectamente || $datosConfirmados) {
                    echo "<label>Habitación:
                            <input type='text' name='numero' value='" . $_SESSION['numero'] . "' disabled>
                        </label>";
                } ?>


                <label>Número de personas:
                    <input type="number" name="num_huespedes" value="<?php echo isset($_POST['num_huespedes']) ? $_POST['num_huespedes'] : '';
                    if ($datosConfirmados)
                        echo $_SESSION["num_huespedes"]; ?>" <?php
                          if ($enviadoCorrectamente || $datosConfirmados)
                              echo 'disabled'; ?>>
                </label>
                <?php if (hayErrores3('num_huespedes') && (!$enviadoCorrectamente)) { ?>
                    <p class='error-formulario'>No hay Habitaciones disponibles.</p>
                <?php } ?>

                <label>Comentarios del cliente:
                    <textarea name="comentarios" <?php if ($enviadoCorrectamente || $datosConfirmados)
                        echo "disabled"; ?>>
                        <?php echo isset($_POST['comentarios']) ? $_POST['comentarios'] : "";
                        if ($datosConfirmados)
                            echo $_SESSION["comentarios"]; ?>
                        <?php if ($enviadoCorrectamente || $datosConfirmados)
                            echo "disabled"; ?></textarea>
                </label>


                <label>Día de entrada:
                    <input type="date" name="fecha_entrada" value="<?php echo isset($_POST['fecha_entrada']) ? $_POST['fecha_entrada'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["fecha_entrada"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados)
                              echo "disabled"; ?>>
                </label>
                <?php if (hayErrores3("fecha_entrada")) { ?>
                    <p class='error-formulario'>Por favor, selecciona una fecha de entrada válida.</p>
                <?php } ?>

                <label>Día de salida:
                    <input type="date" name="fecha_salida" value="<?php echo isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : "";
                    if ($datosConfirmados)
                        echo $_SESSION["fecha_salida"]; ?>" <?php if ($enviadoCorrectamente || $datosConfirmados)
                              echo "disabled"; ?>>
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
                    <input type="submit" value="Ver Listado" formaction="listado_res.php">
                </label>
            </form>
        </div>
    </main>
</body>

</html>