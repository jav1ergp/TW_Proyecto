<!DOCTYPE html>
<html>

<body>
    <main>
        <h3>Eventos del sistema</h3>
        <?php
        $logs = mysqli_query($db, "SELECT * FROM logs ORDER BY fecha DESC");
        if ($logs) {
            while ($log = mysqli_fetch_assoc($logs)) {
                $fecha = $log['fecha'];
                $descripcion = $log['descripcion'];
                ?>

                <p class="fila-log">
                    <span class="fecha-log"><?php echo $fecha; ?></span>
                    <span class="descrip-log"><?php echo $descripcion; ?></span>
                </p>

                <?php
            }
        } else {
            echo "<p>No hay eventos en el sistema debido al error: " . mysqli_error($db) . "</p>";
        }
        ?>
    </main>
</body>

</html>