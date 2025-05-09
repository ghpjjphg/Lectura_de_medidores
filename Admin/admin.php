<?php include("../include/header.php") ?>
<?php include("../include/footer.php") ?>
<?php include("../db.php") ?>
<?php

if (isset($_SESSION['rol']) and $_SESSION['rol'] == 1) {
?>
    <?php include("narvar_admin.php") ?>
    <div class="row">
        &nbsp;
        &nbsp;
        &nbsp;
        <div class="col-md-2">
            <div class="container">
                <div class="card mt-4">
                    <h6 class="text-center">Servicios</h6>
                    <div class="card-header mt-4">
                        <div class="card-body mt-4">
                            <a href="informes.php"><button class="button btn btn-success m-3">Informe de lecturas</button></a><br>
                            <a href="admin_operarios.php"> <button type="submit" name="operarios" class="button btn btn-success m-3">Operarios</button></a><br>
                            <a href="lecturas.php"><button class="button btn btn-success m-3">Modificar lecturas</button></a><br>
                            <button class="button btn btn-success m-3">Limpiar base de datos</button><br>
                            <a href="usuarios.php"> <button class="button btn btn-success m-3"> Usuarios</button></a><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-3 text-left text-justify">
            <div class="text-left">
                <div class="card mt-4 text-center">
                    <div class="card-header mt-4 blanco largo">
                        <div class="card-body mt-4">
                            <img src="../logo/descarga.png" alt="" class="text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
} else {
    header("location:../index.php");
}
?>
