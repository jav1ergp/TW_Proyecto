<?php
if (true) {
    ?>
    <aside>
        <?php
        if (!isset($_SESSION["usuario"])) {
            if ($errorUsuarioClave) { ?>
                <p>El usuario/contraseña es incorrecto.</p>
                <?php
            }
            ?>

            <div class='login'>
                <form action='index.php' method='POST'>
                    <div class='form-group'>
                        <label for='usuario'>Email:</label>
                        <input type='text' name='usuario' id='usuario'>
                    </div>

                    <div class='form-group'>
                        <label for='clave'>Clave:</label>
                        <input type='password' name='clave' id='clave'>
                    </div>

                    <div class=boton-login>
                        <input type='submit' name='iniciar-sesion' value='Login'>
                    </div>
                </form>
            </div>
            <?php
        } else if (isset($_SESSION["usuario"])) {
            ?>
                <p>Bienvenido/a <?php echo $_SESSION['usuario']['nombre']; ?>.</p>
                <div class='rol'> <?php echo $_SESSION['usuario']['rol']; ?>.</div>

                <div class='botones-editar-logout'>
                <?php if (isset($_SESSION["usuario"]["rol"]) && (($_SESSION["usuario"]["rol"] === "recepcionista") || ($_SESSION["usuario"]["rol"] === "administrador"))) { ?>
                        <div class="editar-usuario">
                            <form method="GET" action="editar-perfil_admin.php">
                                <input type="hidden" name="email" value="<?php echo $_SESSION['usuario']['email']; ?>">
                                <input type="submit" value="Editar">
                            </form>
                        </div>
                <?php } else { ?>
                    <div class="editar-usuario">
                            <form method="GET" action="editar-perfil.php">
                                <input type="hidden" name="email" value="<?php echo $_SESSION['usuario']['email']; ?>">
                                <input type="submit" value="Editar">
                            </form>
                    </div>
                <?php } ?>
                    <form action='#' method='POST'>
                        <div class=boton-logout>
                            <input type='submit' name='cerrar-sesion' value='Logout'>
                        </div>
                    </form>
                </div>
        <?php
        } ?>
        <div class="numero-habitaciones-total">
                <h3>Número de Habitaciones</h3>
                <?php
                $query = "SELECT COUNT(*) AS total_habitaciones FROM habitaciones";
                $resultado = mysqli_query($db, $query);

                if ($resultado) {
                    $fila = mysqli_fetch_assoc($resultado);
                    $total_habitaciones = $fila['total_habitaciones'];
                } else {
                    echo "Error al ejecutar la consulta: " . mysqli_error($db);
                }

                echo "<p class='fondo-estadisticas'>El número total de habitaciones es $total_habitaciones.</p>";
                ?>
        </div>

        <div class="numero-habitaciones">
                <h3>Habitaciones libres</h3>
                <?php
                $query = "SELECT COUNT(*) AS habitaciones_libres FROM habitaciones 
                WHERE id NOT IN (SELECT habitacion_id FROM reservas WHERE CURDATE() BETWEEN fecha_entrada AND fecha_salida)";
                $resultado = mysqli_query($db, $query);

                if ($resultado) {
                    $fila = mysqli_fetch_assoc($resultado);
                    $habitaciones_libres  = $fila['habitaciones_libres'];
                } else {
                    echo "Error al ejecutar la consulta: " . mysqli_error($db);
                }

                echo " <p class='fondo-estadisticas'>El número de habitaciones libres es $habitaciones_libres.</p>";
                ?>
        </div>

        <div class="numero-habitaciones">
                <h3>Capacidad total</h3>
                <?php
                $query = "SELECT SUM(capacidad) AS capacidad_total FROM habitaciones";
                $resultado = mysqli_query($db, $query);

                if ($resultado) {
                    $fila = mysqli_fetch_assoc($resultado);
                    $capacidad_total  = $fila['capacidad_total'];
                } else {
                    echo "Error al ejecutar la consulta: " . mysqli_error($db);
                }

                echo "<p class='fondo-estadisticas'>El número de habitaciones libres es $habitaciones_libres.</p>";
                ?>
        </div>

        <div class="numero-habitaciones">
                <h3>Número de huéspedes alojados</h3>
                <?php
                $query = "SELECT SUM(num_huespedes) AS huespedes_alojados FROM reservas WHERE CURDATE() BETWEEN fecha_entrada AND fecha_salida";
                $resultado = mysqli_query($db, $query);

                if ($resultado) {
                    $fila = mysqli_fetch_assoc($resultado);
                    $huespedes_alojados  = $fila['huespedes_alojados'];
                } else {
                    echo "Error al ejecutar la consulta: " . mysqli_error($db);
                }

                echo "<p class='fondo-estadisticas'>La capacidad total del hotel es $capacidad_total huéspedes.</p>";
                ?>
        </div>
    </aside>
    </div>
<?php
}
?>