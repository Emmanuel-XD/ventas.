<link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../css/prueba.css">
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/new/bootstrap.min.css">
    <script src="../js/resp/bootstrap.min.js"></script>
<?php



?><div class="col-xs-12">
<h1>Resumen</h1>
<br>
<div>
</div>

<br>

<style>



</style>
<center>
<h3>Caja</h3></center>

<table class="table table-striped" id= "table_id">

                   
<thead>    
<tr >
<th>Num.Emision</th>
<th>Descripcion</th>
<th>Concepto</th>
<th>Monto</th>
<th>Fecha</th>
<th>Solicitado por:</th>


</tr>
</thead>
<tbody>

<?php
require_once ("db.php"); 
 $SQL="SELECT * FROM caja;";
 $dato = mysqli_query($conexion, $SQL);
 if($dato -> num_rows >0){
     while($fila=mysqli_fetch_array($dato)){
         ?>   
<tr>
<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['concepto']; ?></td>
<td><?php echo '$'.$fila['monto']; ?></td>
<td><?php echo $fila['fecha']; ?></td>
<td><?php echo $fila['nombre']; ?></td>

</tr>

<?php
}
}

?>

	</body>
  </table>
<br>



<center>
<h3>Gastos</h3></center>

<table class="table table-striped" id= "table_id">

                   
<thead>    
<tr >
<th>Num.Emision</th>
<th>Descripcion</th>
<th>Concepto</th>
<th>Monto</th>
<th>Fecha</th>
<th>Solicitado Por:</th>


</tr>
</thead>
<tbody>

<?php

require_once ("db.php");
 
 $SQL="SELECT * FROM gastos;";
 $dato = mysqli_query($conexion, $SQL);
 if($dato -> num_rows >0){
     while($fila=mysqli_fetch_array($dato)){
         ?>   
<tr>
<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['concepto']; ?></td>
<td><?php echo '$'.$fila['monto']; ?></td>
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
            window.location.href = "../views/resumen.php";
        }, 1000);
    });
</script>