<?php
require_once 'db_connection.php';

if (isset($_POST['recovery'])) {
    $archivoSubido = $_FILES['archivoRec'];

    if ($archivoSubido['error'] !== UPLOAD_ERR_OK) {
        echo "Error al subir el archivo: " . $archivoSubido['error'];
        exit;
    } else if ($archivoSubido['type'] !== 'text/plain') {
        echo "Solo se acepta texto plano";
        exit;
    }

    $sql = file_get_contents($archivoSubido['tmp_name']);

    $mysqli = connect_db();

    # Ahora, hay que tener en cuenta no droppear la tabla de usuarios entera,
    # porque nos quedariamos sin usuario administrador.
    $command = "DROP TABLE IF EXISTS `usuarios`";

    # La reemplazamos por un delete de todos los usuarios menos los administradores
    $sql = str_replace($command, "DELETE FROM `usuarios` WHERE rol != 'administrador'", $sql);

    # Como no hemos dropeado la tabla usuarios, no debemos crearla.
    $command = "CREATE TABLE `usuarios`";
    $sql = str_replace($command, "CREATE TABLE `usuarios` IF NOT EXISTS", $sql);

    # Debe haber un usuario administrador,
    # por lo que lo borramos del query para que no se inserte
    // $command = "('Javier', 'Perez', '76067757H', 'administrador@gmail.com', '$2y$10\$FTyu3X4Ozx7tNNGLtj.kSudgu4G4bH..fKXPcSh82xk1P8475i3uu', '1234567891234567', 'administrador'),";
    // $found = strpos($sql, $command);

    // if ($found) {
    //     echo "Usuario administrador encontrado, se procede a NO insertarlo.";
    // } else {
    //     echo "Usuario administrador no encontrado.";
    // }

    $resultado = $mysqli->multi_query($sql);

    desconectar_db($mysqli);

    if ($resultado) {
        echo "Base de datos restaurada correctamente.";
    } else {
        echo "Error al restaurar la base de datos.";
    }
}

?>

<!DOCTYPE html>
<html>

<body>
    <main>
        <h3>Obtención de copia de seguridad</h3>
        <form action="./partials/backup.php" method="post">
            <button class="adminbbdd" type="submit" name="backup">Generar copia de seguridad.</button>
        </form>

        <form action="administracion.php" method="post" enctype='multipart/form-data'>
            <button class="adminbbdd" type="submit" name="recovery">Recuperar mediante backup.</button>
            <input type="file" name="archivoRec" id="archivoRec">
        </form>

        <form action="./partials/restart.php" method="post">
            <button class="adminbbdd" type="submit" name="restart">Reiniciar la base de datos.</button>
        </form>
    </main>
</body>

</html>