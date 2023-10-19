<!-- <?php
require_once('config.php');

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

$result = $conexion->query("SELECT * FROM tareas");

if ($result->num_rows > 0) {
    echo "<h1> Lista de Tareas Agregadas </h1>";
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

echo "<br>";

    echo '<form method="post" action="prj1.html">';
    echo '<input type="submit" name="submit" value="Agregar Nueva Tarea">';
    echo '</form>';

    echo '<form method="post" action="reporte.php">';
    echo '<input type="submit" name="submit" value="Reporte">';
    echo '</form>';

?> -->

<?php
require_once('config.php');

$conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Verificar si se ha enviado el formulario de reporte
if (isset($_POST['submit_reporte'])) {
    $tipo_reporte = $_POST['tipo_reporte'];

    switch ($tipo_reporte) {
        case 'tipo_tarea':
            $sql = "SELECT tipo_de_tarea, COUNT(*) as cantidad FROM tareas GROUP BY tipo_de_tarea";
            break;
        case 'estado':
            $sql = "SELECT estado, COUNT(*) as cantidad FROM tareas GROUP BY estado";
            break;
        case 'dia':
            $sql = "SELECT DATE(fecha) as fecha, COUNT(*) as cantidad FROM tareas GROUP BY DATE(fecha)";
            break;
        case 'semana':
            $sql = "SELECT YEARWEEK(fecha) as semana, COUNT(*) as cantidad FROM tareas GROUP BY YEARWEEK(fecha)";
            break;
        case 'mes':
            $sql = "SELECT DATE_FORMAT(fecha, '%Y-%m') as mes, COUNT(*) as cantidad FROM tareas GROUP BY DATE_FORMAT(fecha, '%Y-%m')";
            break;
        case 'anio':
            $sql = "SELECT YEAR(fecha) as anio, COUNT(*) as cantidad FROM tareas GROUP BY YEAR(fecha)";
            break;
        default:
            $sql = "SELECT * FROM tareas";
            break;
    }

    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1> Reporte de Tareas </h1>";
        echo "<table border='1'>
        <tr>
        <th>Criterio</th>
        <th>Cantidad</th>
        </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>".$row["criterio"]."</td>
            <td>".$row["cantidad"]."</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "No hay tareas para el criterio seleccionado.";
    }
} else {
    // Código original para mostrar la lista de tareas
    $result = $conexion->query("SELECT * FROM tareas");

    if ($result->num_rows > 0) {
        echo "<h1> Lista de Tareas Agregadas </h1>";
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
}

$conexion->close();

echo "<br>";

echo '<form method="post" action="prj1.html">';
echo '<input type="submit" name="submit" value="Agregar Nueva Tarea">';
echo '</form>';

echo '<form method="post" action="reporte.php">';
echo '<label for="tipo_reporte">Seleccione el tipo de reporte:</label>
      <select name="tipo_reporte" id="tipo_reporte">
        <option value="tipo_tarea">Por Tipo de Tarea</option>
        <option value="estado">Por Estado</option>
        <option value="dia">Por Día</option>
        <option value="semana">Por Semana</option>
        <option value="mes">Por Mes</option>
        <option value="anio">Por Año</option>
      </select>
      <input type="submit" name="submit_reporte" value="Generar Reporte">';
echo '</form>';
?>