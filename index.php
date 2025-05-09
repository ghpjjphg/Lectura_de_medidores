<?php
include("include/header.php");
include("db.php");
?>
<div class="container">
    <form>
        <div class="container">
            <div class="fw-bold  text-center m-2 p-2">
                <h2 class="inicio fw-bold">Inicio de sesión</h2>
            </div>
            <div class="mb-3">
                <label for="documento" class="form-label ">Número de documento</label>
                <input type="text" name="documento" class="form-control" id="documento" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label ">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" id="contrasena" required>
            </div>
            <!-- <div class="mb-3">
            <select name="rol" class="form-select" required>
            <option value=""> Seleccione su rol</option>
                <option value="1"> Administrador</option>
                <option value="2"> Operario</option>
            </select>
        </div> -->
            <div class="d-grid">
                <button type="submit" name="iniciar" class="btn btn-outline-primary">Iniciar Sesión</button> <br> <br>
            </div>
        </div>
    </form>

    <?php
    if (isset($_REQUEST['iniciar'])) {
        $documento = $_REQUEST['documento'];
        $contrasena = $_REQUEST['contrasena'];

        if ($documento) {
            $query = "SELECT * FROM `administrador` WHERE administrador.documento='$documento' AND administrador.contrasena ='$contrasena'";

            $consulta = mysqli_query($conn, $query);
            if (mysqli_num_rows($consulta) == 1) {
                $row = mysqli_fetch_array($consulta);
                $rol = $row['rol'];
                $_SESSION['rol'] = $rol;
                if ($rol == 1) {
                    if ($consulta) {
                        if (mysqli_num_rows($consulta) > 0) {
                            $row = mysqli_fetch_row($consulta);
                            echo "<br> El usuario si existe";
                            $_SESSION['documento'] = $documento;
                            $_SESSION['nombres'] = $row[1] . " " . $row[2];
                            $_SESSION['contrasena'] = $contrasena;
                            header("location:Admin/admin.php");
                        } 
                    }
                } else {
                    if ($consulta) {
                        if (mysqli_num_rows($consulta) > 0) {
                            $row = mysqli_fetch_row($consulta);
                            echo "<br> El usuario si existe";
                            $_SESSION['documento'] = $documento;
                            $_SESSION['nombres'] = $row[1] . " " . $row[2];
                            $_SESSION['contrasena'] = $contrasena;
                            header("location:buscar_ruta.php");
                        } 
                    }
                }
            } else {
                ?>
                <div class="alert alert-info align-items-center text-center alert-dismissible" role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:">
                        <use xlink:href="#info-fill" />
                    </svg>
                    <div>
                        <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div>
                            Verifica tus credenciales
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>
</div>
<?php include("include/footer.php") ?>