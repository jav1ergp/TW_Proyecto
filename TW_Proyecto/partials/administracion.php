<?php
require_once 'db_connection.php';
require_once 'db_credencials.php';

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

    # Ahora, hay que tener en cuenta no droppear la tabla de usuarios entera,
    # porque nos quedariamos sin usuario administrador.
    $command = "DROP TABLE IF EXISTS `usuarios`";

    # La reemplazamos por un delete de todos los usuarios menos los administradores
    $sql = str_replace($command, "DELETE FROM `usuarios` WHERE rol != 'administrador'", $sql);

    $command = "DROP TABLE IF EXISTS `habitacion`";
    $sql = str_replace($command, "DELETE FROM `habitacion`", $sql);

    # Como no hemos dropeado la tabla usuarios, no debemos crearla.
    $command = "CREATE TABLE `usuarios`";
    $sql = str_replace($command, "CREATE TABLE `usuarios` IF NOT EXISTS", $sql);

    $mysqli = connect_db();

    $consultas = explode(";", $sql);

    foreach ($consultas as $consulta) {
        $resultado = $mysqli->query($consulta);
    }

    desconectar_db($mysqli);

    if ($resultado) {
        echo "<p class=\"resAdmin\">Base de datos restaurada correctamente.</p>";
    } else {
        echo "Error al restaurar la base de datos.";
    }
}

if (isset($_POST['restart'])) {
    require_once 'db_connection.php';

    $mysqli = connect_db();

    $sql = "SHOW TABLES";
    $resultado = $mysqli->query($sql);
    while ($fila = $resultado->fetch_assoc()) {
        $tableName = "`";
        $tableName .= $fila["Tables_in_" . DB_NAME];
        $tableName .= "`";
        if ($tableName == "`usuarios`") {
            $sql = "DELETE FROM " . $tableName . " WHERE rol != 'administrador';";
        } else {
            $sql = "DELETE FROM " . $tableName . ";";
        }
        $accion = $mysqli->query($sql);
    }

    desconectar_db($mysqli);
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

        <form action="administracion.php" method="post">
            <button class="adminbbdd" type="submit" name="restart">Reiniciar la base de datos.</button>
        </form>
    </main>
</body>

</html>