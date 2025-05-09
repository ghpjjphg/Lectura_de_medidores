<?php include("include/header.php") ?>
<?php include("include/footer.php") ?>
<?php include("db.php") ?>
<?php

if (isset($_SESSION['rol']) and $_SESSION['rol'] == 2) {
?>
    <?php include("narvar.php") ?>
    <div class="container">
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-success align-items-center text-center alert-dismissible" role="alert">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>

        <?php session_unset();
        } ?>
        <div class="row">
            <table class="table table-bordered">

                <thead>
                    <h5 class="text-center">Medidores</h5><br>
                    <tr class="text-center">
                        <th>Numero de medidor</th>
                        <th>Ruta</th>
                        <th>Consumo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['n_ruta'])) {
                        $numero_de_ruta = $_GET['n_ruta'];
                        $query = "SELECT ruta.id_ruta, ruta.id_contador, contador.lectura_final FROM ruta INNER JOIN contador on contador.id_contador=ruta.id_contador WHERE id_ruta=$numero_de_ruta;";
                        $consulta = mysqli_query($conn, $query);
                        $verificar_ruta = $consulta->num_rows;
                        if ($verificar_ruta <= 0) {
                    ?>
                            <div class="alert alert-info align-items-center text-center alert-dismissible" role="alert">
                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:">
                                    <use xlink:href="#info-fill" />
                                </svg>
                                <div>
                                    <use xlink:href="#exclamation-triangle-fill" />
                                    </svg>
                                    <div>
                                        Este ruta no existe
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            <?php
                        }
                        while ($row = mysqli_fetch_array($consulta)) { ?>
                                <br>
                                <tr class="text-center">
                                    <td> <?php echo $row['id_contador'] ?></td>
                                    <td><?php echo $row['id_ruta'] ?></td>
                                    <td><?php echo $row['lectura_final'] ?></td>
                                    <td> <a href="indexcontador.php?id=<?php echo $row["id_contador"] ?> " class="btn btn-secondary ">
                                            <i class="fa-solid fa-pen"></i>
                                    </td>
                                </tr>
                            </div>
        </div>
<?php }
                    }
                    $_SESSION['rol'] = 2; ?>
</tbody>

</table>

<?php
} else {
    header("location:index.php");
    echo "ingrese correctamente";
}
?>