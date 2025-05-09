<?php include("../include/header.php") ?>
<?php include("../include/footer.php") ?>
<?php include("../db.php") ?>
<?php

if (isset($_SESSION['rol']) and $_SESSION['rol'] == 1) {

    include("narvar_admin.php") ?>

    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <H3>Usuario</H3>
                    <!-- Alerta para validar registro -->
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
                    <!-- Alerta para uasurio repetido -->
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
                    <!-- Alerta para medidor repetido -->
                    <?php if (isset($_SESSION['message_m_repetido'])) { ?>
                        <div class="alert alert-danger align-items-center text-center alert-dismissible" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>
                                <?= $_SESSION['message_m_repetido'] ?> <br>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>

                    <?php session_unset();
                    } ?>
                    <!-- Alerta para eliminar -->
                    <?php if (isset($_SESSION['message_eliminar'])) { ?>
                        <div class="alert alert-danger align-items-center text-center alert-dismissible" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>
                                <?= $_SESSION['message_eliminar'] ?> <br>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>

                    <?php session_unset();
                    } ?>
                    <?php if (isset($_SESSION['message_actualizar'])) { ?>
                        <div class="alert alert-success align-items-center text-center alert-dismissible" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>
                                <?= $_SESSION['message_actualizar'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>

                    <?php session_unset();
                    }
                    $_SESSION['rol'] = 1; ?>
                    <!-- Modal para reistro de usuario -->

                    <!-- Consultar usuario -->
                    <?php
                    if (isset($_GET['documento_actualizar'])) {
                        $documento = $_GET['documento_actualizar'];
                        $query = "SELECT * FROM administrador WHERE documento=$documento";
                        $consulta = mysqli_query($conn, $query);
                        if (mysqli_num_rows($consulta) == 1) {
                            $row = mysqli_fetch_array($consulta);
                            $documento = $row['documento'];
                            $nombre = $row['nombres'];
                            $apellido = $row['apellidos'];
                            $contrasena = $row['contrasena'];
                            $rol = $row['rol'];
                        }
                    ?>
                        <div class="card">
                            <h5>Información del usuario</h5>
                            <div class="card-body">
                                <form action="insert_eli_operario.php" method="GET">
                                    <div class="form_group">
                                        <h6>Identificación del operario
                                        </h6>
                                        <input class="text-center" type="number" name="documento" value="<?php echo $documento; ?>" class="from_control" readonly>
                                    </div>
                                    <div class="form_group">
                                        <h6>Nombre del operario
                                        </h6>
                                        <input class="text-center" type="text" name="nombres" value="<?php echo $nombre; ?>" class="from_control" required>
                                    </div>
                                    <div class="form_group">
                                        <h6>Apellidos del operario
                                        </h6>
                                        <input class="text-center" type="text" name="apellidos" value="<?php echo $apellido; ?>" class="from_control" required>
                                    </div>
                                    <div class="form_group">
                                        <h6>Contraseña
                                        </h6>
                                        <input class="text-center" type="text" name="contrasena" value="<?php echo $contrasena; ?>" class="from_control" required>
                                    </div>
                                    <div class="form_group">
                                        <h6>Rol
                                        </h6>
                                        <select name="rol" class="form_control text-center" required>
                                            <option value=""> Seleccione su rol</option>
                                            <option value="1"> Administrador</option>
                                            <option value="2"> Operario</option>
                                        </select>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary" type="submit" name="actualizar" value="actualizar">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                    include("../include/footer.php") ?>
                <?php
            } else {
                header("location:../index.php");
            }
                ?>
                </div>
            </div>
        </div>
    </div>