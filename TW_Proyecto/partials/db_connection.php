<?php
require_once 'db_credencials.php';

// Establece la conexión a la base de datos
function connect_db()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $conn;
}

# Desconexión de la base de datos
function desconectar_db($conn)
{
    mysqli_close($conn);
}

$db = connect_db();
// Verificar la conexión
if (!$db) { ?>
    <p>Error en la conexión: no se pudo conectar a la base de datos.</p>
    <p>Código de error: " <?php mysqli_connect_error(); ?></p>
    <?php
}
?>