<?php
require_once('config.php');

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

$result = $conexion->query("SELECT * FROM tareas");

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>ID</th>
    <th>Título</th>
    <th>Descripción</th>
    <th>Estado</th>
    <th>Fecha</th>
    <th>Autor</th>
    <th>Tipo de Tarea</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["id"]."</td>
        <td>".$row["titulo"]."</td>
        <td>".$row["descripcion"]."</td>
        <td>".$row["estado"]."</td>
        <td>".$row["fecha"]."</td>
        <td>".$row["autor"]."</td>
        <td>".$row["tipo_de_tarea"]."</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "No hay tareas registradas.";
}

$conexion->close();
?>
