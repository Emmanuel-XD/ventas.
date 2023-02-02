<?php 

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:../includes/_sesion/login.php");
		die();
	}
?>



<?php include_once "encabezado.php"; ?>

<link rel="stylesheet" href="../package/dist/sweetalert2.css">
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">¡Envianos un mensaje!</h3>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
					<i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
<div class="col-xs-12">
    

    
	<form method="post" action="../includes/enviarcorreo.php">
    <div class="form-group">
		<label for="nombre" class="form-label">Nombre</label>
		<input class="form-control" name="nombre" type="text" id="nombre" placeholder="Escribe tu nombre" required>
        </div>
        
        <div class="form-group">
		<label for="correo" class="form-label">Correo:</label>
		<input id="correo" name="correo" type="email"  class="form-control" placeholder="Escribe tu correo" required></textarea>
        </div>

        <div class="form-group">
		<label for="telefono" class="form-label">Telefono:</label>
		<input class="form-control" name="numero" type="number" id="numero" placeholder="Escribe tu telefono" required>
        </div>

        <div class="form-group">
		<label for="mensaje" class="form-label">Mensaje:</label>
		<textarea class="form-control" name="mensaje" cols="30" rows="5" type="text" id="mensaje" 
        placeholder="Escribe tu mensaje......" required></textarea>
        </div>
<br>
<input class="btn btn-primary" type="submit"  value="Enviar Mensaje"> 

	</form>
</div>
<style>
a {
    color: #0d6efd;
    text-decoration: none;
}
</style>