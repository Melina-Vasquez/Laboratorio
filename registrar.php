<?php
    include './conexion.php';

if (isset($_POST["btnregistrar"])) {
    if (!empty($_POST["MateriaNombre"]) or $_POST["Estado"] == 0 or $_POST["Estado"] == 1 and !empty($_POST["Descripcion"])) {

        $MateriaNombre = $_POST["MateriaNombre"];
        $Estado = $_POST["Estado"];
        $Descripcion = $_POST["Descripcion"];

        $sql = $conexion->query("insert into materia(MateriaNombre,Estado,Descripcion) values('$MateriaNombre' , '$Estado' , '$Descripcion')");
        if ($sql == 1) {
            echo '<div class="alert alert-success"> Materia resgistrada exitosamente </div>';
        } else {
            echo '<div class="alert alert-danger"> Error al Registrar nueva Materia </div>';
        }

        $_POST["MateriaNombre"] == "";
        $_POST["Estado"] == "";
        $_POST["Descripcion"] == "";
    } else {
        echo '<div class="alert alert-warning"> Algunos de los campos estan vacios </div>';
    }
}

header("Location: index.php");
exit();
?>