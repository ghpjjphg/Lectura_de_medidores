<?php include("../include/header.php") ?>
<?php include("../db.php") ?>
<?php
if (isset($_GET['guardar'])) {
    $documento = $_GET['documento'];
    $id_servico = $_GET['id_servico'];
    $nombre_usu = $_GET['nombre'];
    $dirrcion = $_GET['direccion'];
    $ruta = $_GET['ruta'];
    $medidor = $_GET['medidor'];
    // consulta para comparar usuario
    $query = "SELECT id_usuario FROM contador WHERE id_usuario = $documento";
    $resultado_u = mysqli_query($conn, $query);
    $cantidad_usuario = $resultado_u->num_rows;
    echo $cantidad_usuario;
    if (mysqli_num_rows($resultado_u) == 1) {
        $row = mysqli_fetch_array($resultado_u);
        $idusuario = $row['id_usuario'];
    }
    // if ($idusuario==$documento) {

    //     $_SESSION['message_repetido'] = 'Este usario ya existe. '. $documento.' esa es su identificaion';
    //     header('Location:usuarios.php');
    // }
    // consulta para comparar medidor
    $queryMedior = "SELECT contador.id_contador FROM contador WHERE contador.id_contador= '$medidor' ";
    $resultado_m = mysqli_query($conn, $queryMedior);
    if (mysqli_num_rows($resultado_m) == 1) {
        $row = mysqli_fetch_array($resultado_m);
        $idmedidor = $row['id_contador'];
        if ($idmedidor == $medidor) {
            $_SESSION['message_m_repetido'] = 'Este medidor ya existe. ' . $medidor . ' esa es su identificaion';
            header('Location:usuarios.php');
        }
    } elseif ($documento) {
        if ($cantidad_usuario == 0) {
            $query = "INSERT INTO usuarios(id_usuario, nombre_usuario, direccion, id_servicio) VALUES ('$documento','$nombre_usu','$dirrcion','$id_servico')";
            $resultado = mysqli_query($conn, $query);
            if (!$resultado) {
                die("Error en la consulta de usuario");
                echo '<script>alert("No se porque no da")</script>';
                header('Location:usuarios.php');
            }$query = "INSERT INTO contador(id_contador, id_usuario) VALUES ('$medidor','$documento')";
            $resultado = mysqli_query($conn, $query);
            if ($documento) {
                $query = "INSERT INTO `fechas_lecturas` (`id_contador`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES ('$medidor', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');";
                $resultado = mysqli_query($conn, $query);
            }
            if ($documento) {
                $query = "INSERT INTO `consumo` (`id_contador`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES ('$medidor', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');";
                $resultado = mysqli_query($conn, $query);
            }
            if (!$resultado) {
                die("Error en la consulta de ruta");
            }
            if ($ruta) {
                $query = "INSERT INTO `ruta` (`id_ruta`, `id_contador`) VALUES ('$ruta', '$medidor');";
                $resultado = mysqli_query($conn, $query);
                if (!$resultado) {
                    die("Error en la consulta medidor");
                }
                $_SESSION['message_insert'] = 'Se resgistro correctamente el usuario';
                header('Location:usuarios.php');
            }
        } else {
            $query = "INSERT INTO contador(id_contador, id_usuario) VALUES ('$medidor','$documento')";
            $resultado = mysqli_query($conn, $query);
            if ($documento) {
                $query = "INSERT INTO `fechas_lecturas` (`id_contador`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES ('$medidor', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');";
                $resultado = mysqli_query($conn, $query);
            }
            if ($documento) {
                $query = "INSERT INTO `consumo` (`id_contador`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES ('$medidor', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');";
                $resultado = mysqli_query($conn, $query);
            }
            if (!$resultado) {
                die("Error en la consulta de ruta");
            }
            if ($ruta) {
                $query = "INSERT INTO `ruta` (`id_ruta`, `id_contador`) VALUES ('$ruta', '$medidor');";
                $resultado = mysqli_query($conn, $query);
                if (!$resultado) {
                    die("Error en la consulta medidor");
                }
                $_SESSION['message_insert'] = 'Se resgistro correctamente el usuario';
                header('Location:usuarios.php');
            }
        }
    }
}
?>
<?php include("../include/footer.php") ?>
