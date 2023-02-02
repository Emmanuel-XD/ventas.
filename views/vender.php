<?php 
session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:../includes/_sesion/login.php");
		die();
	}


	
session_start();
include_once "encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="../js/jquery-1.12.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
	<script type="text/javascript" src="../js/jquery-ui.js"></script>
</head>


	<div class="col-xs-12">
		<center>
		<h1>NUEVA VENTA</h1>
		</center>
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Excelente!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>¡Que mal!</strong> Producto eliminado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
					<?php
				}
			}
		?>
		<br>
		<?php  

 include "../includes/db.php";	

	 $result = mysqli_query($conexion, "SELECT * FROM productos");
	$array = array();
	if($result){
		while ($row = mysqli_fetch_array($result)) {
			$equipo = utf8_encode('Codigo: '.$row['codigo'].' - Producto: '.$row['descripcion']);
			array_push($array, $equipo); // equipos
		}
	}
?>

		<form method="post" action="../views/agregarAlCarrito.php">
			<label for="codigo">Código de barras:</label>
			<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" 
			placeholder="Escanea o Escribe el codigo...">
		</form>
		
	<script type="text/javascript">
		$(document).ready(function () {
			var items = <?= json_encode($array) ?>

			$("#codigo").autocomplete({
				source: items
	
			});
		});
	</script>
		<br><br>
      <style>
	
	.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    color: white;
}
a { text-decoration: none; }
</style>
		      <table class="table table-striped" id= "table_id">
			<thead>
				<tr class="bg-dark">
			
					<th>Código</th>
					<th>Descripción</th>
                    <th>Stock</th>
					<th>Precio de venta</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
					?>
				<tr>
					
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
                    <td><?php echo $producto->existencia ?></td>
					<td><?php echo  '$',$producto->precioVenta ?></td>
						<td>
						<form action="../includes/_functions.php" method="post">
							<input name="indice" type="hidden" value="<?php echo $indice; ?>">
							<input min="1" name="cantidad" class="form-control" required type="number" step="0.1" value="<?php echo $producto->cantidad; ?>">
						</form>
					</td>
					
					<td><?php echo  '$',$producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "../includes/quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<h3>Total: <?php echo  '$',$granTotal; ?></h3>
		<form action="../includes/terminarVenta.php" method="POST">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#vender">
				<span class="glyphicon glyphicon-plus"></span> Procesar Venta  <i class="fa fa-shopping-cart" aria-hidden="true"></i></a></button>
			<!-- <button type="submit" class="btn btn-success">Vender <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>-->
			<a href="../includes/cancelarVenta.php" class="btn btn-danger">Cancelar Venta <i class="fa fa-undo" aria-hidden="true"></i></a>
		</form>
	</div>
<?php include_once "pie.php" ?>
<?php include_once "ventana.php" ?>
