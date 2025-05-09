<?php include("../db.php") ?>
<?php include("../include/header.php") ?>
<?php
if (isset($_GET['actualizar'])) {
       $lectura_f = $_GET['lectura_f'];
       $medidor = $_GET['medidor'];
       $consumo = $_GET['consumo'];
       $query = "UPDATE contador set contador.lectura_final='$consumo', contador.lectura_anterior='$lectura_f' WHERE contador.id_contador='$medidor'";
       $resultado = mysqli_query($conn, $query);
       $_SESSION['message_actualizar'] = 'Se actualizo alguna lectura del medidor ' . $medidor;
       header('Location:lecturas.php?medidor=' . $medidor . '&buscar=buscar');
}
if (isset($_GET['actualizar_lecturas'])) {
       $medidor = $_GET['medidor'];
       $enero = $_GET['enero'];
       $febrero = $_GET['febrero'];
       $marzo = $_GET['marzo'];
       $abril = $_GET['abril'];
       $mayo = $_GET['mayo'];
       $junio = $_GET['junio'];
       $julio = $_GET['julio'];
       $agosto = $_GET['agosto'];
       $septiembre = $_GET['septiembre'];
       $octubre = $_GET['octubre'];
       $noviembre = $_GET['noviembre'];
       $diciembre = $_GET['diciembre'];
       $querylfechas = "UPDATE fechas_lecturas set fechas_lecturas.enero='$enero', fechas_lecturas.febrero='$febrero', fechas_lecturas.marzo='$marzo', fechas_lecturas.abril='$abril', fechas_lecturas.mayo='$mayo', fechas_lecturas.junio='$junio', fechas_lecturas.julio='$julio', fechas_lecturas.agosto='$agosto', fechas_lecturas.septiembre='$septiembre', fechas_lecturas.octubre='$octubre', fechas_lecturas.noviembre='$noviembre', fechas_lecturas.diciembre='$diciembre' WHERE fechas_lecturas.id_contador='$medidor'";
       $resultado = mysqli_query($conn, $querylfechas);
       $_SESSION['message_actualizar'] = 'Se actualizo alguna lectura del medidor ' . $medidor;
        header('Location:lecturas.php?medidor=' . $medidor . '&buscar=buscar');
}
if (isset($_GET['actualizar_consumo'])) {
       $medidor = $_GET['medidor'];
       $enero = $_GET['enero'];
       $febrero = $_GET['febrero'];
       $marzo = $_GET['marzo'];
       $abril = $_GET['abril'];
       $mayo = $_GET['mayo'];
       $junio = $_GET['junio'];
       $julio = $_GET['julio'];
       $agosto = $_GET['agosto'];
       $septiembre = $_GET['septiembre'];
       $octubre = $_GET['octubre'];
       $noviembre = $_GET['noviembre'];
       $diciembre = $_GET['diciembre'];
       $querylfechas = "UPDATE `consumo` SET `enero`='$enero',`febrero`='$febrero',`marzo`='$marzo',`abril`='$abril',`mayo`='$mayo',`junio`='$junio',`julio`='$julio',`agosto`='$agosto',`septiembre`='$septiembre',`octubre`='$octubre',`noviembre`='$noviembre',`diciembre`='$diciembre' WHERE  consumo.id_contador='$medidor'";
       $resultado = mysqli_query($conn, $querylfechas);
       $_SESSION['message_actualizar'] = 'Se actualizo algun consumo del medidor ' . $medidor;
        header('Location:lecturas.php?medidor=' . $medidor . '&buscar=buscar');
}
?>
<?php include("../include/footer.php") ?>