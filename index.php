<?php
session_start(); // Iniciar la sesión para poder usar variables de sesión

// Incluir el archivo de conexión si no está incluido aún
if (!isset($conexion)) {
    include './conexion.php';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio Tu Hermana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/e496628137.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e496628137.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>


<body>
<header class="container-fluid bg-dark text-white text-center">
        <div class="container">

            <nav class="navbar navbar-expand-xl">
                <div class="container-fluid">

                    <!-- logo -->
                  <h1>
                      <a style="color: rgb(255 255 255);text-decoration: none;" href="https://www.servicios.com/">Laboratorio Tu Hermana </a>
                  </h1>

</header>

    <h1 class="text-center p-3">Acceso Administrador</h1>

    <div class="container-fluid row">

        <form class="col-4 p-3 needs-validation" method="POST" action="registrar.php" novalidate>
            <h3 class="text-center text-secondary">Registro de Materia</h3>
            <div class="col-md-6">
                <label for="validationDefault01" class="form-label">Materia Nombre</label>
                <input type="text" class="form-control" id="validationDefault01" required name="MateriaNombre">
                <div class="invalid-feedback">
                    Por favor, ingrese el nombre de la materia.
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationDefault04" class="form-label">Estado</label>
                <select class="form-select" id="validationDefault04" required name="Estado">
                    <option selected disabled>Selecciona su estado</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
                <div class="invalid-feedback">
                    Por favor, seleccione un estado.
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationDefault02" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="validationDefault02" required name="Descripcion">
                <div class="invalid-feedback">
                    Por favor, ingrese una descripción.
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                    <label class="form-check-label" for="invalidCheck2">
                        Los campos cargados son correctos
                    </label>
                    <div class="invalid-feedback">
                        Debe confirmar que los campos cargados son correctos.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="btnregistrar" value="ok">Registrar nueva Materia</button>
            </div>
        </form>

        <!-- Listado de Materias -->
        <div class="col-8 p-4">
            <h3 class="text-center text-secondary">Listado de Materias</h3>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Ingrese el Id de busqueda" aria-describedby="basic-addon2" id="idBusqueda">
                <button class="btn btn-outline-secondary" type="button" id="btnBuscarId"><i class="fas fa-search"></i></button>
            </div>

            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">IdMateria</th>
                        <th scope="col">Materia Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $sql = $conexion->query("SELECT * FROM materia");
                    while ($datos = $sql->fetch_object()) { ?>
                        <tr>
                            <td><?= $datos->IdMateria ?></td>
                            <td><?= $datos->MateriaNombre ?></td>
                            <td><?= $datos->Estado ?></td>
                            <td><?= $datos->Descripcion ?></td>
                            <td>
                                <a href="./modificar.php?id=<?= $datos->IdMateria ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="./eliminar.php?id=<?= $datos->IdMateria ?>" onclick="return confirmar()" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()

        // Función para cargar y mostrar las materias según la búsqueda
        //de la linea 134 a 55 es lo que ya estaba
        /*     function cargarMaterias(id) {
                 $.ajax({
                     url: 'buscar_materia.php',
                     type: 'GET',
                     data: { ID: id },
                     dataType: 'html',
                     success: function(response) {
                         console.log(response);
                         $('#table-group-divider').html(response);
                     }
                 });
             }

             // Cargar todas las materias al cargar la página
             $(document).ready(function() {
                 // Buscar al hacer clic en el botón de búsqueda
                 $('#btnBuscarId').click(function() {
                     var busqueda = document.getElementById("idBusqueda").value
                     cargarMaterias(busqueda);
                 });
             });*/


        //Función para cargar y mostrar las materias según la búsqueda

        function cargarMaterias() {
            var id = $('#idBusqueda').val(); // Obtener el valor del campo de búsqueda

            $.ajax({
                url: 'buscar_materia.php',
                type: 'GET',
                data: {
                    ID: id
                },
                dataType: 'html',
                success: function(response) {
                    debugger;
                    console.log(response);
                    $('#table-group-divider').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar las materias:', error);
                }
            });
        }

        // Buscar al hacer clic en el botón de búsqueda
        $('#btnBuscarId').click(function() {
            cargarMaterias(); // Llamar a la función sin parámetros para realizar la búsqueda
        });

        function confirmar() {
            return confirm("¿Desea eliminar la materia?");
        }
    </script>
    <footer class="container-fluid bg-dark text-white text-center">
  
        <ul class="linkFooter">
        <li><a href="https://www.servicios.com/"><i class=""></i>Contactanos: soporte@servicios.com</a></li>
        </ul>
      </div>

        <div class="container">
            <p class="fw-lighter mb-0">&copy; 2024 - Derechos Reservados</p>
            <p class="fw-lighter mt-0">Desarrollado por Vasquez Melina | Analista en Sistemas <a href=""></a></p>
        </div>
    </footer>
</body>

</html>