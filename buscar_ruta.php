<?php include("include/header.php") ?>
<?php include("include/footer.php") ?>
<?php include("db.php") ?>
<?php

if (isset($_SESSION['rol']) and $_SESSION['rol'] == 2 ) {
?>
  <?php include("narvar.php") ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">
          <form method="GET" action="ruta_contador.php">
            <fieldset>
              <legend>Busqueda de rutas</legend>
              <label for="n_ruta" class="text-center">Numero de ruta</label> <br>
              <input type="number" name="n_ruta" required placeholder="Inreser N de ruta"> <br> <br>
              <input class="button btn btn-success" type="submit" value="buscar"> <br>
            </fieldset>
          </form> <br>
        </div>
      </div>
    </div>
  </div>
<?php
} else {
  header("location:index.php");
  echo "ingrese correctamente";
}
?>





