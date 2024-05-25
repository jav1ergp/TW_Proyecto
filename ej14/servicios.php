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
    
    <div class="foto">
      <h2>Nadar con tiburones</h2>
      <img src="fotos/tiburones.jpg">
      <div class="texto">¡Experimenta la emoción denadar junto a estos fascinantes depredadores
        marinos ! Nuestro equipo de expertos te
        llevará en una emocionanteexcursión para observar de cerca a los
        tiburones en su entorno natural.
        Con las medidas de seguridad adecuadas y la guía de nuestros profesionales, podrás
        disfrutar de esta aventura única
        mientras aprendes sobre laimportancia deconservar y
        respetar la vida marina.</div>
        <p> Precio 49.99€</p>
      <h2>Motos de Agua</h2>
      <img src="fotos/motos.jpg">
      <div class="texto">¡Experimenta la emoción de montar sobre lasolas junto a nuestrasveloces motos de agua
        !Disfruta de lavelocidad y la adrenalina mientras recorres las aguas cristalinas que rodean nuestra isla. 
        Nuestros guías expertos te llevarán en un emocionante recorrido, mostrándote los lugares más impresionantes y asegurándose 
        de que tengas una experiencia segura y divertida</div>
        <p> Precio 29.99€</p>
    </div>
    <?php include ("partials/side-menu.php");?>
  </div>

  <!-- Footer de la web -->
  <?php include ("partials/footer.php"); ?>
</body>