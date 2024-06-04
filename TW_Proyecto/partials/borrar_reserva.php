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


// Verificar si se ha proporcionado el parámetro de email de usuario en la URL
if (isset($_GET['numero'])) {
    $numero_borrar = $_GET['numero'];
} else {?>
    <p class='error-formulario'>ERROR: No se pudo extraer el usuario a 
        editar de la BBDD.</p>
<?php } ?>



<?php 
//Hacemos una consulta en la tabla de usuarios que tenga el mismo email evitando inyeccion SQL aunque no deberia tener
$datosUsuarioABorrarDB = mysqli_query($db, "SELECT * FROM reserva WHERE numero='" . mysqli_real_escape_string($db, $numero_borrar) . "'");
$datoshabitacionABorrarDB = mysqli_query($db, "SELECT * FROM habitacion WHERE numero='" . mysqli_real_escape_string($db, $numero_borrar) . "'");

//array de datos a borrar
$datosUsuarioABorrar = mysqli_fetch_assoc($datosUsuarioABorrarDB);
$datoshabitacionABorrarDB = mysqli_fetch_assoc($datosUsuarioABorrarDB);

//Si se ha encontrado, se guardarán los datos del usuario en una variable de sesión, que la usaremos para obtener los datos en el formulario de la BBDD
if ($datosUsuarioABorrarDB && mysqli_num_rows($datosUsuarioABorrarDB) > 0){
        $_SESSION["reserva_borrar"] = $datosUsuarioABorrar;
}
if ($datosUsuarioABorrarDB && mysqli_num_rows($datosUsuarioABorrarDB) > 0){
    $_SESSION["habitacion"] = $datosUsuarioABorrar;
}

function borrar1(){
    global $db;
    global $numero_borrar;
      // Ejecutar la consulta DELETE
    $query = mysqli_query($db, "DELETE FROM reserva WHERE numero = '" . mysqli_real_escape_string($db, $numero_borrar) . "'");
    
    if (!($query && mysqli_affected_rows($db) > 0)) {
        // La consulta falló o no se eliminó ninguna fila?>
        <p class='error-formulario'>ERROR: No se pudo borrar la reserva de la BBDD.</p> <?php
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
         
        inicializarVarSesion('estado');
        $estado = 'operativa';
        $enviadoCorrectamente = false;
        if (isset($_POST["borrar-reserva"])){
            $enviadoCorrectamente = true;
        }

        $datosConfirmados = false;

        if (isset($_POST['confirmar-borrado'])){?>
            <span class = "confirmacion-datos">Se han borrado los datos del usuario.</span>
            <?php
                $datosConfirmados = true;
                borrar1();
                $_SESSION['estado'] = $estado;
                actualizar('estado');
        }?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Email:
                    <input type="email" name="email"
                        value="<?php echo isset($_POST['email']) && !empty($_POST['email']) ? $_SESSION['email'] : $_SESSION['reserva_borrar']['email']; ?>"
                        disabled>
                </label>

                <label>Numero-Habitacion:
                    <input type="text" name="numero"
                        value="<?php echo isset($_POST['numero']) && !empty($_POST['numero']) ? $_SESSION['numero'] : $_SESSION['reserva_borrar']['numero']; ?>"
                        disabled>
                </label>

                <label>Capacidad:
                    <input type="text" name="capacidad" placeholder="Numero"
                        value="<?php echo isset($_POST['capacidad']) ? $_SESSION['capacidad'] : $_SESSION['reserva_borrar']['capacidad']; ?>"
                        disabled>
                </label>

                <label>Comentarios del cliente:
                    <textarea name="comentarios" rows="4" cols="50" disabled>
                        <?php echo isset($_POST['comentarios']) ? $_POST['comentarios'] : $_SESSION['reserva_borrar']['comentarios']; ?>
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
                        <input type='submit' name='borrar-reserva' value='Borrar reserva'>
                    </label>
                <?php } else if (!$datosConfirmados) { ?>
                        <label>
                            <input type='submit' name='confirmar-borrado' value='Confirmar borrado' />
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