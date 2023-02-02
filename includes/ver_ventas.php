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
<?php

include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id,ventas.nombre,
GROUP_CONCAT(	productos.codigo, '..',  productos.descripcion, '..', productos_vendidos.cantidad 
SEPARATOR '__') AS productos FROM ventas LEFT JOIN productos_vendidos 
ON productos_vendidos.id_venta = ventas.id LEFT JOIN productos ON
 productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id DESC ;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);

?><div class="col-xs-12">

<h1>Reporte de Ventas</h1>
<br>
<div>
</div>

<br>

<style>



</style>
<center>
<h3></h3></center>

<table class="table table-striped" id= "table_id">

                   
<thead>    
<tr >
                    <th>Num.Ventas</th>
					<th>Fecha</th>
					<th>Productos vendidos</th>
					<th>Total</th>
					<th>Realizado Por</th>



</tr>
</thead>
<tbody>
<?php foreach($ventas as $venta){ ?>
				<tr class="table-striped ">
					<td><b><?php echo $venta->id ?></td></b>
					<td><?php echo $venta->fecha; ?></td>
					
					<td>
					<table class=" table table-striped "  id= "table_id">
							<thead>
								<tr class="" >
									<th>Codigo</th>
									<th>Descripción</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td ><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
                        <td><?php echo  '$',$venta->total ?></td>
                        <td><?php echo $venta->nombre ?></td>
				</tr>
				<?php } ?>

	</body>
  </table>
 <script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        setTimeout(() => {
            window.location.href = "../views/ventas.php";
        }, 1000);
    });
</script>