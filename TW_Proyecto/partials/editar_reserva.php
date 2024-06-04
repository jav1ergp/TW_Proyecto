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
if (isset($_GET['numero'])) {
    $numero_habitacion = mysqli_real_escape_string($db, $_GET['numero']);

    // Consultar la información de la habitacion utilizando el numero
    $consulta = "SELECT * FROM reserva WHERE numero = '$numero_habitacion'";
    $resultado = mysqli_query($db, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // El usuario existe, array para obtener sus datos
        $habitacion = mysqli_fetch_assoc($resultado);

        // Guardar los datos del usuario en la sesión
        $_SESSION['reserva'] = $habitacion;
    } else {
        echo "Numero no encontrado.";
        exit;
    }
} else {
    echo "Numero de habitacion no válido.";
    exit;
}

function actualizar3($campo) {
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
?>

<!DOCTYPE html>
<html>

<body>
    <main>
        <div class='listado'>
            <h3>Gestión de reservas</h3>
            <h4>Editar reserva</h4>
        </div>

        <?php

        $enviadoCorrectamente = false;
        if (isset($_POST["modificar-reserva"])) {//falta validar comentarios
            $enviadoCorrectamente = true;
            $_SESSION['comentarios'] = htmlentities(strip_tags($_POST['comentarios']));
        }

        $datosConfirmados = false;

        if (isset($_POST['confirmar-reserva'])) {
            echo "<span class='confirmacion-datos'>Se han modificado los datos de la reserva.</span>";
            $datosConfirmados = true;
            actualizar3("comentarios");
        }
        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Email:
                    <input type="email" name="email"
                        value="<?php echo isset($_POST['email']) && !empty($_POST['email']) ? $_SESSION['email'] : $_SESSION['reserva']['email']; ?>"
                        disabled>
                </label>

                <label>Numero-Habitacion:
                    <input type="text" name="numero"
                        value="<?php echo isset($_POST['numero']) && !empty($_POST['numero']) ? $_SESSION['numero'] : $_SESSION['reserva']['numero']; ?>"
                        disabled>
                </label>

                <label>Capacidad:
                    <input type="text" name="capacidad" placeholder="Numero"
                        value="<?php echo isset($_POST['capacidad']) ? $_SESSION['capacidad'] : $_SESSION['reserva']['capacidad']; ?>"
                        disabled>
                </label>

                <label>Comentarios del cliente:
                    <textarea name="comentarios" rows="4" cols="50" <?php if ($enviadoCorrectamente || $datosConfirmados) echo "disabled"; ?>>
                        <?php echo isset($_POST['comentarios']) ? $_POST['comentarios'] : $_SESSION['comentarios']; ?>
                    </textarea>
                </label>


                <label>Día de entrada:
                    <input type="date" name="fecha_entrada"
                        value="<?php echo isset($_POST['fecha_entrada']) ? $_POST['fecha_entrada'] : $_SESSION["fecha_entrada"]; ?>"
                        disabled>
                </label>

                <label>Día de salida:
                    <input type="date" name="fecha_salida"
                        value="<?php echo isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : $_SESSION["fecha_salida"]; ?>" 
                        disabled>
                </label>

                <?php if (!$enviadoCorrectamente && !$datosConfirmados) { ?>
                    <label>
                        <input type='submit' name='modificar-reserva' value='Modificar reserva'>
                    </label>
                <?php } else if (!$datosConfirmados) { ?>
                        <label>
                            <input type='submit' name='confirmar-reserva' value='Confirmar reserva' />
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