<?php
require_once 'db_connection.php';

//Funcion que se encarga de validar todos los campos
function validarTodosLosCampos()
{
    
    $nombreValido = campoEsValido("nombre");
    $apellidosValidos = campoEsValido("apellidos");
    $dniValido = campoEsValido("dni");
    return $nombreValido && $apellidosValidos && $dniValido && validarTodosLosCampos2();
}

function validarTodosLosCampos2()
{
    $emailValido = campoEsValido2("email");
    $claveValida = campoEsValido("clave");
    $tarjetaValida = campoEsValido("tarjeta");

    return  $emailValido && $claveValida && $tarjetaValida;
}

function campoEsValido($campo)
{
    global $db;
    switch ($campo) {
        case "nombre":
        case "apellidos":
            if (!empty($_POST[$campo])) {
                return true;
            }
            break;

        case "dni":
            if (isset($_POST[$campo]) && preg_match("/^[0-9]{8}[A-Za-z]$/", $_POST[$campo])) {
                return true;
            }
            break;

        case "clave":
            if (
                (isset($_POST['clave-nueva']) && !empty($_POST['clave-nueva']))
                && (isset($_POST['confirmar-clave-nueva']) && !empty($_POST['confirmar-clave-nueva']))
                && ($_POST['clave-nueva'] == $_POST['confirmar-clave-nueva']) && (strlen($_POST['clave-nueva']) >= 5)
            ) {
                return true;
            }
            break;
        case "tarjeta":
            if (isset($_POST['tarjeta']) && preg_match("/^\d{16}$/", $_POST['tarjeta'])) {
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
        case "email":
            $emailRepetido = false;
            $mailDB = mysqli_query($db, "SELECT * FROM usuarios WHERE email = '" . mysqli_real_escape_string($db, $_POST[$campo]) . "'");
            if ($mailDB) {
                if ($mailDB && mysqli_affected_rows($db) > 0) {
                    $emailRepetido = true;
                }
            }

            if (isset($_POST[$campo]) && filter_var($_POST[$campo], FILTER_VALIDATE_EMAIL) && !$emailRepetido) {
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
        case "email":
            return (isset($_POST['add-usuario']) || isset($_POST['modificar-usuario'])) && !campoEsValido2($campo);
        default:
            return (isset($_POST['add-usuario']) || isset($_POST['modificar-usuario'])) && !campoEsValido($campo);
    }
}

 //Función que inserta el usuario en la base de datos
function insertarEnBD()
{
    global $db;
    //Insertar todos los datos del usuario en la tabla
    $nombre = $_SESSION["nombre"];
    $apellidos = $_SESSION["apellidos"];
    $email = $_SESSION["email"];
    $dni = $_SESSION["dni"];
    $clave = $_SESSION["clave"];
    $tarjeta = $_SESSION["tarjeta"];
    $rol = $_SESSION["rol"];

    mysqli_query($db, "INSERT INTO usuarios (nombre, apellidos, email, dni, clave, tarjeta, rol) 
        VALUES ('$nombre', '$apellidos', '$email', '$dni', '$clave', '$tarjeta', '$rol')");
}

//Actualización de variables de sesión con saneamiento de datos
function actualizarVarSesion()
{
    $_SESSION['nombre'] = htmlentities(strip_tags($_POST['nombre']));
    $_SESSION['apellidos'] = htmlentities(strip_tags($_POST['apellidos']));
    $_SESSION['dni'] = htmlentities(strip_tags($_POST['dni']));
    
    actualizarVarSesion2();
}
function actualizarVarSesion2()
{
    $_SESSION['email'] = htmlentities(strip_tags($_POST['email']));
    $_SESSION['tarjeta'] = htmlentities(strip_tags($_POST['tarjeta']));
    $_SESSION['rol'] = htmlentities(strip_tags($_POST['rol']));
    if (!empty($_POST['clave-nueva'])) {
        $hash = password_hash(htmlentities(strip_tags($_POST['clave-nueva'])), PASSWORD_DEFAULT);
        $_SESSION['clave'] = $hash;
    }
}



function borrar(){
    global $db;
    global $email_borrar;
      // Ejecutar la consulta DELETE
    $query = mysqli_query($db, "DELETE FROM usuarios WHERE email = '" . mysqli_real_escape_string($db, $email_borrar) . "'");
    
    if (!($query && mysqli_affected_rows($db) > 0)) {
        // La consulta falló o no se eliminó ninguna fila?>
        <p class='error-formulario'>ERROR: No se pudo borrar el usuario de la BBDD.</p> <?php
    }
}

function actualizar($campo) {
    global $db;
    // Escapar el campo y el valor para la consulta SQL
    $campo_escapado = mysqli_real_escape_string($db, $campo);
    $valor_escapado = mysqli_real_escape_string($db, $_SESSION[$campo]);

    if ($_SESSION["usuario"][$campo] != $_SESSION[$campo]) {
        $query = "UPDATE usuarios SET $campo_escapado = '$valor_escapado' WHERE email = '" . mysqli_real_escape_string($db, $_SESSION["usuario"]["email"]) . "'";
        $result = mysqli_query($db, $query);
        if ($result && mysqli_affected_rows($db) > 0) {
            $_SESSION["usuario"][$campo] = $_SESSION[$campo];
        }
    }
}

function actualizarEnBD() {
    actualizar("email");
    actualizar("clave");
    actualizar("tarjeta");
}

function inicializarVarSesion($campo) {
    global $enviadoCorrectamente;
    global $datosConfirmados;
    if (!$datosConfirmados && !$enviadoCorrectamente) {
        $_SESSION[$campo] = $_SESSION["usuario"][$campo];
    }
}

function inicializarTodasVarSesion() {
    inicializarVarSesion("email");
    inicializarVarSesion("clave");
    inicializarVarSesion("tarjeta");
    inicializarVarSesion("rol");
}
?>
