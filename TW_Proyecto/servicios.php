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
      <div class="subfoto">
        <h2>Nadar con tiburones</h2>
        <img src="fotos/tiburones.jpg">
        <div class="texto">¡Experimenta la emoción de nadar junto a estos fascinantes depredadores
          marinos! Nuestro equipo de expertos te
          llevará en una emocionante excursión para observar de cerca a los
          tiburones en su entorno natural.
          Con las medidas de seguridad adecuadas y la guía de nuestros profesionales, podrás
          disfrutar de esta aventura única
          mientras aprendes sobre la importancia de conservar y
          respetar la vida marina.</div>
        <p> Precio 49.99€/persona.</p>
      </div>
      <div class="subfoto">
        <h2>Motos de Agua</h2>
        <img src="fotos/motos.jpg">
        <div class="texto">¡Experimenta la emoción de montar sobre las olas junto a nuestras veloces motos de agua
          ¡Disfruta de la velocidad y la adrenalina mientras recorres las aguas cristalinas que rodean nuestra isla.
          Nuestros guías expertos te llevarán en un emocionante recorrido, mostrándote los lugares más impresionantes y
          asegurándose
          de que tengas una experiencia segura y divertida.</div>
        <p> Precio 29.99€/persona.</p>
      </div>
      <div class="subfoto">
        <h2>Spa</h2>
        <img src="fotos/spa.png">
        <div class="texto">Relájate y rejuvenece en nuestro exclusivo Spa, un santuario de paz y tranquilidad donde
          podrás escapar del estrés cotidiano y sumergirte en una experiencia de bienestar inigualable.

          Nuestro equipo de expertos te brindará una atención personalizada, guiándote a través de una amplia gama de
          tratamientos diseñados para restaurar tu equilibrio físico y mental.

          Disfruta de nuestras instalaciones de última generación, que incluyen:
          <ul>
            <li>Piscinas climatizadas: Relájate en nuestras piscinas climatizadas, tanto interiores como exteriores, y
              disfruta de los beneficios del agua para tu cuerpo y mente.</li>
            <li>
              Saunas y baños de vapor: Elimina toxinas y purifica tu organismo en nuestros saunas y baños de vapor,
              ideales para una desintoxicación profunda.
            </li>
            <li>
              Jacuzzis: Desconecta y deja que los chorros de agua te masajeen en nuestros jacuzzis, perfectos para
              relajar los músculos y aliviar el estrés.
            </li>
            <li>
              Áreas de descanso: Relájate en nuestras tranquilas áreas de descanso, donde podrás disfrutar de una taza
              de té o leer un libro en un ambiente de paz y armonía.
            </li>
          </ul>
        </div>
        <p> Precio 39.99€/persona.</p>
      </div>
    </div>
    <?php include ("partials/side-menu.php"); ?>
  </div>

  <!-- Footer de la web -->
  <?php include ("partials/footer.php"); ?>
</body>