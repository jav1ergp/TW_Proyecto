<?php
require_once 'db_connection.php';

//Funcion que se encarga de validar todos los campos
function validarTodosLosCampos()
{
    $numeroValido = campoEsValido2("numero");
    return $numeroValido && validarTodosLosCampos2();
}

function validarTodosLosCampos2()
{
    $capacidadValido = campoEsValido("capacidad");
    $precioValido = campoEsValido("precio");
    $descripcionValido = campoEsValido("descripcion");
    return $capacidadValido && $precioValido && $descripcionValido;
}

function campoEsValido($campo)
{
    global $db;
    switch ($campo) {
        case "capacidad":
        case "precio":
            if (!empty($_POST[$campo]) && is_numeric($_POST[$campo])) {
                return true;
            }
            break;

        case "descripcion":
            if (!empty($_POST[$campo])) {
                return true;
            }
            break;
        
    }
    return false;
}

function campoEsValido2($campo)
{
    global $db;
    switch ($campo) {
    case "numero":
        $numeroRepetido = false;
        $numDB = mysqli_query($db, "SELECT * FROM habitacion WHERE numero = '" . mysqli_real_escape_string($db, $_POST[$campo]) . "'");
        if ($numDB) {
            if ($numDB && mysqli_affected_rows($db) > 0) {
                $numeroRepetido = true;
            }
        }

        if (isset($_POST[$campo]) && !$numeroRepetido) {
            return true;
        }
        break;
    }
    return false;
}

 //Función que comprueba si hay errores en un campo.
function hayErrores($campo)
{
    switch ($campo) {
        case "numero":
            return (isset($_POST['add-habitacion']) || isset($_POST['modificar-habitacion'])) && !campoEsValido2($campo);
        default:
            return (isset($_POST['add-habitacion']) || isset($_POST['modificar-habitacion'])) && !campoEsValido($campo);
    }
}

 //Función que inserta el usuario en la base de datos
function insertarEnBD()
{
    global $db;
    //Insertar todos los datos del usuario en la tabla
    $numero = $_SESSION["numero"];
    $capacidad = $_SESSION["capacidad"];
    $precio = $_SESSION["precio"];
    $descripcion = $_SESSION["descripcion"];

    mysqli_query($db, "INSERT INTO habitacion (numero, capacidad, precio, descripcion) 
        VALUES ('$numero', '$capacidad', '$precio', '$descripcion')");
}

//Actualización de variables de sesión con saneamiento de datos
function actualizarVarSesion()
{
    $_SESSION['numero'] = htmlentities($_POST['numero']);
    actualizarVarSesion2();
}
function actualizarVarSesion2()
{
    $_SESSION['capacidad'] = htmlentities($_POST['capacidad']);
    $_SESSION['precio'] = htmlentities($_POST['precio']);
    $_SESSION['descripcion'] = htmlentities($_POST['descripcion']);
}


function borrar(){
    global $db;
    global $num_borrar;
      // Ejecutar la consulta DELETE
    $query = mysqli_query($db, "DELETE FROM habitacion WHERE numero = '" . mysqli_real_escape_string($db, $num_borrar) . "'");
    
    if (!($query && mysqli_affected_rows($db) > 0)) {
        // La consulta falló o no se eliminó ninguna fila?>
        <p class='error-formulario'>ERROR: No se pudo borrar la habitacion de la BBDD.</p> <?php
    }
}

function actualizar($campo) {
    global $db;
    // Escapar el campo y el valor para la consulta SQL
    $campo_escapado = mysqli_real_escape_string($db, $campo);
    $valor_escapado = mysqli_real_escape_string($db, $_SESSION[$campo]);

    if ($_SESSION["habitacion"][$campo] != $_SESSION[$campo]) {
        $query = "UPDATE habitacion SET $campo_escapado = '$valor_escapado' WHERE numero = '" . mysqli_real_escape_string($db, $_SESSION["habitacion"]["numero"]) . "'";
        $result = mysqli_query($db, $query);
        if ($result && mysqli_affected_rows($db) > 0) {
            $_SESSION["habitacion"][$campo] = $_SESSION[$campo];
        }
    }
}

function actualizarEnBD() {
    actualizar("capacidad");
    actualizar("precio");
    actualizar("descripcion");
}

function inicializarVarSesion($campo) {
    global $enviadoCorrectamente;
    global $datosConfirmados;
    if (!$datosConfirmados && !$enviadoCorrectamente) {
        $_SESSION[$campo] = $_SESSION["habitacion"][$campo];
    }
}

function inicializarTodasVarSesion() {
    inicializarVarSesion("capacidad");
    inicializarVarSesion("precio");
    inicializarVarSesion("descripcion");
}
?>
