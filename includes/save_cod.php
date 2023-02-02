
  
  <?php


/**
 * Parte de registro de usuarios
 */

require_once ("db.php");
if(isset($_POST)){
  if (strlen($_POST['id_producto']) >= 1 && strlen($_POST['codigo']) >= 1 ) {
        $id_producto = trim($_POST['id_producto']);
        $codigo = trim($_POST['codigo']);


  $consulta = "INSERT INTO codbarra (id_producto, codigo)
        VALUES ('$id_producto', '$codigo')";
   $resultado=mysqli_query($conexion, $consulta);

      if($resultado){
echo'El registro fue guardado correctamente. Verifique que consida con el del inventario';
    
      }else{
          echo 'Error al guardar los datos';
      }
}else{
  echo 'Campos Vacios';
}
}





