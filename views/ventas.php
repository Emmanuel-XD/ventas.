<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

	header("Location:../includes/_sesion/login.php");
	die();
}
?>

<?php include_once "encabezado.php" ?>
<?php
include_once "../includes/base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id, ventas.nombre,
GROUP_CONCAT(	productos.codigo, '..',  productos.descripcion, '..', productos_vendidos.cantidad 
SEPARATOR '__') AS productos FROM ventas LEFT JOIN productos_vendidos 
ON productos_vendidos.id_venta = ventas.id LEFT JOIN productos ON
 productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" type="text/css" href="../css/prueba.css">

<div class="col-xs-12">
	<center>
		<h1>HISTORIAL DE VENTAS</h1>
	</center>
	<br>
	<div>
		<a class="btn btn-success" href="./vender.php">Nueva venta <i class="fa fa-plus"></i></a>
		<a href="../includes/R_Venta.php" class="btn btn-outline-danger" target="_blank">PDF <i class="fa fa-file" aria-hidden="true"></i></a>
		<a href="grafica.php" class="btn btn-outline-info">Grafica <i class="fa fa-signal" aria-hidden="true"></i></a>
		<a href="dia.php" class="btn btn-outline-primary">Ventas por dia <i class="fa fa-archive" aria-hidden="true"></i></i> </a>
		<a href="../includes/ver_ventas.php" class="btn btn-outline-secondary" target="_blank">Imprimir <i class="fa fa-print" aria-hidden="true"></i> </a>
	</div>

	<br>

	<style>
		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #dee2e6;
			color: white;
		}
	</style>
	<table class=" table table-striped" id="table_id">
		<thead>
			<tr class="bg-dark">
				<th>ID</th>
				<th>Fecha</th>
				<th>Productos vendidos</th>
				<th>Total</th>
				<th>Eliminar</th>
				<th>Ticket</th>
				<th>Realizado Por</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ventas as $venta) { ?>
				<tr>
					<td><b><?php echo $venta->id ?></td></b>
					<td><?php echo $venta->fecha; ?></td>
					<td>
						<table class="table table-striped" id="table_id">
							<thead>
								<tr class="bg-dark">
									<th>Codigo</th>
									<th>Descripcion</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach (explode("__", $venta->productos) as $productosConcatenados) {
									$producto = explode("..", $productosConcatenados)
								?>
									<tr>
										<td><?php echo $producto[0] ?></td>
										<td><?php echo $producto[1] ?></td>
										<td><?php echo $producto[2] ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo  '$', $venta->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "../includes/eliminarVenta.php?id=" . $venta->id ?>"><i class="fa fa-trash"></i></a></td>
					<td><a class="btn btn-outline-secondary" target="_blank" href="<?php echo "../includes/imprimirTicket.php?id=" . $venta->id ?>"><i class="fa fa-print"></i></a></td>
					<td><?php echo $venta->nombre ?></td>
				</tr>
			<?php } ?>

		</tbody>
	</table>



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



</div>


<script src="../js/ventas.js"></script>
<?php include_once "pie.php" ?>