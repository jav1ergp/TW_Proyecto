<?php
require_once 'db_connection.php';
require_once 'operaciones_db.php';

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
    <title>Datos usuarios</title>
    <link rel="stylesheet" href="vista/estiloProyecto.css">
</head>

<body>
    <main>
        <div class='listado'>
            <h3>Gestión de usuarios</h3>
            <h4>Datos usuarios</h4>
        </div>

        <?php

        // Verificar si se ha proporcionado el parámetro de email de usuario en la URL
        if (isset($_GET['email'])) {
            $email_borrar = $_GET['email'];
        } else { ?>
            <p class='error-formulario'>ERROR: No se pudo extraer el usuario a
                editar de la BBDD.</p>
        <?php }



        $enviadoCorrectamente = false;

        $datosConfirmados = false;


        //Hacemos una consulta en la tabla de usuarios que tenga el mismo email evitando inyeccion SQL aunque no deberia tener
        $datosUsuarioABorrarDB = mysqli_query($db, "SELECT * FROM usuarios WHERE email='" . mysqli_real_escape_string($db, $email_borrar) . "'");

        //array de datos a borrar
        $datosUsuarioABorrar = mysqli_fetch_assoc($datosUsuarioABorrarDB);

        //Si se ha encontrado, se guardarán los datos del usuario en una variable de sesión, que la usaremos para obtener los datos en el formulario de la BBDD
        if ($datosUsuarioABorrarDB && mysqli_num_rows($datosUsuarioABorrarDB) > 0) {
            $_SESSION["usuario_borrar"] = $datosUsuarioABorrar;
        }

        ?>

        <div class="formulario-editar">
            <form action="" method="POST">
                <label>Nombre:
                    <input type="text" name="nombre" value="<?php echo $_SESSION['usuario_borrar']['nombre']; ?>"
                        disabled>
                </label>

                <label>Apellidos:
                    <input type="text" name="apellidos" value="<?php echo $_SESSION['usuario_borrar']['apellidos']; ?>"
                        disabled>
                </label>

                <label>Dni:
                    <input type="text" name="dni" value="<?php echo $_SESSION['usuario_borrar']['dni']; ?>" disabled>
                </label>

                <label>Email:
                    <input type="email" name="email" value="<?php echo $_SESSION['usuario_borrar']['email']; ?>"
                        disabled>
                </label>

                <label>Tarjeta de crédito:
                    <input type="text" name="tarjeta" value="<?php echo $_SESSION['usuario_borrar']['tarjeta']; ?>"
                        disabled>
                </label>

                <label>Rol:
                    <input type='text' name='rol' value='<?php echo $_SESSION["usuario_borrar"]["rol"]; ?>' disabled />
                </label>

                <?php if (isset($_SESSION["usuario"]["rol"])) {
                    if ($_SESSION["usuario"]["rol"] === "cliente") { ?>
                        <label>
                            <input type="submit" value="Ir a Inicio" formaction="index.php">
                        </label>
                    <?php } elseif ($_SESSION["usuario"]["rol"] === "recepcionista") { ?>
                        <label>
                            <input type="submit" value="Ver Listado" formaction="listado.php">
                        </label>
                    <?php }
                } ?>

            </form>
        </div>
    </main>
</body>

</html>