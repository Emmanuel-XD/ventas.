<?php

session_start();
error_reporting(0);
	$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location: _sesion/login.php");

	}
require_once ("base_de_datos.php");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=ventas.xls");
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id, 
GROUP_CONCAT(	productos.codigo, '..',  productos.descripcion, '..', productos_vendidos.cantidad 
SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos 
ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON
 productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

       <table>            
                   <thead>    
                         <tr>
                    <th>ID</th>
					<th>Fecha</th>
					<th>Productos vendidos</th>
					<th>Total</th>

                       
                        </tr>
                        </thead>
                        <?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->id ?></td>
					<td><?php echo $venta->fecha ?></td>
					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
								</tr>
								<?php } ?>
                                <?php } ?>
							</tbody>
						</table>
					</td>
                    </table>
                                </div>