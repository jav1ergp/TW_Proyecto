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
    <div class="reservas">
      <div class="res-card">
        <h2>Reserva #12345</h2>
        <p><strong>Nombre:</strong> Javier Garcia Perez</p>
        <p><strong>Habitación:</strong> Suite</p>
        <p><strong>Fecha de entrada:</strong> 22 de abril de 2024</p>
        <p><strong>Fecha de salida:</strong> 28 de abril de 2024</p>
        <p><strong>Estado:</strong> Confirmada</p>
      </div>
      <div class="res-card">
        <h2>Reserva #12346</h2>
        <p><strong>Nombre:</strong> Miguel Torres Alonso</p>
        <p><strong>Habitación:</strong> Estandar</p>
        <p><strong>Fecha de entrada:</strong> 29 de abril de 2024</p>
        <p><strong>Fecha de salida:</strong> 5 de mayo de 2024</p>
        <p><strong>Estado:</strong> Confirmada</p>
      </div>
      <div class="res-card">
        <h2>Reserva #12347</h2>
        <p><strong>Nombre:</strong> Javier Martinez Baena</p>
        <p><strong>Habitación:</strong> Estandar</p>
        <p><strong>Fecha de entrada:</strong> 29 de abril de 2024</p>
        <p><strong>Fecha de salida:</strong> 5 de mayo de 2024</p>
        <p><strong>Estado:</strong> Pendiente</p>
      </div>
      <div class="res-card">
        <h2>Reserva #12348</h2>
        <p><strong>Nombre:</strong> JSoto Hidalgo</p>
        <p><strong>Habitación:</strong> Suite</p>
        <p><strong>Fecha de entrada:</strong> 6 de mayo de 2024</p>
        <p><strong>Fecha de salida:</strong> 12 de mayo de 2024</p>
        <p><strong>Estado:</strong> Pendiente</p>
      </div>
      <div class="res-card">
        <h2>Reserva #12349</h2>
        <p><strong>Nombre:</strong> Elmillor</p>
        <p><strong>Habitación:</strong> Villa</p>
        <p><strong>Fecha de entrada:</strong> 6 de mayo de 2024</p>
        <p><strong>Fecha de salida:</strong> 12 de mayo de 2024</p>
        <p><strong>Estado:</strong> Confirmada</p>
      </div>
      <div class="res-card">
        <h2>Reserva #12350</h2>
        <p><strong>Nombre:</strong> Andypsx</p>
        <p><strong>Habitación:</strong> Villa</p>
        <p><strong>Fecha de entrada:</strong> 6 de mayo de 2024</p>
        <p><strong>Fecha de salida:</strong> 12 de mayo de 2024</p>
        <p><strong>Estado:</strong> Confirmada</p>
      </div>
    </div>
    <?php include ("partials/side-menu.php");?>
  </div>
  <!-- Footer de la web -->
  <?php include ("partials/footer.php"); ?>
</body>

</html>