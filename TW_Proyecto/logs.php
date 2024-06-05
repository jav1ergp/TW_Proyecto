<!DOCTYPE html>
<html>
<?php
session_start();
include ("partials/head-html.php");
?>

<body>

    <!---Conexión con la base de datos -->
    <?php include ("partials/db_connection.php"); ?>

    <!-- Header de la web -->
    <?php include ("partials/header-nav.php"); ?>

    <!-- Configuración del login -->
    <?php include ("partials/login.php"); ?>

    <?php include ("partials/log.php"); ?>
    <?php include ("partials/side-menu.php"); ?>
    
    <!-- Footer de la web -->
    <?php include ("partials/footer.php"); ?>
</body>

</html>