<?php include("../db.php") ?>
<?php include("../include/header.php") ?>
<?php
if (isset($_GET['guardar'])) {
    $documento = $_GET['documento'];
    $apellidos = $_GET['apellido'];
    $nombre_usu = $_GET['nombre'];
    $contrasena = $_GET['contrasena'];
    $rol = $_GET['rol'];
    $query = "SELECT documento FROM administrador WHERE documento = $documento";
    $resultado_u = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado_u) == 1) {
        $row = mysqli_fetch_array($resultado_u);
        $idusuario = $row['documento'];
    }
    if ($idusuario == $documento) {

        $_SESSION['message_repetido'] = 'Este operario ya existe. ' . $documento . ' esa es su identificaion';
        header('Location:admin_operarios.php');
    } else {
        $query = "INSERT INTO `administrador`(`documento`, `nombres`, `apellidos`, `contrasena`, `rol`) VALUES ('$documento','$nombre_usu','$apellidos','$contrasena','$rol')";
        $resultado = mysqli_query($conn, $query);
        $_SESSION['message_insert'] = 'Se resgistro correctamente el operario';
        header('Location:admin_operarios.php');
    }
}
if (isset($_GET['actualizar'])) {
    $documento = $_GET['documento'];
    $apellidos = $_GET['apellidos'];
    $nombre_usu = $_GET['nombres'];
    $contrasena = $_GET['contrasena'];
    $rol = $_GET['rol'];
    $query = "UPDATE `administrador` SET `documento`='$documento',`nombres`='$nombre_usu',`apellidos`='$apellidos',`contrasena`='$contrasena',`rol`='$rol' WHERE documento=$documento";
    $resultado = mysqli_query($conn, $query);
     $_SESSION['message_insert'] = 'Se actualizo correctamente el operario';
     header('Location:admin_operarios.php');
}

if (isset($_GET['documento_eliminar'])) {
    $documento = $_GET['documento_eliminar'];
    $query = "DELETE FROM administrador WHERE administrador.documento=$documento";
    $resultado = mysqli_query($conn, $query);
    $_SESSION['message_repetido'] = 'Se elimino el usuario identificado con el documneto ' . $documento;
    header('Location:admin_operarios.php');
}
