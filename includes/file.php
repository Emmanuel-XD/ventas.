<?php

session_start();
error_reporting(0);
	$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location: _sesion/login.php");
	
	}
require_once ("base_de_datos.php");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=productos.xls");
?>
       <table>            
                   <thead>    
                         <tr>
                    
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de compra</th>
					<th>Precio de venta</th>
					<th>Stock</th>
					<th>Ingreso</th>
					<th>Egresos</th>
					<th>Ganancia</th>
          <th>Fecha_Registro</th>
                       
                        </tr>
                        </thead>
                        <tbody>
                        <?php
require_once ("db.php");          
$SQL="SELECT * FROM productos ";
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
<td><?php echo  '$'.$fila['precioVenta'] * $fila['existencia'] ; ?></td>
<td><?php echo  '$'.$fila['precioCompra'] * $fila['existencia'] ; ?></td>
<td><?php echo  '$'.($fila['precioVenta'] - $fila['precioCompra']) * $fila['existencia']; ?></td>
<td><?php echo $fila['fecha']; ?></td>

<td>
 
    </div>
  </a>
  <a></a>

    </div>
  </a>
</td>
</tr>


<?php
}
}else{

    ?>
    <tr class="text-center">
    <td colspan="11">No existen registros</td>
    </tr>

    <?php
}?>
                         </tbody>
                         </table>
</div>