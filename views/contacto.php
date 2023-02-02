<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

	header("Location:../includes/_sesion/login.php");
	die();
}
?>


<!-- Script para el funcionamiento de de la ventana modal-->
<!-- <script src="../js/jquery.min.js"></script>
    <script src="../js/resp/bootstrap.min.js"></script> -->
<style>
	a {
		color: #0d6efd;
		text-decoration: none;
	}
</style>
<?php include_once "encabezado.php" ?>
<div class="row">
	<div class="col-sm">
	
		<br>

		<h2>Contacto</h2>

		<br>
		<p>
			¿Quieres contactarnos para alguna duda, queja o comentario?
		</p>

		<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#contact">
			<span class="glyphicon glyphicon-plus"></span> Presiona Aqui </a></button>

	</div>
</div>
<?php include_once("./pie.php"); ?>
<?php include_once("soporte.php"); ?>