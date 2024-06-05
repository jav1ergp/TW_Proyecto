<header>
    <h1 class="top-header">
        <img src="./fotos/logo.png" height="50" width="50">
        <p>Aqua Horizon Resort</p>
        <?php include ("partials/login.php"); ?>
        <?php

        ?>
        <div class="telefono">
            <span class="simbolo"></span>
            <span class="numero">(+34) 666 111 111</span>
            <div class="separador"></div>
            <?php if (isset($_SESSION["usuario"]["email"]) && !empty($_SESSION["usuario"]["email"])): ?>
                <form method="GET" action="reservas.php">
                    <input type="hidden" name="email" value="<?php echo $_SESSION["usuario"]["email"]; ?>">
                    <p><input type="submit" id="enviar" value="Reserva ahora" /></p>
                </form>

            <?php else: ?>
                <form method="GET" action="registro.php">
                    <p><input type="submit" id="enviar" value="Reserva ahora" /></p>
                </form>
            <?php endif; ?>
        </div>
    </h1>
    <nav class="navi">
        <ul>
            <li><a href="index.php">INICIO</a></li>
            <li><a href="listado_hab.php">HABITACIONES</a></li>
            <li><a href="servicios.php">SERVICIOS</a></li>
            <li><a href="registro.php">REGISTRO</a></li>
            <?php if (isset($_SESSION["usuario"]["email"]) && !empty($_SESSION["usuario"]["email"])): ?>
                <?php if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] !== "administrador")): ?>
                    <li><a href="reservas.php?email=<?php echo urlencode($_SESSION["usuario"]["email"]); ?>">RESERVAS</a></li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] === "recepcionista" || $_SESSION["usuario"]["rol"] === "administrador")): ?>
                <li><a href="listado.php">USUARIOS</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] === "administrador")): ?>
                <li><a href="logs.php">LOGS</a></li>
                <li><a href="administracion.php">ADMINISTRACIÓN</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>