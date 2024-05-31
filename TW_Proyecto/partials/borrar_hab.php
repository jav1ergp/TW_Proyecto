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
<head>
	<meta charset="utf-8">
	<title>Ejercicio 15</title>
    <link rel="stylesheet" href="vista/estiloProyecto.css">
</head>
<body>
    <main>
        <div class='listado'>
            <h3>Gestión de habitaciones</h3>
            <h4>Borrar habitaciones</h4>
        </div>

    <?php

        // Verificar si se ha proporcionado el parámetro de numero de usuario en la URL
        if (isset($_GET['numero'])) {
            $num_borrar = $_GET['numero'];
        } else {?>
            <p class='error-formulario'>ERROR: No se pudo extraer la habitacion a 
                borrar de la BBDD.</p>
        <?php }

        

        $enviadoCorrectamente = false;
        if (isset($_POST["borrar-habitacion"])){
            $enviadoCorrectamente = true;
        }

        $datosConfirmados = false;

        if (isset($_POST['confirmar-borrado'])){?>
            <span class = "confirmacion-datos">Se han borrado los datos de la habitacion.</span>
            <?php
                $datosConfirmados = true;
                borrar();
            ?>
        <?php 
        }

        //Hacemos una consulta en la tabla de usuarios que tenga el mismo email evitando inyeccion SQL aunque no deberia tener
        $datosHabitacionABorrarDB = mysqli_query($db, "SELECT * FROM habitacion WHERE numero='" . mysqli_real_escape_string($db, $num_borrar) . "'");

        //array de datos a borrar
        $datoshabitacionABorrar = mysqli_fetch_assoc($datosHabitacionABorrarDB);
        
        //Si se ha encontrado, se guardarán los datos del usuario en una variable de sesión, que la usaremos para obtener los datos en el formulario de la BBDD
        if ($datosHabitacionABorrarDB && mysqli_num_rows($datosHabitacionABorrarDB) > 0){
                $_SESSION["habitacion_borrar"] = $datoshabitacionABorrar;
        }

        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Numero:
                    <input type="text" name="numero" value="<?php echo $_SESSION['habitacion_borrar']['numero']; ?>" disabled>
                </label>

                <label>Capacidad:
                    <input type="text" name="capacidad" value="<?php echo $_SESSION['habitacion_borrar']['capacidad']; ?>" disabled>
                </label>

                <label>Precio:
                    <input type="text" name="precio" value="<?php echo $_SESSION['habitacion_borrar']['precio']; ?>" disabled>
                </label>

                <label>Descripción:
                    <textarea name="descripcion" disabled><?php echo $_SESSION['habitacion_borrar']['descripcion']; ?></textarea>
                </label>

                <?php
                
                    if (!$enviadoCorrectamente && !$datosConfirmados){?>
                        <label>
                            <input type='submit' name='borrar-habitacion' value='Borrar habitacion'>
                        </label>
                    <?php
                    } else if (!$datosConfirmados){
                        ?>
                        <label>
                            <input type='submit' name='confirmar-borrado' value='Confirmar borrado'/>
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
                    <input type="submit" value="Ver Listado" formaction="listado_hab.php">
                </label>

            </form>
        </div>
    </main>
</body>
</html>