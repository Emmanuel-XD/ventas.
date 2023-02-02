<?php
   
require_once ("./base_de_datos.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'editar_registro':
            editar_registro();
            break; 

            case 'editar_producto':
            editar_producto();
            break; 

            case 'editar_datos':
            editar_datos();
            break;

            case 'editar_tema';
            editar_tema();
            break;

            case 'editar_cod';
            editar_cod();
            break;
 
            case 'eliminar_registro';
            eliminar_registro();
    
            break;

            case 'acceso_user';
            acceso_user();
            break;
           
            case 'insert_p';
            insert_p();
            break;

		}

	}

    function editar_producto() {
		require_once ("db.php");
        session_start();
        error_reporting(0);
        $varsesion = $_SESSION['nombre'];
        
		extract($_POST);
		$consulta="UPDATE productos SET codigo = '$codigo', descripcion = '$descripcion', 
        precioCompra = '$precioCompra',  precioVenta = '$precioVenta', existencia = '$existencia',
		fecha='$fecha', total='$precioVenta' * '$existencia', nombre='$varsesion' WHERE id = '$id' ";
        $resultado=mysqli_query($conexion, $consulta);

       if($resultado){
            echo "<script language='JavaScript'>
            alert('El registro fue actualizado correctamente');
            location.assign('listar.php');
           </script>";
       } else{
       echo "<script language='JavaScript'>
      alert('Uy no! ya valio hablale al ing :v');
      location.assign('listar.php');
      </script>";
}

}

    function editar_registro() {
		require_once ("db.php");
		extract($_POST);
		$consulta="UPDATE user SET nombre = '$nombre', correo = '$correo', password = '$password',
		telefono='$telefono', rol_id='$rol_id' WHERE id = '$id' ";
		$resultado=mysqli_query($conexion, $consulta);

       if($resultado){
            echo "
            <script language='JavaScript'>
            alert('El registro fue actualizado correctamente');
            location.assign('../views/usuarios.php');
            </script>";
       } else{
             echo "<script language='JavaScript'>
             alert('Uy no! ya valio hablale al ing :v');
             location.assign('../views/usuarios.php');
             </script>";
}

}

function editar_datos() {
    require_once ("db.php");
    extract($_POST);
    $consulta="UPDATE datos SET negocio = '$negocio', telefono='$telefono', direccion='$direccion', mensaje ='$mensaje' 
    WHERE id = '$id' ";
    $resultado=mysqli_query($conexion, $consulta);

   if($resultado){
        echo "
        <script language='JavaScript'>
        alert('El registro fue guardado correctamente');
        location.assign('../views/usuarios.php');
        </script>";
   } else{
         echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/usuarios.php');
         </script>";
}

}
function editar_tema() {
    require_once ("db.php");
    extract($_POST);
    $consulta="UPDATE settings SET municipio = '$municipio', estado='$estado', pais='$pais', tema ='$tema' 
    WHERE id = '$id' ";
    $resultado=mysqli_query($conexion, $consulta);

   if($resultado){
        echo "
        <script language='JavaScript'>
        alert('Los cambios fueron aplicados');
        location.assign('../views/index.php');
        </script>";
   } else{
         echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/index.php');
         </script>";
}

}

function editar_cod() {
    require_once ("db.php");
    extract($_POST);
    $consulta="UPDATE codbarra SET nombre = '$nombre', codigo='$codigo'
    WHERE id = '$id' ";
    $resultado=mysqli_query($conexion, $consulta);

   if($resultado){
        echo "
        <script language='JavaScript'>
        alert('El registro fue guardado correctamente. Verifique que consida con el del inventario');
        location.assign('../views/codbarra.php');
        </script>";
   } else{
         echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/codbarra.php');
         </script>";
}

}


function eliminar_registro(){
    require_once ("db.php");
    extract($_POST);
    $id = $_POST['id'];
    $consulta = "DELETE FROM user WHERE id = $id";
		$resultado=mysqli_query($conexion, $consulta);

       if($resultado){
            echo "<script language='JavaScript'>
            alert('El registro se elimino correctamente');
            location.assign('../views/usuarios.php');
            </script>";
       } else{
             echo "<script language='JavaScript'>
             alert('Uy no! ya valio hablale al ing :v');
             location.assign('../views/usuarios.php');
             </script>";
}
}
function acceso_user(){

  
		extract($_POST);
        require_once ("db.php");
        $nombre= $conexion->real_escape_string($_POST['nombre']);
        $password= $conexion->real_escape_string($_POST['password']);
        session_start();
        $_SESSION['nombre']=$nombre;
        //$_SESSION['rol_id']=$rol_id;
    
        
        $consulta="SELECT*FROM user where nombre='$nombre' and password='$password'";
        $resultado=mysqli_query($conexion,$consulta);
        $filas=mysqli_fetch_array($resultado);
        
 
        if(isset($filas['rol_id'])==1){

            header('Location: ../views/usuarios.php');


            if($filas['rol_id']==2){ //empleado
         
      
                header('Location: ../views/index.php');

        }

    } else{
            
           
        echo "<script language='JavaScript'>
        alert('Usuario o Contraseña Incorrecta');
        location.assign('./_sesion/login.php');
        </script>";
            session_destroy();
        }
}

function insert_p(){
    require_once ("db.php");
    extract($_POST);
    session_start();
    error_reporting(0);
    $varsesion = $_SESSION['nombre'];

    $consulta = "INSERT INTO productos (codigo, descripcion, precioVenta, precioCompra, existencia, fecha, total, nombre)
	VALUES ('$codigo', '$descripcion ', '$precioVenta', '$precioCompra', '$existencia', '$fecha', '$total', '$varsesion' )";
    mysqli_query($conexion, $consulta);

    header("Location: listar.php");
}



if (!isset($_POST["cantidad"])) {
	exit("No hay cantidad");
}
if (!isset($_POST["indice"])) {
	exit("No hay índice");
}
$cantidad = floatval($_POST["cantidad"]);
$indice = intval($_POST["indice"]);
session_start();
if ($cantidad > $_SESSION["carrito"][$indice]->existencia) {
	header("Location: ../views/vender.php?status=5");
	exit;
}
$_SESSION["carrito"][$indice]->cantidad = $cantidad;
$_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precioVenta;
header("Location: ../views/vender.php");
