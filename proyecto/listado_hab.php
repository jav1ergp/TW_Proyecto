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

    <!-- Página de bienvenida -->
    <div class="contenedor">
        <main>
            <div class='listado'>
                <h3>Gestión de habitaciones</h3>
                <h4>Listado de habitaciones</h4>
            </div>

            <div class='accion-a-realizar'>
                <p>Indique la acción a realizar</p>
                <ul>
                    <li><a href="registro.php">Añadir nuevo usuario</a></li>
                    <?php
                    if (isset($_SESSION["usuario"]) && isset($_SESSION["usuario"]["rol"])) {
                        if ($_SESSION["usuario"]["rol"] === "recepcionista") { ?>
                            <li><a href="add-habitacion.php">Añadir nueva habitacion</a></li>
                        <?php }
                        if ($_SESSION["usuario"]["rol"] === "recepcionista" || $_SESSION["usuario"]["rol"] === "administrador") { ?>
                            <li><a href="listado.php">Listado usuarios</a></li>
                        <?php }
                        if ($_SESSION["usuario"]["rol"] !== "administrador") { ?>
                            <li><a href="listado_res.php">Listado reservas</a></li>
                        <?php }
                    } ?>
                    <li><a href="listado_hab.php">Listado Habitaciones</a></li>
                </ul>
            </div>
            <?php
            // Establecer el número de registros por página
            $registros_pag = isset($_SESSION['registros_pag']) ? $_SESSION['registros_pag'] : 3;

            // Obtener el número total de registros
            $total_registros_query = mysqli_query($db, 'SELECT COUNT(*) as total FROM habitacion');
            $total_registros = mysqli_fetch_assoc($total_registros_query)['total'];

            // Calcular el número total de páginas
            $total_paginas = ceil($total_registros / $registros_pag);

            // Obtener el número de página actual
            $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

            // Calcular el índice inicial y final de los registros a mostrar en esta página
            $indice_inicial = ($pagina_actual - 1) * $registros_pag;
            $indice_final = $indice_inicial + $registros_pag;
            ?>
            <!-- Formulario para configurar el número de registros por página -->
            <form method="POST" action="" class="registros_pag">
                <label class="">Registros por página:</label>
                <input class="" type="number" id="registros_pag" name="registros_pag"
                    value="<?php echo $registros_pag; ?>">
                <input id="enviar" type="submit" value="Actualizar">
            </form>

            <?php
            // Actualizar el número de registros por página
            if (isset($_POST['registros_pag'])) {
                $_SESSION['registros_pag'] = $_POST['registros_pag'];
                header("Location: " . $_SERVER['PHP_SELF']);
            }
            // Consultar los registros de la página actual
            $resultado = mysqli_query($db, "SELECT * FROM habitacion LIMIT $indice_inicial, $registros_pag");


            // Verificar si se obtuvieron resultados
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                // Iterar sobre los registros y mostrar la información
                while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                    <div class="datos-total">
                        <div class="datos-cada-usuario">
                            <?php
                            echo '<ul>';
                            echo '<li>Numero: ' . $fila['numero'] . '</li>';
                            echo '<li>Capacidad: ' . $fila['capacidad'] . '</li>';
                            echo '<li>Precio: ' . $fila['precio'] . '</li>';
                            echo '<li>Descripcion: ' . $fila['descripcion'] . '</li>';
                            echo '</ul>'; ?>
                        </div>

                        <div class="editar-usuario">
                            <form method="GET" action="datos-hab.php">
                                <input type="hidden" name="numero" value="<?php echo $fila['numero']; ?>">
                                <input type="submit" value="Ver Datos">
                            </form>
                        </div>

                        <div class="editar-usuario">
                            <?php if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] === "recepcionista")) { ?>
                                <form method="GET" action="editar-hab.php">
                                    <input type="hidden" name="numero" value="<?php echo $fila['numero']; ?>">
                                    <input type="submit" value="Editar">
                                </form>
                            <?php } ?>
                        </div>

                        <div class="editar-usuario">
                            <?php if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] === "recepcionista")) { ?>
                                <form method="GET" action="borrar-hab.php">
                                    <input type="hidden" name="numero" value="<?php echo $fila['numero']; ?>">
                                    <input type="submit" value="Borrar">
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                <?php }
            } else {
                echo 'No hay registros para mostrar.';
            }


            //Barra de navegación para avanzar o retroceder entre las páginas
            ?>
            <div class="paginacion">
                <?php if ($total_paginas > 1): ?>
                    <?php if ($pagina_actual > 1): ?>
                        <a href="?pagina=<?php echo ($pagina_actual - 1); ?>">Anterior</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <a href="?pagina=<?php echo $i; ?>" <?php echo ($pagina_actual == $i) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($pagina_actual < $total_paginas): ?>
                        <a href="?pagina=<?php echo ($pagina_actual + 1); ?>">Siguiente</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

        </main>
        <?php
        include ("partials/side-menu.php");
        ?>
    </div>
    <!-- Footer de la web -->
    <?php include ("partials/footer.php"); ?>
</body>

</html>