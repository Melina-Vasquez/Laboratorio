<?php
include './conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Incluir archivo para modificar la materia
    include './modificar_materia.php';
}

// Obtener los datos de la materia para mostrar en el formulario
$id = $_GET["id"];
$sql = $conexion->query("SELECT * FROM materia WHERE IdMateria = $id");
if ($sql->num_rows > 0) {
    $datos = $sql->fetch_object();
} else {
    echo "<div class='alert alert-danger'>No se encontró la materia</div>";
    header("Location: index.php");
    exit(); // Salir si no se encuentra la materia
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio Tu Hermana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form class="col-4 p-3 m-auto" method="POST" action="modificar_materia.php">
        <h3 class="text-center text-secondary">Modificar Materia</h3>
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="col-md-6">
            <label for="validationDefault01" class="form-label">Materia Nombre</label>
            <input type="text" class="form-control" name="MateriaNombre" value="<?= $datos->MateriaNombre ?>">
        </div>
        <div class="col-md-6">
            <label for="validationDefault04" class="form-label">Estado</label>
            <select class="form-select" id="validationDefault04" required name="Estado">
                <option disabled>Selecciona su estado</option>
                <?php
                if ($datos->Estado == 0) {
                    echo '<option value="0" selected>0</option>';
                } else {
                    echo '<option value="0">0</option>';
                }

                if ($datos->Estado == 1) {
                    echo '<option value="1" selected>1</option>';
                } else {
                    echo '<option value="1">1</option>';
                }
                ?>
            </select>
        </div>

        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="Descripcion" value="<?= $datos->Descripcion ?>">
        </div>

        <button class="btn btn-primary mt-3" type="submit" name="btnModificarMateria" value="ok">Modificar Materia</button>
        <button class="btn btn-primary mt-3" type="button" onclick="window.location.href='index.php'">Cancelar</button>

    </form>
</body>

</html>