<?php
include './conexion.php'; // Incluye el archivo de conexión

$id = $_GET["id"];
echo "<script>alert('El ID es: $id');</script>";
// Verificar si se recibió el parámetro id por GET
if (isset($_GET['id'])) {
    

    // Verificar si la conexión está establecida correctamente
    if ($conexion) {
        // Intentar eliminar la materia
        $eliminar = $conexion->query("DELETE FROM materia WHERE IdMateria='$id'");
        
        // Verificar si la eliminación fue exitosa
        if ($eliminar == 1) {
            echo "<div class='alert alert-success'>Materia Eliminada</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar la materia: " . $conexion->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error de conexión a la base de datos</div>";
    }
} else {
    echo "<div class='alert alert-warning'>No se proporcionó el parámetro ID para eliminar</div>";
}

// Cerrar la conexión
$conexion->close();

header("Location: index.php");
exit();
?>

<script>
    window.history.replaceState(null, null, window.location.pathname);
</script>