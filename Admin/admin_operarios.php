<?php include("../include/header.php") ?>
<?php include("../include/footer.php") ?>
<?php include("../db.php") ?>
<?php

if (isset($_SESSION['rol']) and $_SESSION['rol'] == 1) {
?>
    <?php include("narvar_admin.php") ?>
    <div class="row text-center">
        &nbsp;
        &nbsp;
        &nbsp;
        <div class="col-md-12">
            <div class="container">
                <table class="table table-bordered">

                    <thead>
                        <h5 class="text-center">Credenciales del progama</h5><br>
                        <?php if (isset($_SESSION['message_insert'])) { ?>
                            <div class="alert alert-success align-items-center text-center alert-dismissible" role="alert">
                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill" />
                                </svg>
                                <div>
                                    <?= $_SESSION['message_insert'] ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                        <?php session_unset();
                        } ?>
                        <?php if (isset($_SESSION['message_repetido'])) { ?>
                            <div class="alert alert-danger align-items-center text-center alert-dismissible" role="alert">
                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill" />
                                </svg>
                                <div>
                                    <?= $_SESSION['message_repetido'] ?> <br>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                        <?php session_unset();
                        } ?>
                        <button class="button btn btn-success m-3" id="modal_usu" data-bs-toggle="modal" data-bs-target="#modal1">Ingresar operarios</button><br>
                        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="GET" action="insert_eli_operario.php">
                                            <div class="mb-3">
                                                <label for="documento" class="col-form-label">Numero de documento</label>
                                                <input type="number" class="form-control text-center" name="documento" required placeholder="Ingresar numero de documento">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nombre" class="col-form-label">Nombres del operario</label>
                                                <input type="text" class="form-control text-center" name="nombre" required placeholder="Ingrese el nombre del operario">
                                            </div>
                                            <div class="mb-3">
                                                <label for="apellido" class="col-form-label">Apellidos del operario</label>
                                                <input type="text" class="form-control text-center" name="apellido" required placeholder="Ingrese los apellidos del operario ">
                                            </div>
                                            <div class="mb-3">
                                                <label for="contrasena" class="col-form-label">Contraseña</label>
                                                <input type="password" name="contrasena" id="passwoer" class="form-control text-center" id="contrasena" required>
                                            </div>
                                            <div class="mb-3 ">
                                                <select name="rol" class="form-select text-center" required>
                                                    <option value=""> Seleccione su rol</option>
                                                    <option value="1"> Administrador</option>
                                                    <option value="2"> Operario</option>
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" name="guardar" id="guardar" class="btn btn-primary">Registrar usuario</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <tr class="text-center">
                            <th>Documento</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>contraseña</th>
                            <th>Rol</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `administrador`";
                        $consulta = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($consulta)) {
                            $rol = $row['rol'];
                            if ($rol == 1) {
                                $rol = 'Administrador';
                            } else {
                                $rol = 'Operario';
                            } ?>
                            <br>
                            <tr class="text-center">
                                <td> <?php echo $row['documento'] ?></td>
                                <td><?php echo $row['nombres'] ?></td>
                                <td><?php echo $row['apellidos'] ?></td>
                                <td><?php echo $row['contrasena'] ?></td>
                                <td><?php echo $rol ?></td>
                                <td> <a href="form_actualizar_operario.php?documento_actualizar=<?php echo $row["documento"] ?> " class="btn btn-secondary ">
                                        <i class="fa-solid fa-pen"></i> </a>
                                    <a href="insert_eli_operario.php?documento_eliminar=<?php echo $row['documento'] ?> "  class="btn btn-danger"><i class="fa-solid fa-trash-can" onclick=" return confirmacion()"></i></a>
                                </td>
                            </tr>
            </div>
        </div>
        <script>
            function confirmacion() {
              var confirmaction = confirm("¿Desea eliminar el operario <?php echo $row['nombres'] ?> con identificacion <?php $row['documento']; ?> ?")

              if (confirmaction == true) {
                return true
              } else {
                return false
              }
            }
          </script>
    <?php }
                        $_SESSION['rol'] = 1; ?>
    </tbody>

    </table>

    </div>
    
    </div>
    </div>


<?php
} else {
    header("location:../index.php");
}
?>