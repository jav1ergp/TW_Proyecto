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

    // Consultar la información de la habitacion utilizando el numero
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
            $fecha = date('Y-m-d H:i:s');
            $accion = "Se ha modificado la habitacion {$_SESSION['habitacion']['numero']}.";
            $log = mysqli_query($db, "INSERT INTO logs (fecha, descripcion) VALUES ('$fecha', '$accion')");
        }

        inicializarTodasVarSesion();
        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Numero-Habitacion:
                    <input type="text" name="numero"
                        value="<?php echo isset($_POST['numero']) && !empty($_POST['numero']) ? $_SESSION['numero'] : $_SESSION['habitacion']['numero']; ?>"
                        disabled>
                </label>

                <label>Capacidad:
                    <input type="text" name="capacidad" placeholder="Numero"
                        value="<?php echo isset($_POST['capacidad']) ? $_SESSION['capacidad'] : $_SESSION['habitacion']['capacidad']; ?>"
                        <?php if ($enviadoCorrectamente || $datosConfirmados)
                            echo "disabled"; ?>>
                </label>
                <?php
                if (hayErrores("capacidad")) { ?>
                    <p class='error-formulario'>Debe escribir la capacidad de la habitacion o ya hay alguna habitacion
                        registrada con ese numero.</p>
                <?php } ?>


                <label>Precio:
                    <input type="text" name="precio" placeholder="Numero"
                        value="<?php echo isset($_POST['precio']) ? $_SESSION['precio'] : $_SESSION['habitacion']['precio']; ?>"
                        <?php if ($enviadoCorrectamente || $datosConfirmados)
                            echo "disabled"; ?>>
                </label>

                <?php
                if (hayErrores("precio")) { ?>
                    <p class='error-formulario'>Debe escribir el precio de la habitacion .</p>
                <?php } ?>


                <label>Descripción:
                    <textarea name="descripcion" rows="4" cols="50" <?php if ($enviadoCorrectamente || $datosConfirmados)
                        echo "disabled"; ?>>
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
                            <input type='submit' name='confirmar-habitacion' value='Confirmar habitacion' />
                        </label>
                <?php } ?>

                <label>
                    <input type="submit" value="Ver Listado" formaction="listado_hab.php">
                </label>

            </form>
            <?php

            //Configuramos la nomenclatura de los nombres de archivo de las imágenes,
            //que todas siguen la misma convección
            if (isset($_FILES['subir-imagen']) && isset($_POST['añadir-foto'])) {
                // Obtener información del archivo
                $archivo = $_FILES['subir-imagen'];
                $nombreArchivo = $archivo['name'];
                $tipoArchivo = $archivo['type'];
                $rutaTemporal = $archivo['tmp_name'];
                $fotoValida = true;
                $fotoValida2 = true;

                if (empty($nombreArchivo)) {
                    echo "<p class='error-formulario'> Error: No se ha seleccionado ningún archivo. </p>";
                    $fotoValida = false;
                    $fotoValida2 = false;
                }

                if ($fotoValida) {
                    $tipoImagen = exif_imagetype($rutaTemporal);
                    $tiposPermitidos = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
                    if (!in_array($tipoImagen, $tiposPermitidos)) {
                        echo "<p class='error-formulario'> Error: El archivo subido no es una imagen válida. </p>";
                        $fotoValida2 = false;
                    }
                }

                if ($fotoValida2) {
                    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                    $extensionesPermitidas = array('jpg', 'jpeg', 'png', 'gif');
                    if (!in_array($extension, $extensionesPermitidas)) {
                        echo "<p class='error-formulario'> Error: La extensión del archivo no es válida. </p>";
                        $fotoValida = false;
                    }

                    // Contador para el nombre
                    $contadorFotoDB = mysqli_query($db, "SELECT COUNT(*) AS total FROM fotografias WHERE numero_hab ='" . mysqli_real_escape_string($db, $_SESSION["habitacion"]["numero"]) . "'");
                    $contadorFoto = mysqli_fetch_assoc($contadorFotoDB);
                    $siguienteImagen = $contadorFoto["total"] + 1;

                    // Generar nuevo nombre de archivo
                    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                    $nuevoNombreSinExtension = $_SESSION["habitacion"]["numero"] . '-' . $siguienteImagen;
                    $nuevoNombre = $nuevoNombreSinExtension . '.' . $extension;

                    // Ruta de destino
                    $carpetaDestino = './fotos/habitaciones/';
                    $rutaDestino = $carpetaDestino . $nuevoNombre;

                    // Mover archivo a la carpeta de destino
                    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                        $idIncidenciaFoto = $_SESSION["habitacion"]["numero"];
                        $insercionFoto = mysqli_query($db, "INSERT INTO fotografias (rutaImagen, idImagen, numero_hab) VALUES ('$rutaDestino', '$nuevoNombreSinExtension','$idIncidenciaFoto')");
                    }
                }
            }

            ?>
            <?php
            if (isset($_POST['borrar-foto'])) {
                $idImagen = $_POST['idImagen'];

                // Obtener la ruta de la imagen a eliminar de la base de datos
                $query = "SELECT rutaImagen FROM fotografias WHERE idImagen ='" . mysqli_real_escape_string($db, $idImagen) . "'";
                $resultado = mysqli_query($db, $query);

                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    $row = mysqli_fetch_assoc($resultado);
                    $rutaImagen = $row['rutaImagen'];

                    // Eliminar la imagen del sistema de archivos
                    if (unlink($rutaImagen)) {
                        // Borrar la entrada de la base de datos
                        $query = "DELETE FROM fotografias WHERE idImagen ='" . mysqli_real_escape_string($db, $idImagen) . "'";
                        $resultado = mysqli_query($db, $query);
                        if (!$resultado) {
                            echo "<p class='error-formulario'> Error al borrar la imagen de la base de datos: </p>" . mysqli_error($db);
                        }
                    } else {
                        echo "<p class='error-formulario'> Error al borrar el archivo del sistema de archivos. </p>";
                    }
                } else {
                    echo "<p class='error-formulario'> No se encontró la imagen en la base de datos. </p>";
                }
            }
            ?>

            <?php if (!$enviadoCorrectamente) { ?>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="formulario-editar">
                        <div class="imagenes-incidencia">
                            <h4>Fotografías adjuntas:</h4>
                            <?php
                            $idIncidenciaActual = $_SESSION["habitacion"]["numero"];
                            $query = "SELECT rutaImagen,idImagen FROM fotografias WHERE numero_hab ='" . mysqli_real_escape_string($db, $idIncidenciaActual) . "'";
                            $resultado = mysqli_query($db, $query);

                            if ($resultado) {
                                // Iterar sobre los resultados y mostrar las imágenes
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    $idImagen = $row['idImagen'];
                                    $rutaImagen = $row['rutaImagen'];
                                    echo "<img src='$rutaImagen' height=20% width=20%>";
                                    ?>
                                    <div class="cada-imagen-incidencia">
                                        <form action="#" method="POST">
                                            <input type='hidden' name='idImagen' value='<?php echo $idImagen; ?>'>
                                            <input type='submit' value='Borrar foto' name='borrar-foto' />
                                        </form>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "Error al ejecutar la consulta: " . mysqli_error($db);
                            }
                            ?>
                        </div>
                        <input type='file' name='subir-imagen' value='Seleccionar archivo' accept=".jpg, .png, .jpeg" />
                        <input type="submit" value="Añadir fotografia" name="añadir-foto" />
                    </div>
                </form>
            <?php } ?>
        </div>
    </main>
</body>

</html>