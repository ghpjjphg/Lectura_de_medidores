<?php include("include/header.php") ?>
<?php include("include/footer.php") ?>
<?php include("db.php") ?>
<?php include("narvar.php") ?>
<div class="row">
    <div class="container">
        <table class="table table-bordered">

            <thead>
                <h5 class="text-center">Medidores</h5><br>
                <tr class="text-center">
                    <th>Numero de medidor</th>
                    <th>Ruta</th>
                    <th>Lectura</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM inconsistencias");
                $consulta = mysqli_num_rows($query);
                if ($consulta > 0) {
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <br>
                        <tr class="text-center">
                            <td> <?php echo $row['codigo_usuario'] ?></td>
                            <td><?php echo $row['nombre_usuario'] ?></td>
                            <td><?php echo $row['descripcion'] ?></td>
                            <td> <img height="50px" src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']) ?>"> </td>

                        </tr>

                <?php }
                }
                ?>
            </tbody>

        </table>
    </div>
</div>