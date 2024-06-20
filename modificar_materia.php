<?php
include './conexion.php';

// Verificar si se ha enviado el formulario
if (isset($_POST["btnModificarMateria"])) {
    if (!empty($_POST["MateriaNombre"]) or $_POST["Estado"] == 0 or $_POST["Estado"] == 1 and !empty($_POST["Descripcion"])) {

        $id = $_POST["id"];
        $MateriaNombre = $_POST["MateriaNombre"];
        $Estado = $_POST["Estado"];
        $Descripcion = $_POST["Descripcion"];

        // Actualizar la materia en la base de datos
        $sql = "UPDATE materia SET MateriaNombre = '$MateriaNombre', Estado = '$Estado', Descripcion = '$Descripcion' WHERE IdMateria = $id";
        $resultado = $conexion->query($sql);
        if ($resultado) {
            header("location: index.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'> Error al modificar Materia</div>";
        }

    } else {
        echo "<div class='alert alert-warning'> Se encuentran campos vacíos</div>";
    }
}
?>