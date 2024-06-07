<!DOCTYPE html>
<html>
<?php
session_start();
include ("partials/head-html.php");
?>

<body>
    <?php if (isset($_SESSION["usuario"]["rol"]) && (($_SESSION["usuario"]["rol"] === "administrador") || ($_SESSION["usuario"]["rol"] === "recepcionista"))) { ?>
        <!---Conexión con la base de datos -->
        <?php include ("partials/db_connection.php"); ?>


        <!-- Header de la web -->
        <?php include ("partials/header-nav.php"); ?>

        <!-- Configuración del login -->
        <?php include ("partials/login.php"); ?>

        <!-- Página de bienvenida -->
        <div class="contenedor">
            <?php
            include ("partials/editar_usuarios_admin.php");
            include ("partials/side-menu.php");
            ?>
        </div>

        <!-- Footer de la web -->
        <?php include ("partials/footer.php"); ?>
    <?php } else { ?>
        <h1>No tienes permisos para acceder a esta página.</h1>
    <?php } ?>
</body>

</html>