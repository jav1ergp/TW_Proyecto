<?php
require_once 'db_credencials.php';
require_once 'db_connection.php';

$fichBackup = "../backup.txt";

$mysqli = connect_db();

$tables = [];
$sql = "SHOW TABLES";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
}

// Crear el archivo de dump 
$handle = fopen($fichBackup, 'w');

if (!$handle) {
    die("No se pudo crear el archivo de dump.");
}

// Escribir la estructura y datos de cada tabla en el archivo de dump
foreach ($tables as $table) {
    // Obtener la estructura de la tabla
    $createTableResult = $mysqli->query("SHOW CREATE TABLE $table");
    $row = $createTableResult->fetch_assoc();
    $createTableSql = $row['Create Table'] . ";\n\n";
    fwrite($handle, "DROP TABLE IF EXISTS `$table`;\n");
    fwrite($handle, $createTableSql);

    // Obtener los datos de la tabla
    $result = $mysqli->query("SELECT * FROM $table");
    if ($result->num_rows > 0) {
        $columns = array_keys($result->fetch_assoc());
        $columnsList = "`" . implode("`, `", $columns) . "`";

        while ($row = $result->fetch_assoc()) {
            $values = array_values($row);
            $valuesList = "'" . implode("', '", $values) . "'";
            $insertSql = "INSERT INTO `$table` ($columnsList) VALUES ($valuesList);\n";
            fwrite($handle, $insertSql);
        }
        fwrite($handle, "\n");
    }
}

fclose($handle);

desconectar_db($mysqli);

# Lo enviamos al usuario
header("Content-disposition: attachment; filename=backup.txt");
header("Content-type: text/plain");
readfile("../backup.txt");
