<?php
include './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['ID'])) {
        $id = intval($_GET['ID']);
        $sql = "SELECT * FROM materia WHERE IdMateria = $id";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $response = [
                'idMateria' => $row['IdMateria'],
                'materiaNombre' => $row['MateriaNombre'],
                'estado' => $row['Estado'],
                'descripcion' => $row['Descripcion']
            ];
        } else {
            $response = ['success' => false, 'error' => 'Id no registrado'];
            http_response_code(500);
        }
    } else {
        $resultado = $conexion->query("SELECT * FROM materia");
        $response = [];

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            while ($row = $resultado->fetch_assoc()) {
                $response[] = [
                    'idMateria' => $row['IdMateria'],
                    'materiaNombre' => $row['MateriaNombre'],
                    'estado' => $row['Estado'],
                    'descripcion' => $row['Descripcion']
                ];
            }
        } else {
            $response = ['success' => false, 'error' => 'Id no registrado'];
            http_response_code(500);
        }
    }
} else {
    echo "<div class='alert alert-warning'> No se encontro el Id ingresado o no existe</div>";
}

$conexion->close();

header('Content-Type: application/json');
echo json_encode($response);

exit();
