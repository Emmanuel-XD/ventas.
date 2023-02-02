<?php 

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:./_sesion/login.php");
		die();
	}


////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
$id = $_GET['id'];
include_once "../views/encabezado.php";
require_once ("db.php");
$consulta = "SELECT * FROM codbarra WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);

////////////////// VARIABLES DE CONSULTA////////////////////////////////////
?>


<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>

    <link rel="stylesheet" href="../../css/fontawesome-all.min.css">

	<link rel="stylesheet" href="../../css/estilo.css">
</head>

<body>



    <form  action="_functions.php" method="POST">

        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                     
                            <h3 class="text-center">Editar el registro de <?php echo $usuario ['nombre']; ?></h3>
                                  
                              <div class="form-group ">
                              <label class="form-label">Nombre del Producto</label>
			                   <select class="form-control" id="nombre" name="nombre">
                               <option <?php echo $usuario ['id_']==='nombre' ? "selected='selected' ": "" ?> 
                                value="<?php echo $usuario ['nombre']; ?>"><?php echo $usuario ['nombre']; ?> </option>
				           <?php

                             require_once ("../includes/db.php"); 
                             //Codigo para mostrar categorias desde otra tabla
                             $sql="SELECT * FROM productos ";
                             $resultado=mysqli_query($conexion, $sql);
                             while($consulta=mysqli_fetch_array($resultado)){
	                        echo '<option value="'.$consulta['descripcion'].'">'.$consulta['descripcion'].'</option>';
}

?>

</select>
							</div>
                           

                            <div class="form-group ">
            <label class="form-label">Seleccione de nuevo el producto*</label>
			<select class="form-control"required id="codigo" name="codigo" >			
            <option <?php echo $usuario ['codigo']==='codigo' ? "selected='selected' ": "" ?> 
            value="<?php echo $usuario ['codigo']; ?>"><?php echo $usuario ['codigo']; ?> </option>
			<?php
          require_once ("../includes/db.php"); 
         //Codigo para mostrar categorias desde otra tabla
         $sql="SELECT * FROM productos ";
         $resultado=mysqli_query($conexion, $sql);
         while($consulta=mysqli_fetch_array($resultado)){
	     echo '<option value="'.$consulta['codigo'].'">'.$consulta['descripcion'].'</option>';
}

?>

</select>
		</div>
<!--<script type="text/javascript">
	$(document).ready(function(){
		//$('#nombre').val(1);
		recargarLista();

		$('#nombre').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"../views/select.php",
			data:"cod=" + $('#nombre').val(),
			success:function(r){
				$('#select2lista').html(r);
			}
		});
	}
</script>-->

                                  <input type="hidden" name="accion" value="editar_cod">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                               </select>
                            </div>
                           
                               <br>
                                <div class="mb-3">
                                    
                                <button type="submit" class="btn btn-success" >Editar</button>
                               <a href="../views/codbarra.php" class="btn btn-danger">Cancelar</a>
                               
                            </div>
                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>