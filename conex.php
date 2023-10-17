<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $autor = $_POST['autor'];
    $tipo_de_tarea = $_POST['tipo_de_tarea'];

    // $tarea = $_POST['tarea'];
    // $completada = isset($_POST['completada']) ? 1 : 0;

    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    //echo "Conectado exitosamente a la base de datos";

    // Insertar la tarea en la base de datos
    $sql = "INSERT INTO tareas (id, titulo, descripcion, estado, fecha, autor, tipo_de_tarea) VALUES ('$id', '$titulo', '$descripcion', '$estado', '$fecha', '$autor', '$tipo_de_tarea')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: tareas.php");
        exit();
    } else {
        echo "Error al guardar la tarea: " . $conexion->error;
    }
    
    $conexion->close();
}
?>