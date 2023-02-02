<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

  header("Location: ./_sesion/login.php");
  die();
}

include_once "../views/encabezado.php";
?>



<div class="col-xs-12">
  <center>
    <h1>PRODUCTOS</h1>
  </center>
  <br>
</div>


<div>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#producto">
    <span class="glyphicon glyphicon-plus"></span> Agregar producto <i class="fa fa-plus"></i> </a></button>

  <a href="file.php" class="btn btn-outline-success">Excel <i class="fa fa-table" aria-hidden="true"></i></a>
  <a href="R_Product.php" class="btn btn-outline-danger" target="_blank">PDF <i class="fa fa-file" aria-hidden="true"></i></a>
  <a href="ver_product.php" class="btn btn-outline-secondary" target="_blank">Imprimir <i class="fa fa-print" aria-hidden="true"></i></a>
  <a href="../views/codbarra.php" class="btn btn-outline-primary">Codigo de Barra <i class="fa fa-barcode" aria-hidden="true"></i></a>

  <?php include('../views/formulario.php'); ?>


</div>

<br>
<br>

<table class="table table-striped" id="table_id">

  <thead>
    <tr class="bg-dark" style="color: white;">

      <th>Codigo</th>
      <th>Producto</th>
      <th>Compra$</th>
      <th>Venta$</th>
      <th>Stock</th>
      <th>Total</th>
      <th>Inversion</th>
      <th>Ganancia</th>
      <th>Registrado</th>
      <th>Usuario</th>
      <th>Acciones.</th>

    </tr>
  </thead>
  <tbody>

    <?php
    require_once("db.php");


    $result = mysqli_query($conexion, "SELECT * FROM productos");
    while ($fila = mysqli_fetch_assoc($result)) :

    ?>
      <tr>
        <td><?php echo $fila['codigo']; ?></td>
        <td><?php echo $fila['descripcion']; ?></td>
        <td><?php echo '$' . $fila['precioCompra']; ?></td>
        <td><?php echo '$' . $fila['precioVenta']; ?></td>
        <td><?php echo $fila['existencia']; ?></td>
        <td><?php echo '$' . $fila['precioVenta'] * $fila['existencia']; ?></td>
        <td><?php echo '$' . $fila['precioCompra'] * $fila['existencia']; ?></td>
        <td><?php echo '$' . ($fila['precioVenta'] - $fila['precioCompra']) * $fila['existencia']; ?></td>
        <td><?php echo $fila['fecha']; ?></td>
        <td><?php echo $fila['nombre']; ?></td>


        <td>
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
            <i class="fa fa-edit "></i>
          </button>

          <a href="eliminar.php?id=<?php echo $fila['id'] ?> " class=" btn btn-danger btn-del">
            <i class="fa fa-trash "></i></a></button>
        </td>
        <?php include "editar.php"; ?>
      </tr>


    <?php endwhile; ?>

  </tbody>

</table>
</div>


<script>
  $('.btn-del').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
      title: 'Estas seguro de eliminar este producto?',
      text: "¡No podrás revertir esto!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!',
      cancelButtonText: 'Cancelar!',
    }).then((result) => {
      if (result.value) {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'El producto fue eliminado.',
            'success'
          )
        }

        document.location.href = href;
      }
    })

  })
</script>


<script src="../js/tabla.js"></script>

<?php include_once "../views/pie.php" ?>

</html>