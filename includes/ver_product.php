<?php 

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:./_sesion/login.php");
		die();
	}
    ?>
<link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../css/prueba.css">
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/new/bootstrap.min.css">
    <script src="../js/resp/bootstrap.min.js"></script>

<br>
<div class="col-xs-12">

<h1>Lista de productos</h1>
<br>
<div>
</div>

<table class="table table-striped" id= "table_id">

                   
<thead>    
<tr >
                    <th>Codigo</th>
					<th>Producto</th>
					<th>Compra$</th>
					<th>Venta$</th>
					<th>Stock</th>
					<th>Total</th>
					<th>Inversion</th>
					<th>Ganancia</th>
					<th>Fecha/Registro</th>
					<th>Usuario</th>



</tr>
</thead>
<tbody>

<?php

require_once ("db.php");
 
 $SQL="SELECT * FROM productos ORDER BY id ASC;";
 $dato = mysqli_query($conexion, $SQL);
 if($dato -> num_rows >0){
     while($fila=mysqli_fetch_array($dato)){
         ?>   
<tr>
<td><?php echo $fila['codigo']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo '$'.$fila['precioCompra']; ?></td>
<td><?php echo '$'.$fila['precioVenta']; ?></td>
<td><?php echo $fila['existencia']; ?></td>
<td><?php echo'$'.$fila['precioVenta'] * $fila['existencia'] ; ?></td>
<td><?php echo '$'.$fila['precioCompra'] * $fila['existencia'] ; ?></td>
<td><?php echo '$'.($fila['precioVenta'] - $fila['precioCompra']) * $fila['existencia']; ?></td>
<td><?php echo $fila['fecha']; ?></td>
<td><?php echo $fila['nombre']; ?></td>


</tr>

<?php
}
}

?>

	</body>
  </table>
 <script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        setTimeout(() => {
            window.location.href = "listar.php";
        }, 1000);
    });
</script>