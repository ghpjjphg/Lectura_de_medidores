<?php include("../include/header.php") ?>
<?php include("../db.php") ?>
<?php

if (isset($_SESSION['rol']) and $_SESSION['rol'] == 1 ) {
?>
<?php include("narvar_admin.php") ?>
<div class="container ">
  <div class="row">
    <div class="col-md-12">
      <div class="text-center">
        <!-- Alerta de informe de entero -->
        <?php if (isset($_SESSION['message_informe'])) { ?>
          <div class="alert alert-success align-items-center text-center alert-dismissible" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
              <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
              <?= $_SESSION['message_informe'] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>

        <?php session_unset();
        } ?>
        <?php if (isset($_SESSION['message_ruta_n'])) { ?>
          <div class="alert alert-info align-items-center text-center alert-dismissible" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:">
              <use xlink:href="#info-fill" />
            </svg>
            <div>
              <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>
                <?= $_SESSION['message_ruta_n'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          </div>
        <?php session_unset();
        } 
        $_SESSION['rol'] = 1 ;?>
        <h5>Informe compelto de lecturas</h5>
        <button class="button btn btn-success m-3 " id="modal_usu" data-bs-toggle="modal" data-bs-target="#modal1">Descargar informe completo</button><br>
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nombre del archico</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="GET" action="generar_informe.php">
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">Nombre del archico</label>
                    <input type="text" class="form-control text-center" name="nombre_ar" required placeholder="Ingrese el nombre del archivo">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="informe" id="informe" class="btn btn-primary">Descargar informe</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <h5>Informe de lecturas por ruta</h5>
        <button class="button btn btn-success m-3 " id="modal_ruta" data-bs-toggle="modal" data-bs-target="#modal12">Descargar informe por ruta</button><br>
        <div class="modal fade" id="modal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Informe por ruta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="GET" action="generar_informe.php">
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">Nombre del archivo</label>
                    <input type="text" class="form-control text-center" name="nombre_ar" required placeholder="Ingrese el nombre del archivo">
                  </div>
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">Ruta</label>
                    <input type="number" class="form-control text-center" name="ruta" required placeholder="Ingrese el numero de ruta">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="informe_ruta" id="informe_ruta" class="btn btn-primary">Descargar informe</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <h5>Informe de lecturas por usuario</h5>
        <button class="button btn btn-success m-3 " id="modal_ruta" data-bs-toggle="modal" data-bs-target="#modal123">Descargar informe por usuario</button><br>
        <div class="modal fade" id="modal123" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Informe por usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="GET" action="generar_informe.php">
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">Nombre del archivo</label>
                    <input type="text" class="form-control text-center" name="nombre_ar" required placeholder="Ingrese el nombre del archivo">
                  </div>
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">identificacion de usuario</label>
                    <input type="number" class="form-control text-center" name="documento" required placeholder="Ingrese el numero de documento">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="informe_usuario" id="informe_usuario" class="btn btn-primary">Descargar informe</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <h5>Informe de lecturas por usuario anual</h5>
        <button class="button btn btn-success m-3 " id="modal_ruta" data-bs-toggle="modal" data-bs-target="#modal1234">Descargar informe de lectura anual por usuario</button><br>
        <div class="modal fade" id="modal1234" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Informe por usuario anual</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="GET" action="generar_informe.php">
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">Nombre del archivo</label>
                    <input type="text" class="form-control text-center" name="nombre_ar" required placeholder="Ingrese el nombre del archivo">
                  </div>
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">identificacion de usuario</label>
                    <input type="number" class="form-control text-center" name="documento" required placeholder="Ingrese el numero de documento">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="informe_usuario_anual" id="informe_usuario_anual" class="btn btn-primary">Descargar informe</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <h5>Informe de consumo por usuario anual</h5>
        <button class="button btn btn-success m-3 " id="modal_ruta" data-bs-toggle="modal" data-bs-target="#modal12345">Descargar informe de consumo anual por usuario</button><br>
        <div class="modal fade" id="modal12345" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Informe de consumo por usuario anual</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="GET" action="generar_informe.php">
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">Nombre del archivo</label>
                    <input type="text" class="form-control text-center" name="nombre_ar" required placeholder="Ingrese el nombre del archivo">
                  </div>
                  <div class="mb-3">
                    <label for="nombre_ar" class="col-form-label">identificacion de usuario</label>
                    <input type="number" class="form-control text-center" name="documento" required placeholder="Ingrese el numero de documento">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="informe_usuario_anual_consumo" id="informe_usuario_anual_consumo" class="btn btn-primary">Descargar informe</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("../include/footer.php")?>
  
<?php
} else {
  header("location:../index.php");
  echo "ingrese correctamente";
}
?>