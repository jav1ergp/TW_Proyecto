<header>
    <h1 class="top-header">
        <img src="logo.png" height="50" width="50">
        <p>Zooweb</p>

        <?php
        $resultado = mysqli_query($db, "SELECT * FROM usuarios");

        // Verificar si se obtuvieron resultados
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            
            $fila = mysqli_fetch_assoc($resultado);
        }
        ?>
        <div class="telefono">
            <span class="simbolo"></span>
            <span class="numero">(+34) 666 111 111</span>
            <div class="separador"></div>
            <form method="GET" action="reservas.php">
                <input type="hidden" name="email" value="<?php echo $fila['email']; ?>">
                <p><input type="submit" id="enviar" value="Reserva ahora" /></p>
            </form>
            
        </div>
    </h1>
    <nav class="navi">
        <ul>
            <li><a href="index.php">INICIO</a></li>
            <li><a href="info_hab.php">HABITACIONES</a></li>
            <li><a href="servicios.php">SERVICIOS</a></li>
            <li><a href="registro.php">REGISTRO</a></li>
            <li><a href="reservas.php?email=<?php echo urlencode($fila['email']); ?>">RESERVAS</a></li>
            <li><a href="listado.php">LISTADO</a></li>
        </ul>
    </nav>
</header>