<?php
include './conexion.php';

$buscador=mysqli_query("select * from materia where MateriaNombre like lower ('%".$_POST["buscar"]."%') or tema like lower ('%".$_POST["buscar"]."%')");
$numero = mysqli_num_rows($buscador);
?>

<h5 class="card-tittle"> Resultados encontrados (<?php echo $numero?>): </h5>

<?php while($resultado = mysqli_fetch_assoc($buscador)){ ?>
    <p class="card-text"><?php echo $resultado["MateriaNombre"]: ?> - <?php echo $resultado["Descripcion"] ?></p>



<?php } ?>


