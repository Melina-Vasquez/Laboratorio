<?php
include './conexion.php';

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($datos = $resultado->fetch_object()) {
        echo "<tr>";
        echo "<td>" . $datos->IdMateria . "</td>";
        echo "<td>" . $datos->MateriaNombre . "</td>";
        echo "<td>" . $datos->Estado . "</td>";
        echo "<td>" . $datos->Descripcion . "</td>";
        echo "<td>
                <a href='./modificar.php?id={$datos->IdMateria}' class='btn btn-small btn-warning'><i class='fa-solid fa-pen-to-square'></i></a>
                <a href='./eliminar.php?id={$datos->IdMateria}' class='btn btn-small btn-danger' onclick='return confirm(\"¿Está seguro de eliminar esta materia?\");'><i class='fa-solid fa-trash'></i></a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No se encontraron resultados</td></tr>";
}

$conexion->close();
?>