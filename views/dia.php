<?php
include_once "encabezado.php";


?>

<link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="../css/prueba.css">

<div class="col-xs-12">
  <center>
  <h1>TOTAL DE VENTAS POR DIA</h1>
  </center>
  <br>

  <a href="resumen.php" class="btn btn-outline-success">Ver Resumen <i class="fa fa-list-alt" aria-hidden="true"></i></a>
  <a href="ver.php" class="btn btn-outline-dark">Ver por fechas <i class="fa fa-list-alt" aria-hidden="true"></i></a>

  <div>
    <p>En este apartado puedes ver el total de ventas que se realizo por dia.
      Puedes buscar u ordenar de la primera venta a la ultima venta con ayuda
      de las flechas invertidas.
    </p>
  </div>
  <br>


  <table class="table table-striped" id="table_id">


    <thead>
      <tr class="bg-dark">
        <th>ID.Ventas</th>
        <th>Fecha</th>
        <th>Total</th>


      </tr>
    </thead>
    <tbody>

      <?php

      require_once("../includes/db.php");

      $SQL = "SELECT id,fecha, sum(total) as total FROM ventas GROUP BY DAY(fecha) ";
      $dato = mysqli_query($conexion, $SQL);
      if ($dato->num_rows > 0) {
        while ($fila = mysqli_fetch_array($dato)) {
      ?>
          <tr>
            <td><b><?php echo $fila['id']; ?></td>
            <td><b><?php echo $fila['fecha']; ?></b></td>
            <td><b><?php echo '$' . $fila['total']; ?></td>


            <!--<td><a class="btn btn-primary" href="<?php // echo "../includes/ticket.php?id=" . $venta->id
                                                      ?>"><i class="fa fa-print"></i></a></td>-->


        <?php
        }
      }
        ?>

        </body>
        <style>


        </style>



        <script src="../js/dia.js"></script>
  </table>
  <br>
  <?php
  //Calcular el total de ventas
  require_once("../includes/db.php");

  $SQL = "SELECT SUM(total)AS total FROM ventas ";
  $dato = mysqli_query($conexion, $SQL);

  if ($dato->num_rows > 0) {
    while ($fila = mysqli_fetch_array($dato)) {
  ?>

      <h3>Total de ventas: <?php echo '$' . $fila['total'];  ?></h3>

  <?php
    }
  }
  ?>

  <?php include "pie.php"; ?>