<!DOCTYPE html>
<html>
<?php 
    session_start();
    include("partials/head-html.php");
?>
<body>

    <!---Conexión con la base de datos -->
    <?php include("partials/db_connection.php");?>


    <!-- Header de la web -->   
    <?php include("partials/header-nav.php");?>

    <!-- Configuración del login -->   
    <?php include("partials/login.php");?>
        
    <!-- Página de bienvenida -->    
    <div class="contenedor">
        <?php
            include("partials/bienvenida.php");
            include("partials/side-menu.php");
        ?>
    </div>
    
    <!-- Footer de la web -->
    <?php include("partials/footer.php");?>
</body>

</html>