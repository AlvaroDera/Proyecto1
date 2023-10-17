<!-- <?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarea = $_POST['tarea'];
    $completada = isset($_POST['completada']) ? 1 : 0;

    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    echo "Conectado exitosamente a la base de datos";

    $sql = "CALL InsertarTarea('$tarea', $completada)";

    if ($conexion->query($sql) === TRUE) {
        echo "Tarea guardada correctamente.";
    } else {
        echo "Error al guardar la tarea: " . $conexion->error;
    }

    $conexion->close();
}
?> -->
 
<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarea = $_POST['tarea'];
    $completada = isset($_POST['completada']) ? 1 : 0;

    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    echo "Conectado exitosamente a la base de datos";


    $sql = "INSERT INTO lista_verificacion (tarea, completada) VALUES ('$tarea', $completada)";

    if ($conexion->query($sql) === TRUE) {
        echo "Tarea guardada correctamente.";
    } else {
        echo "Error al guardar la tarea: " . $conexion->error;
    }

    $conexion->close();
}
?>