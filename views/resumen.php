<?php 

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:../includes/_sesion/login.php");
		die();
	}
?>


<link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../css/prueba.css">

<?php
include_once "encabezado.php";


?><div class="col-xs-12">
    <center>
<h1>RESUMEN</h1>
</center>
<a href="caja.php" class="btn btn-outline-primary">Caja <i class="fa fa-archive" aria-hidden="true"></i></i> </a>
<a href="gastos.php" class="btn btn-outline-danger">Gastos  <i class="fa fa-book fa-fw" aria-hidden="true"></i> </a>
<a href="../includes/report.php"  class="btn btn-outline-success" target="_blank">Generar Reporte <i class="fa fa-book fa-fw" aria-hidden="true"></i> </a>
<div>
<br>
<p>En este apartado puedes ver los gastos o ingresos del dia que se hayan realizado anteriormente..
</p>
<p><b>Nota:</b> Una vez que hayas cuadrado deberas eliminar los registros para evitar confusiones
con el resto de las ventas o el resto del turno. Tambien si es de tu preferencia puedes guardarlo como PDF
o Imprimirlo.</p>
</div>



<style>


th {

color: white;
}
</style>
<center>
<h3>Caja</h3></center>
<table class="table table-striped" id= "table_id">

                   
<thead>    
<tr class="bg-dark">
<tr class="bg-dark">
<th>Num.Emision</th>
<th>Descripcion</th>
<th>Concepto</th>
<th>Monto</th>
<th>Fecha</th>
<th>Solicitado Por:</th>
<th>Eliminar</th>




</tr>
</thead>
<tbody>

<?php

require_once ("../includes/db.php");
 
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

<td>
<a href="../includes/eliminar_caja.php?id=<?php echo $fila['id']?> " class=" btn btn-danger btn-del" >
<i  class="fa fa-trash "></i></a></button>
</td>
</tr>

<?php
}
}

?>

	</body>
  </table>
<br>

<style>


        th {

        color: white;
    }
</style>

<center>
<h3>Gastos</h3></center>
<table class="table table-striped" id= "table_id">

                   
<thead>    
<tr class="bg-dark">
<tr class="bg-dark">
<th>Num.Emision</th>
<th>Descripcion</th>
<th>Concepto</th>
<th>Monto</th>
<th>Fecha</th>
<th>Solicitado Por:</th>
<th>Eliminar</th>




</tr>
</thead>
<tbody>

<?php

require_once ("../includes/db.php"); 
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

<td>
<a href="../includes/eliminar_gastos.php?id=<?php echo $fila['id']?> " class=" btn btn-danger btn-del" >
<i  class="fa fa-trash "></i></a></button>
</td>
</tr>

<?php
}
}

?>

	</body>
  </table>
  
<script>
    
    $('.btn-del').on('click', function(e){
e.preventDefault();
const href = $(this).attr('href')

Swal.fire({
  title: 'Estas seguro de eliminar este registro?',
  text: "¡No podrás revertir esto!!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar!', 
  cancelButtonText: 'Cancelar!', 
}).then((result)=>{
    if(result.value){
        if (result.isConfirmed) {
    Swal.fire(
      'Eliminado!',
      'El registro fue eliminado.',
      'success'
    )
  }

        document.location.href= href;
    }   
})

    })


</script>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<script src="../package/jquery-3.6.0.min.js"></script>
 