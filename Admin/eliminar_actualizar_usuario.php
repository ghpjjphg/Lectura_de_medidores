<?php include("../db.php") ?>
<?php include("../include/header.php") ?>
<?php
if (isset($_GET['borrar'])) {

    $documento_e = $_GET['identificacion'];
    $medidor = $_GET['medidor'];
    $query = "DELETE FROM contador WHERE id_contador = '$medidor'";
    $resultado = mysqli_query($conn,$query);
    $queyeliminaru = "DELETE FROM usuarios WHERE usuarios.id_usuario = $documento_e";
    $resultado_u = mysqli_query($conn,$queyeliminaru);
 
    $_SESSION['message_eliminar'] = 'Se elimino el usuario '.$documento_e.' correctamente';
    header('Location:usuarios.php');
}
if (isset($_GET['actualizar'])) {
    $documento_a = $_GET['identificacion'];
    // $id_servicio = $_GET['id_servicio'];    
    $usuario = $_GET['nombre_usuario'];
    $direccion =$_GET['direccion'];
    // $ruta = $_GET['ruta'];
    // $medidor_a = $_GET['medidor'];
    // $queryMedior = "SELECT contador.id_contador FROM contador WHERE contador.id_contador= '$medidor_a'";
    // $resultado_m = mysqli_query($conn,$queryMedior);
    // if (mysqli_num_rows($resultado_m) == 1) {
    //     $row = mysqli_fetch_array($resultado_m);
    //     $idmedidor = $row['id_contador'];
    // }
    // // if ($idmedidor==$medidor_a) {
    // //     $_SESSION['message_m_repetido'] = 'Este medidor ya existe. '. $medidor_a.' esa es su identificaion';
    // //     header('Location:usuarios.php');
    // // }
    if ($documento_a) {
        $query = "UPDATE usuarios set id_usuario='$documento_a', nombre_usuario='$usuario', direccion='$direccion' WHERE id_usuario='$documento_a' ";
        $resultado = mysqli_query($conn,$query);
        // $queryContador = "UPDATE contador SET contador.id_contador='$medidor_a' WHERE  contador.id_usuario='$documento_a'";
        // $resultado_medidor=mysqli_query($conn,$queryContador);

        $_SESSION['message_actualizar'] = 'Se actualizo el usuario correctamente';
        header('Location:usuarios.php?documento='.$documento_a.'&buscar=buscar');
    }
   
}
?>
<?php include("../include/footer.php") ?>