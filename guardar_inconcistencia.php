<?php
include("include/header.php");
include("include/footer.php");
include("db.php");
if (isset($_REQUEST['actualizar_inconcistecia'])) {
    $ruta = $_REQUEST['n_ruta'];
    $contador = $_REQUEST['contador'];
    $id_usuario = $_REQUEST['idusuario'];
    $ubicacion = $_REQUEST['ubicacion'];
    $n_usuario = $_REQUEST['usuario'];
    $descripcion_in = $_REQUEST['descripcion_inconsistencia'];
    $imagen = addslashes(file_get_contents($_FILES['img_inconsistencia']['tmp_name']));
    $query = "INSERT INTO inconsistencias (ruta,id_medidor,codigo_usuario,nombre_usuario,direccion,imagen,descripcion) VALUES ('$ruta','$contador','$id_usuario','$n_usuario','$ubicacion','$imagen', '$descripcion_in') ";
    $resultado = mysqli_query($conn, $query);
    if ($resultado) {
        header('location:consultar_inconcistencia.php');
    } else {
        echo mysqli_error($conn);
    }
}
