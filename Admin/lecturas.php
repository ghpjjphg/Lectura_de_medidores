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
        <h3>Modificar lecturas</h3>
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
        <form method="GET" action="lecturas.php">
          <fieldset>
            <legend>Busqueda de medidores</legend>
            <label for="medidor" class="text-center">Numero de Medidor</label> <br>
            <input class="text-center" type="text" name="medidor" required placeholder="Ingresar N de medidor"> <br> <br>
            <input class="button btn btn-success" type="submit" value="buscar" name="buscar"> <br>
          </fieldset>
        </form> <br>
        <?php
        if (isset($_GET['buscar'])) {
          $medidor = $_GET['medidor'];
          $query = "SELECT contador.id_contador, contador.lectura_final, contador.fecha_lectura, contador.lectura_anterior, usuarios.id_usuario, usuarios.nombre_usuario, usuarios.direccion, usuarios.id_servicio, ruta.id_ruta FROM contador INNER JOIN usuarios ON usuarios.id_usuario=contador.id_usuario INNER JOIN ruta ON ruta.id_contador=contador.id_contador WHERE contador.id_contador='$medidor'";
          $result = mysqli_query($conn, $query);
          $cantidad = $result->num_rows;
          if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $contador = $row['id_contador'];
            $direccion = $row['direccion'];
            $idUsuario = $row['id_usuario'];
            $id_servicio = $row['id_servicio'];
            $usuario = $row['nombre_usuario'];
            $lectura_f = $row['lectura_final'];
            $fecha_lectura = $row['fecha_lectura'];
            $ruta = $row['id_ruta'];
            $lectura_anterior = $row ['lectura_anterior'];
          }
          if ($cantidad > 0) {
        ?>
            <div class="card">
              <h5>Información del medidor</h5>
              <div class="card-body">
                <form action="actualizar_lecturas.php" method="GET">
                  <div class="form_group">
                    <h6>Identificación del usuario
                    </h6>
                    <input class="text-center" type="number" name="identificacion" value="<?php echo $idUsuario; ?>" class="from_control" readonly>
                  </div>
                  <div class="form_group">
                    <h6>Identificación del servico
                    </h6>
                    <input class="text-center" type="number" name="identificacion" value="<?php echo $id_servicio; ?>" class="from_control" readonly>
                  </div>
                  <div class="form_group">
                    <h6>Nombre del ususario
                    </h6>
                    <input class="text-center" type="text" name="nombre_usuario" value="<?php echo $usuario; ?>" class="from_control" readonly>
                  </div>
                  <div class="form_group">
                    <h6>Numero de medidor
                    </h6>
                    <input class="text-center" type="text" name="medidor" value="<?php echo $contador; ?>" class="from_control" readonly>
                  </div>
                  <div class="form_group">
                    <h6>Dirección
                    </h6>
                    <input class="text-center" type="text" name="direccion" value="<?php echo $direccion; ?>" class="from_control" readonly>
                  </div>
                  <div class="form_group">
                    <h6>Ruta de ubicación
                    </h6>
                    <input class="text-center" type="text" name="ruta" value="<?php echo $ruta; ?>" class="from_control" readonly>
                  </div>
                  <div class="form_group">
                    <h6>Lectura final
                    </h6>
                    <input class="text-center" type="number" name="consumo" value="<?php echo $lectura_anterior ; ?>" class="from_control">
                  </div>
                  <div class="form_group">
                    <h6>Consumo
                    </h6>
                    <input class="text-center" type="number" name="lectura_f" value="<?php echo $lectura_f  ; ?>" class="from_control">
                  </div>
                  <div class="form_group">
                    <h6>Fecha de lectura
                    </h6>
                    <input class="text-center" type="datetime" name="fecha_lectura" value="<?php echo $fecha_lectura; ?>" class="from_control" readonly>
                  </div>
                  <br>
                  <button class="btn btn-primary" type="submit" name="actualizar" value="actualizar">Actualizar</button>
                </form>
                <button class="button btn btn-success m-3 " id="modal_usu" data-bs-toggle="modal" data-bs-target="#modal1">Lecturas por fechas</button>
                <button class="button btn btn-success m-3 " id="modal_usu" data-bs-toggle="modal" data-bs-target="#modal12">Consumo por fechas</button>
                <?php
                $queryconsumo = "SELECT `id_contador`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre` FROM `consumo` WHERE consumo.id_contador = '$medidor'";
                $resultadoconsumo = mysqli_query($conn, $queryconsumo);
                if (mysqli_num_rows($resultadoconsumo) == 1) {
                    $row = mysqli_fetch_array($resultadoconsumo);
                    $enero_con = $row['enero'];
                    $febrero_con = $row['febrero'];
                    $marzo_con = $row['marzo'];
                    $abril_con = $row['abril'];
                    $mayo_con = $row['mayo'];
                    $junio_con = $row['junio'];
                    $julio_con = $row['julio'];
                    $agosto_con = $row['agosto'];
                    $septiembre_con = $row['septiembre'];
                    $octubre_con = $row['octubre'];
                    $noviembre_con = $row['noviembre'];
                    $diciembre_con = $row['diciembre'];
                }
                ?>
                <div class="modal fade" id="modal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo "Nombre del usuario  ".$usuario; ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="GET" action="actualizar_lecturas.php">
                        <div class="mb-3">
                            <label for="medidor" class="col-form-label">Medidor</label>
                            <input type="text" class="form-control text-center" name="medidor" value="<?php echo $contador?>"  placeholder="Numero de medidor">
                          </div>
                          <div class="mb-3">
                            <label for="enero" class="col-form-label">Enero</label>
                            <input type="number" class="form-control text-center" name="enero" value="<?php echo $enero_con?>"  placeholder="lectura de enero">
                          </div>
                          <div class="mb-3">
                            <label for="febrero" class="col-form-label">febrero</label>
                            <input type="number" class="form-control text-center" name="febrero"  value="<?php echo $febrero_con?>"  placeholder="lectura de febrero">
                          </div>
                          <div class="mb-3">
                            <label for="marzo" class="col-form-label">Marzo</label>
                            <input type="numbre" class="form-control text-center" name="marzo"  value="<?php echo $marzo_con?>"  placeholder="lectura de marzo">
                          </div>
                          <div class="mb-3">
                            <label for="abril" class="col-form-label">Abril</label>
                            <input type="number" class="form-control text-center" name="abril"  value="<?php echo $abril_con?>"  placeholder="lectura de abril ">
                          </div>
                          <div class="mb-3">
                            <label for="mayo" class="col-form-label">Mayo</label>
                            <input type="number" class="form-control text-center" name="mayo"   value="<?php echo $mayo_con?>" placeholder="Iectura de mayo">
                          </div>
                          <div class="mb-3">
                            <label for="junio" class="col-form-label">Junio</label>
                            <input type="number" class="form-control text-center" name="junio"  value="<?php echo $junio_con?>"  placeholder="lctura de junio">
                          </div>
                          <div class="mb-3">
                            <label for="julio" class="col-form-label">Julio</label>
                            <input type="number" class="form-control text-center" name="julio" value="<?php echo $julio_con?>"  placeholder="lectura de julio">
                          </div>
                          <div class="mb-3">
                            <label for="agosto" class="col-form-label">Agosto</label>
                            <input type="number" class="form-control text-center" name="agosto"  value="<?php echo $agosto_con?>"  placeholder="lectrura de agosto">
                          </div>
                          <div class="mb-3">
                            <label for="septiembre" class="col-form-label">Septiembre</label>
                            <input type="numbre" class="form-control text-center" name="septiembre"  value="<?php echo $septiembre_con?>"  placeholder="lectura de septiembre">
                          </div>
                          <div class="mb-3">
                            <label for="octubre" class="col-form-label">Octubre</label>
                            <input type="number" class="form-control text-center" name="octubre"  value="<?php echo $octubre_con?>"  placeholder="lectura de octubre ">
                          </div>
                          <div class="mb-3">
                            <label for="noviembre" class="col-form-label">Noviembre</label>
                            <input type="number" class="form-control text-center" name="noviembre"  value="<?php echo $noviembre_con?>"  placeholder="lectura de noviembre">
                          </div>
                          <div class="mb-3">
                            <label for="diciembre" class="col-form-label">Diciembre</label>
                            <input type="text" class="form-control text-center" name="diciembre"  value="<?php echo $diciembre_con?>" placeholder="lectura de diciembre">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="actualizar_consumo" id="actualizar_consumo" class="btn btn-primary">Actualizar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                <?php 
                $querylecturas = "SELECT fechas_lecturas.enero, fechas_lecturas.febrero, fechas_lecturas.marzo, fechas_lecturas.abril, fechas_lecturas.mayo, fechas_lecturas.junio, fechas_lecturas.julio, fechas_lecturas.agosto, fechas_lecturas.septiembre, fechas_lecturas.octubre, fechas_lecturas.noviembre, fechas_lecturas.diciembre  FROM fechas_lecturas WHERE fechas_lecturas.id_contador='$medidor'";
                $resultado = mysqli_query($conn, $querylecturas);
                if (mysqli_num_rows($resultado) == 1) {
                    $row = mysqli_fetch_array($resultado);
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
                }
                ?>
                <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo "Nombre del usuario ".$usuario; ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="GET" action="actualizar_lecturas.php">
                        <div class="mb-3">
                            <label for="medidor" class="col-form-label">Medidor</label>
                            <input type="text" class="form-control text-center" name="medidor" value="<?php echo $contador?>"  placeholder="Numero de medidor">
                          </div>
                          <div class="mb-3">
                            <label for="enero" class="col-form-label">Enero</label>
                            <input type="number" class="form-control text-center" name="enero" value="<?php echo $enero?>"  placeholder="lectura de enero">
                          </div>
                          <div class="mb-3">
                            <label for="febrero" class="col-form-label">febrero</label>
                            <input type="number" class="form-control text-center" name="febrero"  value="<?php echo $febrero?>"  placeholder="lectura de febrero">
                          </div>
                          <div class="mb-3">
                            <label for="marzo" class="col-form-label">Marzo</label>
                            <input type="numbre" class="form-control text-center" name="marzo"  value="<?php echo $marzo?>"  placeholder="lectura de marzo">
                          </div>
                          <div class="mb-3">
                            <label for="abril" class="col-form-label">Abril</label>
                            <input type="number" class="form-control text-center" name="abril"  value="<?php echo $abril?>"  placeholder="lectura de abril ">
                          </div>
                          <div class="mb-3">
                            <label for="mayo" class="col-form-label">Mayo</label>
                            <input type="number" class="form-control text-center" name="mayo"   value="<?php echo $mayo?>" placeholder="Iectura de mayo">
                          </div>
                          <div class="mb-3">
                            <label for="junio" class="col-form-label">Junio</label>
                            <input type="number" class="form-control text-center" name="junio"  value="<?php echo $junio?>"  placeholder="lctura de junio">
                          </div>
                          <div class="mb-3">
                            <label for="julio" class="col-form-label">Julio</label>
                            <input type="number" class="form-control text-center" name="julio" value="<?php echo $julio?>"  placeholder="lectura de julio">
                          </div>
                          <div class="mb-3">
                            <label for="agosto" class="col-form-label">Agosto</label>
                            <input type="number" class="form-control text-center" name="agosto"  value="<?php echo $agosto?>"  placeholder="lectrura de agosto">
                          </div>
                          <div class="mb-3">
                            <label for="septiembre" class="col-form-label">Septiembre</label>
                            <input type="numbre" class="form-control text-center" name="septiembre"  value="<?php echo $septiembre?>"  placeholder="lectura de septiembre">
                          </div>
                          <div class="mb-3">
                            <label for="octubre" class="col-form-label">Octubre</label>
                            <input type="number" class="form-control text-center" name="octubre"  value="<?php echo $octubre?>"  placeholder="lectura de octubre ">
                          </div>
                          <div class="mb-3">
                            <label for="noviembre" class="col-form-label">Noviembre</label>
                            <input type="number" class="form-control text-center" name="noviembre"  value="<?php echo $noviembre?>"  placeholder="lectura de noviembre">
                          </div>
                          <div class="mb-3">
                            <label for="diciembre" class="col-form-label">Diciembre</label>
                            <input type="text" class="form-control text-center" name="diciembre"  value="<?php echo $diciembre?>" placeholder="lectura de diciembre">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="actualizar_lecturas" id="actualizar_lecturas" class="btn btn-primary">Actualizar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } else {
          ?>
            <div class="alert alert-info align-items-center text-center alert-dismissible" role="alert">
              <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
              </svg>
              <div>
                <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                  Este medidor no existe
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
          <?php
          }
        }
          ?>

            </div>
      </div>
    </div>
  </div>

  <?php include("../include/footer.php");
  $_SESSION['rol'] = 1 ;?>

<?php
} else {
  header("location:../index.php");
}
?>