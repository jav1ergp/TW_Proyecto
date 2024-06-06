<?php
require_once 'db_credencials.php';
require_once 'db_connection.php';

// if (isset($_POST['recovery'])) {
//     $mysqli = connect_db();

//     $sql = file_get_contents($fichBackup);
//     $resultado = $mysqli->multi_query($sql);

//     desconectar_db($mysqli);
// }

// if (isset($_POST['restart'])) {
//     $mysqli = connect_db();

//     $sql = "SHOW TABLES;";

//     $resultado = $mysqli->query($sql);

//     while ($fila = $resultado->fetch_assoc()) {
//         $tableName = $fila["Tables_in_" . DB_NAME];
//         $sql = "TRUNCATE TABLE " . $tableName . ";";
//         $accion = $mysqli->query($sql);
//     }

//     desconectar_db($mysqli);
// }
?>

<!DOCTYPE html>
<html>

<body>
    <main>
        <h3>Obtención de copia de seguridad</h3>
        <form action="./partials/backup.php" method="post">
            <button class="adminbbdd" type="submit" name="backup">Generar copia de seguridad.</button>
        </form>

        <form action="./partials/recovery.php" method="post">
            <button class="adminbbdd" type="submit" name="recovery">Recuperar mediante backup.</button>
        </form>

        <form action="./partials/restart.php" method="post">
            <button class="adminbbdd" type="submit" name="restart">Reiniciar la base de datos.</button>
        </form>
        <?php
        if (isset($_POST['backup']))
            echo ("Copia de seguridad generada.\n");
        if (isset($_POST['recovery']))
            echo ("Copia de seguridad recuperada.\n");
        if (isset($_POST['restart']))
            echo ("Base de datos reiniciada.\n");
        ?>
    </main>
</body>

</html>