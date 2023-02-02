<?php 

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:../includes/_sesion/login.php");
		die();
	}
    		include "../includes/fecha.php";

?>
   <?php include "encabezado.php"; ?>   
   
<?php
                         require_once ("../includes/db.php");  
                         $consulta=mysqli_query($conexion,"SELECT * FROM settings ");

                         while ($fila=mysqli_fetch_array($consulta)) {

                           ?>
                    <center>
    <p class="ml-auto"><strong><?php echo $fila['municipio']?>, <?php echo $fila['estado']?>, <?php echo $fila['pais']?> </strong><?php echo fecha(); ?></p>
    <?php } ?>
                         
		<div class="reloj">
			<h3><span id="tiempo">00 : 00 : 00</span></h3>
		</div>

    </center>
      
      <div class="container is-fluid">
	<h1 class="title">Home</h1>
	<h2 class="subtitle">¡Welcome <?php echo  $_SESSION["nombre"]; ?>!</h2>
<br>
<br>
 <!-- Content Row -->
 <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <a class="text-xs font-weight-bold text-primary text-uppercase mb-1" href="#">
                        Usuarios</a>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                        require_once ("../includes/db.php");
    
                                $SQL="SELECT id FROM user ORDER BY id";
                                $dato = mysqli_query($conexion, $SQL);
                                $fila= mysqli_num_rows($dato);
    
                                echo($fila); ?></div>
                </div>
                <div class="col-auto">
                    <i class="fa fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="ventas.php">
                        Ventas</a>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                require_once ("../includes/db.php");
    
                                $SQL="SELECT total FROM ventas ORDER BY total";
                                $dato = mysqli_query($conexion, $SQL);
                                $fila= mysqli_num_rows($dato);
    
                                echo($fila); ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

   <style type="text/css"> 
a { text-decoration: none; 
    } 
</style> 
   
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <a class="text-xs font-weight-bold text-info text-uppercase mb-1" href="../includes/listar.php">
                        Productos
                </a>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php 
                                     require_once ("../includes/db.php");
    
                                $SQL="SELECT id FROM productos ORDER BY id";
                                $dato = mysqli_query($conexion, $SQL);
                                $fila= mysqli_num_rows($dato);
    
                                echo($fila); ?></div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <a class="text-xs font-weight-bold text-warning text-uppercase mb-1" href="calendario.php">
                        Pendientes</a>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
            require_once ("../includes/db.php");
    
                                $SQL="SELECT id FROM eventos ORDER BY id";
                                $dato = mysqli_query($conexion, $SQL);
                                $fila= mysqli_num_rows($dato);
    
                                echo($fila); ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
		</div>
             
        <script src="../js/reloj.js"></script>

