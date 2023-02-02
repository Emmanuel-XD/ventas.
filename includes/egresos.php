
  
  <?php

  /**
   * Parte de registro de usuarios
   */

  require_once ("db.php"); 

session_start();
error_reporting(0);
	$varsesion = $_SESSION['nombre'];

if(isset($_POST)){
	if (strlen($_POST['descripcion']) >= 1 && strlen($_POST['concepto']) >= 1 && strlen($_POST['monto']) >= 1 ) {
		  $descripcion = trim($_POST['descripcion']);
		  $concepto = trim($_POST['concepto']);
		  $monto = trim($_POST['monto']);
		  $varsesion = $_SESSION['nombre'];

	$consulta = "INSERT INTO gastos (descripcion, concepto, monto, nombre)
	      VALUES ('$descripcion', '$concepto', '$monto', '$varsesion')";
     $resultado=mysqli_query($conexion, $consulta);

		if($resultado){
echo'El registro fue guardado correctamente';
      
		}else{
			echo 'Ocurrio un error al guardar los datos';
		}
}else{
	echo 'No has llenado los campos';
}
}
