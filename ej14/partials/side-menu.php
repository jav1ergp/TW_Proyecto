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
                        <div class="editar-usuario">
                            <?php
                                $resultado = mysqli_query($db, "SELECT * FROM usuarios");
                                $fila = mysqli_fetch_assoc($resultado);
                            ?>
                            <form method="GET" action="editar-perfil.php">
                                <input type="hidden" name="email" value="<?php echo $fila['email']; ?>">
                                <input type="submit" value="Editar">
                            </form>
                        </div>

                    <form action='#' method='POST'>
                        <div class=boton-logout>
                            <input type='submit' name='cerrar-sesion' value='Logout'>
                        </div>
                    </form>
                </div>
        <?php
        } ?>
    </aside>
    </div>
<?php
}
?>