<!DOCTYPE html>
<html>
<?php
session_start();
include ("partials/head-html.php");
?>

<body>
    <?php if (isset($_SESSION["usuario"]["rol"]) && (($_SESSION["usuario"]["rol"] === "cliente") || ($_SESSION["usuario"]["rol"] === "recepcionista"))) { ?>
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
                    <h3>Gestión de reservas</h3>
                    <h4>Listado de reservas</h4>
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
                $total_registros_query = mysqli_query($db, 'SELECT COUNT(*) as total FROM reserva');
                $total_registros = mysqli_fetch_assoc($total_registros_query)['total'];

                // Calcular el número total de páginas
                $total_paginas = ceil($total_registros / $registros_pag);

                // Obtener el número de página actual
                $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                // Calcular el índice inicial de los registros a mostrar en esta página
                $indice_inicial = ($pagina_actual - 1) * $registros_pag;

                // Obtener parámetros de ordenación
                $ordenar_por = isset($_GET['ordenar_por']) ? $_GET['ordenar_por'] : 'antiguedad';
                $orden = isset($_GET['orden']) ? $_GET['orden'] : 'asc';

                // Obtener parámetros de filtrado
                $filtro_comentarios = isset($_GET['filtro_comentarios']) ? $_GET['filtro_comentarios'] : '';
                $fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';
                $fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';

                // Mapa de campos de ordenación válidos
                $ordenar_por_map = [
                    'antiguedad' => 'dia_entrada',
                    'dias_totales' => 'DATEDIFF(dia_salida, dia_entrada)' // Calculando el número total de días
                ];

                // Validar y construir la cláusula ORDER BY
                $campo_orden = array_key_exists($ordenar_por, $ordenar_por_map) ? $ordenar_por_map[$ordenar_por] : 'dia_entrada';
                $tipo_orden = ($orden === 'desc') ? 'DESC' : 'ASC';

                // Construir la consulta SQL con la cláusula WHERE y ORDER BY
                $query_base = "SELECT *, DATEDIFF(dia_salida, dia_entrada) AS dias_totales FROM reserva WHERE 1=1";

                // Aplicar filtro por comentarios
                if (!empty($filtro_comentarios)) {
                    $query_base .= " AND comentarios LIKE '%" . mysqli_real_escape_string($db, $filtro_comentarios) . "%'";
                }

                // Aplicar filtro por rango de fechas
                if (!empty($fecha_inicio) && !empty($fecha_fin)) {
                    $query_base .= " AND dia_entrada BETWEEN '" . mysqli_real_escape_string($db, $fecha_inicio) . "' AND '" . mysqli_real_escape_string($db, $fecha_fin) . "'";
                }

                // Aplicar filtro por usuario si es cliente
                if (isset($_SESSION["usuario"]["rol"]) && ($_SESSION["usuario"]["rol"] === "cliente")) {
                    $query_base .= " AND email = '" . $_SESSION["usuario"]["email"] . "'";
                }

                // Añadir orden y límite
                $query_base .= " ORDER BY $campo_orden $tipo_orden LIMIT $indice_inicial, $registros_pag";
                $resultado = mysqli_query($db, $query_base);

                // Actualizar el número de registros por página
                if (isset($_POST['registros_pag'])) {
                    $_SESSION['registros_pag'] = $_POST['registros_pag'];
                    header("Location: " . $_SERVER['PHP_SELF']);
                }
                ?>

                <!-- Formulario para configurar el número de registros por página -->
                <form method="POST" action="" class="registros_pag">
                    <label class="">Registros por página:</label>
                    <input class="" type="number" id="registros_pag" name="registros_pag"
                        value="<?php echo $registros_pag; ?>">
                    <input id="enviar" type="submit" value="Actualizar">
                </form>

                <!-- Opciones de filtrado -->
                <div class="filtrado">
                    <form method="GET" action="">
                        <label>Buscar en comentarios:</label>
                        <input type="text" name="filtro_comentarios"
                            value="<?php echo htmlspecialchars($filtro_comentarios); ?>">

                        <label>Fecha de entrada desde:</label>
                        <input type="date" name="fecha_inicio" value="<?php echo htmlspecialchars($fecha_inicio); ?>">

                        <label>Fecha de salida hasta:</label>
                        <input type="date" name="fecha_fin" value="<?php echo htmlspecialchars($fecha_fin); ?>">

                        <label>Ordenar por:</label>
                        <select name="ordenar_por">
                            <option value="antiguedad" <?php echo $ordenar_por == 'antiguedad' ? 'selected' : ''; ?>>
                                Antigüedad</option>
                            <option value="dias_totales" <?php echo $ordenar_por == 'dias_totales' ? 'selected' : ''; ?>>
                                Número total de días</option>
                        </select>

                        <label>Orden:</label>
                        <select name="orden">
                            <option value="asc" <?php echo $orden == 'asc' ? 'selected' : ''; ?>>Ascendente</option>
                            <option value="desc" <?php echo $orden == 'desc' ? 'selected' : ''; ?>>Descendente</option>
                        </select>
                        <input type="submit" value="Filtrar y Ordenar">
                    </form>
                </div>

                <?php
                // Verificar si se obtuvieron resultados
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    // Iterar sobre los registros y mostrar la información
                    while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                        <div class="datos-total">
                            <div class="datos-cada-usuario">
                                <?php
                                echo '<ul>';
                                echo '<li>Email: ' . $fila['email'] . '</li>';
                                echo '<li>Número de habitación: ' . $fila['numero'] . '</li>';
                                echo '<li>Número de personas: ' . $fila['capacidad'] . '</li>';
                                echo '<li>Comentarios: ' . $fila['comentarios'] . '</li>';
                                echo '<li>Fecha de entrada: ' . $fila['dia_entrada'] . '</li>';
                                echo '<li>Fecha de salida: ' . $fila['dia_salida'] . '</li>';
                                echo '<li>Días totales: ' . $fila['dias_totales'] . '</li>';
                                echo '</ul>'; ?>
                            </div>

                            <div class="editar-usuario">
                                <form method="GET" action="datos-res.php">
                                    <input type="hidden" name="numero" value="<?php echo $fila['numero']; ?>">
                                    <input type="submit" value="Ver Datos">
                                </form>
                            </div>

                            <div class="editar-usuario">
                                <form method="GET" action="editar-res.php">
                                    <input type="hidden" name="numero" value="<?php echo $fila['numero']; ?>">
                                    <input type="submit" value="Editar">
                                </form>
                            </div>

                            <div class="editar-usuario">
                                <form method="GET" action="borrar-res.php">
                                    <input type="hidden" name="numero" value="<?php echo $fila['numero']; ?>">
                                    <input type="submit" value="Borrar">
                                </form>
                            </div>
                        </div>
                    <?php }
                } else {
                    echo 'No hay registros para mostrar.';
                }

                // Barra de navegación para avanzar o retroceder entre las páginas
                ?>
                <div class="paginacion">
                    <?php if ($total_paginas > 1): ?>
                        <?php if ($pagina_actual > 1): ?>
                            <a
                                href="?pagina=<?php echo ($pagina_actual - 1); ?>&ordenar_por=<?php echo $ordenar_por; ?>&orden=<?php echo $orden; ?>&filtro_comentarios=<?php echo urlencode($filtro_comentarios); ?>&fecha_inicio=<?php echo $fecha_inicio; ?>&fecha_fin=<?php echo $fecha_fin; ?>">Anterior</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <a href="?pagina=<?php echo $i; ?>&ordenar_por=<?php echo $ordenar_por; ?>&orden=<?php echo $orden; ?>&filtro_comentarios=<?php echo urlencode($filtro_comentarios); ?>&fecha_inicio=<?php echo $fecha_inicio; ?>&fecha_fin=<?php echo $fecha_fin; ?>"
                                <?php echo ($pagina_actual == $i) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                        <?php endfor; ?>

                        <?php if ($pagina_actual < $total_paginas): ?>
                            <a
                                href="?pagina=<?php echo ($pagina_actual + 1); ?>&ordenar_por=<?php echo $ordenar_por; ?>&orden=<?php echo $orden; ?>&filtro_comentarios=<?php echo urlencode($filtro_comentarios); ?>&fecha_inicio=<?php echo $fecha_inicio; ?>&fecha_fin=<?php echo $fecha_fin; ?>">Siguiente</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </main>
            <?php include ("partials/side-menu.php"); ?>
        </div>

        <!-- Footer de la web -->
        <?php include ("partials/footer.php"); ?>
    <?php } else { ?>
        <h1>No tienes permisos para acceder a esta página.</h1>
    <?php } ?>

</body>

</html>