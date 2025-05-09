<?php include("../include/header.php") ?>
<?php include("../db.php") ?>
<?php
if (isset($_GET['informe'])) {
    $_SESSION['rol'] = 1 ;
    $nombre = $_GET['nombre_ar'];
    $query = "SELECT contador.id_contador, contador.lectura_final, contador.fecha_lectura, contador.lectura_anterior, usuarios.id_usuario, usuarios.nombre_usuario, usuarios.direccion, usuarios.id_servicio, ruta.id_ruta FROM contador INNER JOIN usuarios ON usuarios.id_usuario=contador.id_usuario INNER JOIN ruta ON ruta.id_contador=contador.id_contador";
    $resultado = mysqli_query($conn, $query);
    $archivo = fopen("C:\Users\MASTER DEV\Documents\ $nombre.txt", "a") or die("error al crear");
    while ($row = mysqli_fetch_array($resultado)) {
        $contador = $row['id_contador'];
        $direccion = $row['direccion'];
        $idUsuario = $row['id_usuario'];
        $id_servicio = $row['id_servicio'];
        $usuario = $row['nombre_usuario'];
        $consumo = $row['lectura_final'];
        $lectura_anterior = $row['lectura_anterior'];
        $fecha_lectura = $row['fecha_lectura'];
        $ruta = $row['id_ruta'];
        fwrite($archivo, $contador . PHP_EOL);
        fwrite($archivo, $direccion . PHP_EOL);
        fwrite($archivo, $idUsuario . PHP_EOL);
        fwrite($archivo, $id_servicio . PHP_EOL);
        fwrite($archivo, $usuario . PHP_EOL);
        fwrite($archivo, $lectura_anterior . PHP_EOL);
        fwrite($archivo, $consumo . PHP_EOL);
        fwrite($archivo, $fecha_lectura . PHP_EOL);
        fwrite($archivo, $ruta);
        fwrite($archivo, "," . PHP_EOL);
        fwrite($archivo, PHP_EOL);
        $_SESSION['message_informe'] = 'Se genero el archivo correctamente, esta ubicado en documentos con el nombre ' . $nombre;
        header('Location:informes.php');
    }
}
// informe por ruta
if (isset($_GET['informe_ruta'])) {
    $_SESSION['rol'] = 1 ;
    $nombre = $_GET['nombre_ar'];
    $ruta = $_GET['ruta'];
    $query = "SELECT contador.id_contador, contador.lectura_final, contador.fecha_lectura, contador.lectura_anterior, usuarios.id_usuario,  usuarios.nombre_usuario, usuarios.direccion, usuarios.id_servicio, ruta.id_ruta FROM contador INNER JOIN usuarios ON usuarios.id_usuario=contador.id_usuario INNER JOIN ruta ON ruta.id_contador=contador.id_contador WHERE ruta.id_ruta=$ruta";
    $resultado = mysqli_query($conn, $query);
    $cantidad = $resultado->num_rows;
    if ($cantidad > 0) {
        $archivo = fopen("C:\Users\MASTER DEV\Documents\ $nombre.txt", "a") or die("error al crear");
        while ($row = mysqli_fetch_array($resultado)) {
            $contador = $row['id_contador'];
            $direccion = $row['direccion'];
            $idUsuario = $row['id_usuario'];
            $id_servicio = $row['id_servicio'];
            $usuario = $row['nombre_usuario'];
            $lectura_anterior = $row['lectura_anterior'];
            $consumo = $row['lectura_final'];
            $fecha_lectura = $row['fecha_lectura'];
            $ruta = $row['id_ruta'];
            fwrite($archivo, $contador . PHP_EOL);
            fwrite($archivo, $direccion . PHP_EOL);
            fwrite($archivo, $idUsuario . PHP_EOL);
            fwrite($archivo, $id_servicio . PHP_EOL);
            fwrite($archivo, $usuario . PHP_EOL);
            fwrite($archivo, $lectura_anterior . PHP_EOL);
            fwrite($archivo, $consumo . PHP_EOL);
            fwrite($archivo, $fecha_lectura . PHP_EOL);
            fwrite($archivo, $ruta);
            fwrite($archivo, "," . PHP_EOL);
            fwrite($archivo, PHP_EOL);
            $_SESSION['message_informe'] = 'Se genero el archivo correctamente, esta ubicado en documentos con el nombre ' . $nombre;
            header('Location:informes.php');
        }
    } else {
        $_SESSION['message_ruta_n'] = 'Esta ruta no existe ' . $ruta;
        header('Location:informes.php');
    }
}
// informe por usuario
if (isset($_GET['informe_usuario'])) {
    $_SESSION['rol'] = 1 ;
    $nombre = $_GET['nombre_ar'];
    $documento = $_GET['documento'];
    $query = "SELECT contador.id_contador, contador.lectura_final, contador.fecha_lectura, contador.lectura_anterior, usuarios.id_usuario, usuarios.nombre_usuario, usuarios.direccion, usuarios.id_servicio, ruta.id_ruta FROM contador INNER JOIN usuarios ON usuarios.id_usuario=contador.id_usuario INNER JOIN ruta ON ruta.id_contador=contador.id_contador WHERE usuarios.id_usuario=$documento";
    $resultado = mysqli_query($conn, $query);
    $cantidad = $resultado->num_rows;
    if ($cantidad > 0) {
        $archivo = fopen("C:\Users\MASTER DEV\Documents\ $nombre.txt", "a") or die("error al crear");
        while ($row = mysqli_fetch_array($resultado)) {
            $contador = $row['id_contador'];
            $direccion = $row['direccion'];
            $idUsuario = $row['id_usuario'];
            $id_servicio = $row['id_servicio'];
            $usuario = $row['nombre_usuario'];
            $lectura_anterior = $row['lectura_anterior'];
            $consumo = $row['lectura_final'];
            $fecha_lectura = $row['fecha_lectura'];
            $ruta = $row['id_ruta'];
            fwrite($archivo, $contador . PHP_EOL);
            fwrite($archivo, $direccion . PHP_EOL);
            fwrite($archivo, $idUsuario . PHP_EOL);
            fwrite($archivo, $id_servicio . PHP_EOL);
            fwrite($archivo, $usuario . PHP_EOL);
            fwrite($archivo, $lectura_anterior . PHP_EOL);
            fwrite($archivo, $consumo . PHP_EOL);
            fwrite($archivo, $fecha_lectura. PHP_EOL);
            fwrite($archivo, $ruta);
            $_SESSION['message_informe'] = 'Se genero el archivo correctamente, esta ubicado en documentos con el nombre ' . $nombre;
            header('Location:informes.php');
        }
    } else {
        $_SESSION['message_ruta_n'] = 'Este usuario no existe ' . $documento;
        header('Location:informes.php');
    }
}
if (isset($_GET['informe_usuario_anual'])) {
    $_SESSION['rol'] = 1 ;
    $nombre = $_GET['nombre_ar'];
    $documento = $_GET['documento'];
    $query = "SELECT fechas_lecturas.enero, fechas_lecturas.febrero, fechas_lecturas.marzo, fechas_lecturas.abril, fechas_lecturas.mayo, fechas_lecturas.junio, fechas_lecturas.julio, fechas_lecturas.agosto, fechas_lecturas.septiembre, fechas_lecturas.octubre, fechas_lecturas.noviembre, fechas_lecturas.diciembre, contador.id_contador, contador.lectura_final, contador.fecha_lectura, contador.lectura_anterior, usuarios.id_usuario, usuarios.nombre_usuario, usuarios.direccion, usuarios.id_servicio, ruta.id_ruta FROM contador 
    INNER JOIN usuarios ON contador.id_usuario=usuarios.id_usuario 
    INNER JOIN fechas_lecturas ON contador.id_contador= fechas_lecturas.id_contador 
    INNER JOIN ruta ON contador.id_contador = ruta.id_contador 
    WHERE usuarios.id_usuario = $documento";
    $resultado = mysqli_query($conn, $query);
    $cantidad = $resultado->num_rows;
    if ($cantidad > 0) {
        $archivo = fopen("C:\Users\MASTER DEV\Documents\ $nombre.txt", "a") or die("error al crear");
        while ($row = mysqli_fetch_array($resultado)) {
            $contador = $row['id_contador'];
            $direccion = $row['direccion'];
            $idUsuario = $row['id_usuario'];
            $id_servicio = $row['id_servicio'];
            $usuario = $row['nombre_usuario'];
            $lectura_anterior = $row['lectura_anterior'];
            $consumo = $row['lectura_final'];
            $fecha_lectura = $row['fecha_lectura'];
            $ruta = $row['id_ruta'];
            $enero = $row['enero'];
            $febrero = $row['febrero'];
            $marzo = $row['marzo'];
            $abril = $row['abril'];
            $mayo = $row['mayo'];
            $junio = $row['junio'];
            $julio = $row['julio'];
            $agosto = $row['agosto'];
            $septiembre = $row['septiembre'];
            $octubre = $row['octubre'];
            $noviembre = $row['noviembre'];
            $diciembre = $row['diciembre'];
            fwrite($archivo, $contador . PHP_EOL);
            fwrite($archivo, $direccion . PHP_EOL);
            fwrite($archivo, $idUsuario . PHP_EOL);
            fwrite($archivo, $id_servicio . PHP_EOL);
            fwrite($archivo, $usuario . PHP_EOL);
            fwrite($archivo, $lectura_anterior . PHP_EOL);
            fwrite($archivo, $consumo . PHP_EOL);
            fwrite($archivo, $fecha_lectura.PHP_EOL);
            fwrite($archivo, $ruta.PHP_EOL);
            fwrite($archivo, $enero.PHP_EOL);
            fwrite($archivo, $febrero.PHP_EOL);
            fwrite($archivo, $marzo.PHP_EOL);
            fwrite($archivo, $abril.PHP_EOL);
            fwrite($archivo, $mayo.PHP_EOL);
            fwrite($archivo, $junio.PHP_EOL);
            fwrite($archivo, $julio.PHP_EOL);
            fwrite($archivo, $agosto.PHP_EOL);
            fwrite($archivo, $septiembre.PHP_EOL);
            fwrite($archivo, $octubre.PHP_EOL);
            fwrite($archivo, $noviembre.PHP_EOL);
            fwrite($archivo, $diciembre);
            

            $_SESSION['message_informe'] = 'Se genero el archivo correctamente, esta ubicado en documentos con el nombre ' . $nombre;
            header('Location:informes.php');
        }
    } else {
        $_SESSION['message_ruta_n'] = 'Este usuario no existe ' . $documento;
        header('Location:informes.php');
    }
}
if (isset($_GET['informe_usuario_anual_consumo'])) {
    $_SESSION['rol'] = 1 ;
    $nombre = $_GET['nombre_ar'];
    $documento = $_GET['documento'];
    $query = "SELECT  consumo.enero, consumo.febrero, consumo.marzo, consumo.abril, consumo.mayo, consumo.junio, consumo.julio, consumo.agosto, consumo.septiembre, consumo.octubre, consumo.noviembre, consumo.diciembre, contador.id_contador, contador.lectura_final, contador.fecha_lectura, contador.lectura_anterior, usuarios.id_usuario, usuarios.nombre_usuario, usuarios.direccion, usuarios.id_servicio, ruta.id_ruta FROM contador 
    INNER JOIN usuarios ON usuarios.id_usuario=contador.id_usuario 
    INNER JOIN consumo ON contador.id_contador= consumo.id_contador 
    INNER JOIN ruta ON ruta.id_contador=contador.id_contador WHERE usuarios.id_usuario=$documento";
    $resultado = mysqli_query($conn, $query);
    $cantidad = $resultado->num_rows;
    if ($cantidad > 0) {
        $archivo = fopen("C:\Users\MASTER DEV\Documents\ $nombre.txt", "a") or die("error al crear");
        while ($row = mysqli_fetch_array($resultado)) {
            $contador = $row['id_contador'];
            $direccion = $row['direccion'];
            $idUsuario = $row['id_usuario'];
            $id_servicio = $row['id_servicio'];
            $usuario = $row['nombre_usuario'];
            $lectura_anterior = $row['lectura_anterior'];
            $consumo = $row['lectura_final'];
            $fecha_lectura = $row['fecha_lectura'];
            $ruta = $row['id_ruta'];
            $enero = $row['enero'];
            $febrero = $row['febrero'];
            $marzo = $row['marzo'];
            $abril = $row['abril'];
            $mayo = $row['mayo'];
            $junio = $row['junio'];
            $julio = $row['julio'];
            $agosto = $row['agosto'];
            $septiembre = $row['septiembre'];
            $octubre = $row['octubre'];
            $noviembre = $row['noviembre'];
            $diciembre = $row['diciembre'];
            fwrite($archivo, $contador . PHP_EOL);
            fwrite($archivo, $direccion . PHP_EOL);
            fwrite($archivo, $idUsuario . PHP_EOL);
            fwrite($archivo, $id_servicio . PHP_EOL);
            fwrite($archivo, $usuario . PHP_EOL);
            fwrite($archivo, $lectura_anterior . PHP_EOL);
            fwrite($archivo, $consumo . PHP_EOL);
            fwrite($archivo, $fecha_lectura. PHP_EOL);
            fwrite($archivo, $ruta. PHP_EOL);
            fwrite($archivo, $enero.PHP_EOL);
            fwrite($archivo, $febrero.PHP_EOL);
            fwrite($archivo, $marzo.PHP_EOL);
            fwrite($archivo, $abril.PHP_EOL);
            fwrite($archivo, $mayo.PHP_EOL);
            fwrite($archivo, $junio.PHP_EOL);
            fwrite($archivo, $julio.PHP_EOL);
            fwrite($archivo, $agosto.PHP_EOL);
            fwrite($archivo, $septiembre.PHP_EOL);
            fwrite($archivo, $octubre.PHP_EOL);
            fwrite($archivo, $noviembre.PHP_EOL);
            fwrite($archivo, $diciembre);
            $_SESSION['message_informe'] = 'Se genero el archivo correctamente, esta ubicado en documentos con el nombre ' . $nombre;
            header('Location:informes.php');
        }
    } else {
        $_SESSION['rol'] = 1 ;
        $_SESSION['message_ruta_n'] = 'Este usuario no existe ' . $documento;
        header('Location:informes.php');
    }
}
?>
<?php include("../include/footer.php") ?>
