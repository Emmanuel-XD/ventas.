<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:_sesion/login.php");
		die();
	}

	$id = $_GET['id'];
	require_once ("db.php");
	$query = mysqli_query($conexion,"DELETE FROM productos WHERE id = '$id'");
	
	header ('Location: ./listar.php?m=1');
?>