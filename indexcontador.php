<?php include("include/header.php") ?>
<?php include("include/footer.php") ?>
<?php include("db.php") ?>
<?php

if (isset($_SESSION['rol']) and $_SESSION['rol'] == 2 ) {
?>
  <?php include("narvar.php") ?>
<?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT contador.id_contador, contador.lectura_final, contador.fecha_lectura, usuarios.id_usuario,usuarios.nombre_usuario, usuarios.direccion, ruta.id_ruta FROM contador INNER JOIN usuarios ON usuarios.id_usuario=contador.id_usuario INNER JOIN ruta ON ruta.id_contador=contador.id_contador WHERE contador.id_contador='$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $contador = $row['id_contador'];
        $direccion = $row['direccion'];
        $idUsuario = $row['id_usuario'];
        $usuario = $row['nombre_usuario'];
        $lectura_f = $row['lectura_final'];
        $fecha_lectura = $row['fecha_lectura'];
        $ruta = $row['id_ruta'];
    }
}

?>
<?php include("narvar.php");?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($_SESSION['message_menor'])) { ?>
                <div class="alert alert-danger align-items-center text-center alert-dismissible" role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?= $_SESSION['message_menor'] ?> <br>
                        <!-- <a href="inconcistencias.php?id=<?php echo $contador ?>"> <button class="btn btn-light">Reporte de inconcistencias</button> </a> -->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>

            <?php session_unset();
            } ?>
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

            <div class="text-center">
                <?php $_SESSION['rol'] = 2 ;?>
           <a href="ruta_contador.php?n_ruta=<?php echo $ruta?>"><button class="btn btn-success">Regresar a la ruta <?php echo $ruta?> </button></a><br> <br>
                <h5>Lectura de medidor</h5><br>
                <form action="actualizar_lectura.php"   method="POST">
                    <div class="form_group">
                        <h6>Numero de contador
                        </h6>
                        <input class="text-center" type="text" name="contador" value="<?php echo $contador; ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group">
                        <h6>ruta
                        </h6>
                        <input class="text-center" type="text" name="n_ruta" value="<?php echo $ruta ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group">
                        <h6>Identificador de usuario
                        </h6>
                        <input class="text-center" type="text" name="idusuario" value="<?php echo $idUsuario ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group">
                        <h6>Direccion
                        </h6>
                        <input class="text-center" type="text" name="ubicacion" value="<?php echo $direccion ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group">
                        <h6>Nombre del ususario
                        </h6>
                        <input class="text-center" type="text" name="usuario" value="<?php echo $usuario; ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group">
                        <h6>Lectura
                        </h6>
                        <input class="text-center" type="number" name="lectura_fin" class="from_control" placeholder="Ingrese la lectura" required>
                    </div> <br>
                    <button class="btn btn-success" name="actualizar">
                        Guardar lectura
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
} else {
  header("location:index.php");

}
?>

