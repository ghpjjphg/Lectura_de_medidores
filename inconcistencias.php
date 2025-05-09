<?php
include("include/header.php");
include("include/footer.php");
include("db.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT contador.id_contador, contador.lectura_inicial, contador.lectura_final, contador.fecha_lectura, usuarios.id_usuario,usuarios.nombre_usuario, usuarios.direccion, ruta.id_ruta FROM contador INNER JOIN usuarios ON usuarios.id_usuario=contador.id_usuario INNER JOIN ruta ON ruta.id_contador=contador.id_contador WHERE contador.id_contador=$id;";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $contador = $row['id_contador'];
        $direccion = $row['direccion'];
        $idUsuario = $row['id_usuario'];
        $usuario = $row['nombre_usuario'];
        $lectura_i = $row['lectura_inicial'];
        $lectura_f = $row['lectura_final'];
        $fecha_lectura = $row['fecha_lectura'];
        $ruta = $row['id_ruta'];
    }
}

?>
<?php include("narvar.php"); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-12 colorinconcistencia">
            <div class="text-center">
                <h5>Inconsistencias</h5><br>
                <form action="guardar_inconcistencia.php" method="POST" enctype="multipart/form-data">
                    <div class="form_group">
                        <h6>Numero de contador
                        </h6>
                        <input class="text-center" type="text" name="contador" value="<?php echo $contador; ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group">
                        <h6>Ruta
                        </h6>
                        <input class="text-center" type="text" name="n_ruta" value="<?php echo $ruta ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group ">
                        <h6>Identificador de usuario
                        </h6>
                        <input class="text-center" type="text" name="idusuario" value="<?php echo $idUsuario ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group ">
                        <h6>Dirección
                        </h6>
                        <input class="text-center color_inconcistencia" type="text" name="ubicacion" value="<?php echo $direccion ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group">
                        <h6>Nombre del ususario
                        </h6>
                        <input class="text-center" type="text" name="usuario" value="<?php echo $usuario; ?>" class="from_control" readonly>
                    </div>
                    <div class="form_group">
                        <h6>Descripción de la inconcistencia
                        </h6>
                        <textarea class="text-center" type="text" name="descripcion_inconsistencia" class="from_control" required rows="2"></textarea>
                    </div>
                    <div class="form_group">
                        <h6>Imagen de iniconsistecia
                        </h6>
                        <button class="btn btn-info"><i class="fa-regular fa-square-plus icono"> Agregar imagen <input class="text-center imagen" name="img_inconsistencia" type="file" class="from_control" required></i></button>
                    </div><br>
                    <button class="btn btn-success" name="actualizar_inconcistecia">
                        Enviar inconcistencia
                    </button>
                </form><br>
            </div>
        </div>
    </div>
</div>