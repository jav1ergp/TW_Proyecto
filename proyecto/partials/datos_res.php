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
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Datos reserva</title>
    <link rel="stylesheet" href="vista/estiloProyecto.css">
</head>

<body>
    <main>
        <div class='listado'>
            <h3>Gestión de reservas</h3>
            <h4>Datos reservas</h4>
        </div>

        <?php

        // Verificar si se ha proporcionado el parámetro de numero de usuario en la URL
        if (isset($_GET['numero'])) {
            $num_borrar = $_GET['numero'];
        } else { ?>
            <p class='error-formulario'>ERROR: No se pudo extraer la habitacion a
                borrar de la BBDD.</p>
        <?php }

        $datosConfirmados = false;

        //Hacemos una consulta en la tabla de usuarios que tenga el mismo email evitando inyeccion SQL aunque no deberia tener
        $datosHabitacionABorrarDB = mysqli_query($db, "SELECT * FROM reserva WHERE numero='" . mysqli_real_escape_string($db, $num_borrar) . "'");

        //array de datos a borrar
        $datoshabitacionABorrar = mysqli_fetch_assoc($datosHabitacionABorrarDB);

        //Si se ha encontrado, se guardarán los datos del usuario en una variable de sesión, que la usaremos para obtener los datos en el formulario de la BBDD
        if ($datosHabitacionABorrarDB && mysqli_num_rows($datosHabitacionABorrarDB) > 0) {
            $_SESSION["reservas_borrar"] = $datoshabitacionABorrar;
        }

        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Email:
                    <input type="text" name="numero" value="<?php echo $_SESSION['reservas_borrar']['email']; ?>"
                        disabled>
                </label>

                <label>Numero-Habitacion:
                    <input type="text" name="numero" value="<?php echo $_SESSION['reservas_borrar']['numero']; ?>"
                        disabled>
                </label>

                <label>Capacidad:
                    <input type="text" name="capacidad" value="<?php echo $_SESSION['reservas_borrar']['capacidad']; ?>"
                        disabled>
                </label>

                <label>Descripción:
                    <textarea name="descripcion"
                        disabled><?php echo $_SESSION['reservas_borrar']['comentarios']; ?></textarea>
                </label>

                <label>Día de entrada:
                    <input type="text" name="precio" value="<?php echo $_SESSION['reservas_borrar']['dia_entrada']; ?>"
                        disabled>
                </label>

                <label>Día de salida:
                    <input type="text" name="precio" value="<?php echo $_SESSION['reservas_borrar']['dia_salida']; ?>"
                        disabled>
                </label>

                <label>
                    <input type="submit" value="Ver Listado" formaction="listado_res.php">
                </label>

            </form>
        </div>
    </main>
</body>

</html>