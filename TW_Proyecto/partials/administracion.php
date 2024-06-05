<?php
if (isset($_POST['backup'])) {
    require_once 'db_credencials.php';
    require_once 'db_connection.php';

    $mysqli = connect_db();

    $nom = "./backup.sql";

    // Abrir el archivo para la copia de seguridad
    $archivo = fopen($nom, "w");

    $sql = "SHOW TABLES";
    $resultado = $mysqli->query($sql);

    while ($fila = $resultado->fetch_assoc()) {
        $tableName = $fila["Tables_in_" . DB_NAME];

        $sqlTabla = "SHOW CREATE TABLE " . $tableName;
        $resultadoTabla = $mysqli->query($sqlTabla);
        $filaTabla = $resultadoTabla->fetch_assoc();

        $estructuraTabla = $filaTabla["Create Table"];

        fwrite($archivo, $estructuraTabla . ";\n\n");

        $sqlDatos = "SELECT * FROM " . $tableName;
        $resultadoDatos = $mysqli->query($sqlDatos);
        while ($filaDatos = $resultadoDatos->fetch_assoc()) {
            $datosTabla = "";
            foreach ($filaDatos as $key => $value) {
                $datosTabla .= $key . ": '" . $value . "', ";
            }
            $datosTabla = rtrim($datosTabla, ", ");
            fwrite($archivo, "INSERT INTO " . $tableName . " SET " . $datosTabla . ";\n");
        }
        fwrite($archivo, "\n\n");
    }

    // Cerrar el archivo y la conexión
    fclose($archivo);

    desconectar_db($mysqli);
}
?>

<!DOCTYPE html>
<html>

<body>
    <main>
        <form action="./administracion.php" method="post">
            <h3>Obtención de copia de seguridad</h3>
            <button type="submit" name="backup">Generar copia de seguridad</button>
            <?php
            if (isset($_POST['backup']))
                echo ("Copia de seguridad generada, consultar: $nom.");
            ?>
        </form>
    </main>
</body>

</html>