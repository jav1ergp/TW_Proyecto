<?php
require_once 'db_connection.php';

$mysqli = connect_db();

$sql = "SHOW TABLES";
$resultado = $mysqli->query($sql);
while ($fila = $resultado->fetch_assoc()) {
    $tableName = $fila["Tables_in_" . DB_NAME];
    $sql = "TRUNCATE TABLE " . $tableName . ";";
    $accion = $mysqli->query($sql);
}

desconectar_db($mysqli);
