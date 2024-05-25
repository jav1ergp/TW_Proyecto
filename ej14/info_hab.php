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

  <div class="contenedor">
    <div class="fotos">
      <div class="foto">
        <img src="habitacion.jpg">
        <div class="texto">Estandar</div>
      </div>
      <div class="foto">
        <img src="suite.jpg">
        <div class="texto">Suite</div>
      </div>
      <div class="foto">
        <img src="villa.jpg">
        <div class="texto">Villa</div>
      </div>
    </div>
    <?php include ("partials/side-menu.php");?>
  </div>

  <!-- Footer de la web -->
  <?php include ("partials/footer.php"); ?>
</body>

</html>