
  
  <?php


/**
 * Parte de registro de usuarios
 */

require_once ("../db.php");  
if(isset($_POST)){
	extract($_POST);


  $consulta = "INSERT INTO user (nombre, correo, telefono, password, rol_id)
		VALUES ('$nombre', '$correo', '$telefono', '$password', '$rol_id')";
   $resultado=mysqli_query($conexion, $consulta);

	  if($resultado){
echo'El registro fue guardado correctamente';
	
	  }else{
		  echo 'Error al guardar los datos';
	  }
}else{
  echo 'No data';
}





