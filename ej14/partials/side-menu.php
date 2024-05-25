<?php
if (true){
?>
        <aside>
            <?php
                if (!isset($_SESSION["usuario"])){
                    if ($errorUsuarioClave){?>
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
                } else if (isset($_SESSION["usuario"])){
                ?>                        
                    <p>Bienvenido/a <?php echo $_SESSION['usuario']['nombre']; ?>.</p>
                    <div class='rol'> <?php echo $_SESSION['usuario']['rol']; ?>.</div>
                    
                    <div class= 'botones-editar-logout'>
                    <div class='boton-editar'>
                    <a href="editar_usuarios.php"><input type='submit' name='editar-datos' value='Editar'></a>
                    </div>
                      
                    <form action='#' method='POST'>      
                            <div class=boton-logout>
                                <input type='submit' name='cerrar-sesion' value='Logout'>
                            </div>
                        </div>
                    </form>
                <?php    
                } ?>
        </aside>
    </div>
    <?php 
    }
    ?>