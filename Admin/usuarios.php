<?php include("../include/header.php") ?>
<?php include("../db.php") ?>
<?php

if (isset($_SESSION['rol']) and $_SESSION['rol'] == 1) {
?>
    <?php include("narvar_admin.php") ?>

<div class="container ">
  <div class="row">
    <div class="col-md-12">
      <div class="text-center">
        <H3>Usuarios</H3>
        <button class="button btn btn-success m-3 " id="modal_usu" data-bs-toggle="modal" data-bs-target="#modal1">Ingresar usuarios</button><br>
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
        } $_SESSION['rol'] = 1 ; ?>
        <form method="GET" action="usuarios.php">
          <fieldset>
            <legend>Busqueda de usuarios</legend>
            <label for="documento" class="text-center">Numero de identificación</label> <br>
            <input type="number" name="documento" required placeholder="Inreser N de documento"> <br> <br>
            <input class="button btn btn-success" type="submit" value="buscar" name="buscar"> <br>
          </fieldset>
        </form> <br>
        <!-- Modal para reistro de usuario -->
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="GET" action="insertar_usuario.php">
                  <div class="mb-3">
                    <label for="documento" class="col-form-label">Numero de documento</label>
                    <input type="number" class="form-control text-center" name="documento" required placeholder="Ingresar numero de documento">
                  </div>
                  <div class="mb-3">
                    <label for="id_servicio" class="col-form-label">Numero de identificcio de servico</label>
                    <input type="number" class="form-control text-center" name="id_servico" required placeholder="Ingresar numero de documento">
                  </div>
                  <div class="mb-3">
                    <label for="nombre" class="col-form-label">Nombre del usuario</label>
                    <input type="text" class="form-control text-center" name="nombre" required placeholder="Ingrese el nombre de usuario">
                  </div>
                  <div class="mb-3">
                    <label for="direccion" class="col-form-label">Dirección</label>
                    <input type="text" class="form-control text-center" name="direccion" required placeholder="Ingrese a direccion del usuario ">
                  </div>
                  <div class="mb-3">
                    <label for="ruta" class="col-form-label">Ruta</label>
                    <input type="number" class="form-control text-center" name="ruta" required placeholder="Ingreser numero de ruta">
                  </div>
                  <div class="mb-3">
                    <label for="medidor" class="col-form-label">Medidor</label>
                    <input type="text" class="form-control text-center" name="medidor" required placeholder="Ingreser numero de medidor">
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
        <!-- Consultar usuario -->
        <?php
        if (isset($_GET['buscar'])) {
          $documento = $_GET['documento'];
          $query = "SELECT `id_usuario`, `id_servicio`, `nombre_usuario`, `direccion` FROM `usuarios` WHERE id_usuario='$documento'";
          $consulta = mysqli_query($conn, $query);
          $cantidad = $consulta->num_rows;
          if (mysqli_num_rows($consulta) == 1) {
            $row = mysqli_fetch_array($consulta);
            // $contador = $row['id_contador'];
            $direccion = $row['direccion'];
            $idUsuario = $row['id_usuario'];
            // $id_servico = $row['id_servicio'];
            $usuario = $row['nombre_usuario'];
            // $ruta = $row['id_ruta'];
          }
          if ($cantidad > 0) {
        ?>
            <div class="card">
              <h5>Información del usuario</h5>
              <div class="card-body">
                <form action="eliminar_actualizar_usuario.php" method="GET">
                  <div class="form_group">
                    <h6>Identificación del usuario
                    </h6>
                    <input class="text-center" type="number" name="identificacion" value="<?php echo $idUsuario; ?>" class="from_control" readonly>
                  </div>
                  <!-- <div class="form_group">
                    <h6>Identificación del servicio
                    </h6>
                    <input class="text-center" type="number" name="id_servicio" value="<?php echo $id_servico; ?>" class="from_control" >
                  </div> -->
                  <div class="form_group">
                    <h6>Nombre del ususario
                    </h6>
                    <input class="text-center" type="text" name="nombre_usuario" value="<?php echo $usuario; ?>" class="from_control" >
                  </div>
                  <div class="form_group">
                    <h6>Dirección
                    </h6>
                    <input class="text-center" type="text" name="direccion" value="<?php echo $direccion; ?>" class="from_control" >
                  </div>
                  <!-- <div class="form_group">
                    <h6>Ruta de ubicación
                    </h6>
                    <input class="text-center" type="text" name="ruta" value="<?php echo $ruta; ?>" class="from_control" readonly>
                  </div>
                  <div class="form_group">
                    <h6>Numero de medidor
                    </h6> -->
                    <!-- <input class="text-center" type="text" name="medidor" value="<?php echo $contador; ?>" class="from_control" >
                  </div> <br> -->
                  <br>
                  <button class="btn btn-danger" type="submit" name="borrar" value="borrar" onclick=" return confirmacion()">Borrar</button>
                  <button class="btn btn-primary" type="submit" name="actualizar" value="actualizar">Actualizar</button>
                </form>
              </div>
            </div>
          <?php } else {

          ?>
<!-- Alertar para usuario no existente -->
            <div class="alert alert-info align-items-center text-center alert-dismissible" role="alert">
              <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
              </svg>
              <div>
                <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                  Este usuario no existe
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
              
          <?php
          }
        }


          ?>
          <!-- Alerta del local para eliminar usuario -->
          <script>
            function confirmacion() {
              var confirmaction = confirm("¿Desea eliminar el usuario <?php echo $usuario ?> con identificacion <?php echo $idUsuario; ?> ?")

              if (confirmaction == true) {
                return true
              } else {
                return false
              }
            }
          </script>
            </div>
      </div>
    </div>
  </div>

  <?php include("../include/footer.php") ?>
  <?php
} else {
    header("location:../index.php");
}
    ?>