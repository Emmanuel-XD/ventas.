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
    <link rel="stylesheet" href="../package/dist/sweetalert2.css">

<?php
include_once "encabezado.php";


?><div class="col-xs-12">
	<center>
<h1>GASTOS $</h1>
</center>
<br>
<div>
<p>En este apartado puedes agregar los gastos que te surjan dentro de tu turno,
    como pagos, abonos, etc...
</p>
</div>

<br>

<style>

#m {  color: #FF0000;  }
#b {  color: #FFA500;  }
a { text-decoration: none; 
} 
</style>
<form  action="gastos.php" id="form" method="POST">

        <div class="container">
  
                     
         <h3 class="text-center">Agregar gastos</h3>
            <div class="form-group">
            <label for="descripcion" class="form-label">Descripción *</label>
            <input type="text"  id="descripcion" name="descripcion" class="form-control" placeholder="Por ejemplo: surgio un pago ext..">
                            </div>
             <div class="form-group">
                <label for="concepto">Concepto:</label><br>
                 <input type="text" name="concepto" id="concepto" class="form-control" placeholder="Por ejemplo: Abono a proveedor">
                            </div>
            <div class="form-group">
                <label for="pmonto">Monto $:</label><br>
                 <input type="number" name="monto" id="monto" class="form-control" >
                            </div>
<br>
                            <input type="submit" value="Guardar" id="register" class="btn btn-success" 
                               name="registrar">


<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){


			var descripcion = $('#descripcion').val();
			var concepto = $('#concepto').val();
			var monto = $('#monto').val();

			

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: '../includes/egresos.php',
					data: {descripcion: descripcion,concepto: concepto, monto: monto},
					success: function(data){
					Swal.fire({
								'title': '¡Mensaje!',
								'text': data,
                                'icon': 'success',
                                'showConfirmButton': 'false',
                                'timer': '1500'
								}).then(function() {
                window.location = "resumen.php";
            });
							
					} ,
                    
					error: function(data){
						Swal.fire({
								'title': 'Error',
								'text': data,
								'icon': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
    
	
</script>
</body>
</html>