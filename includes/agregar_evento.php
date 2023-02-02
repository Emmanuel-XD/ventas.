<?php

// Conexion a la base de datos
require_once('base_de_datos.php');

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];

	$consulta = "INSERT INTO eventos(title, start, end, color) values ('$title', '$start', '$end', '$color')";
	

	
	$query = $base_de_datos->prepare( $consulta);
	if ($query == false) {
	 print_r($base_de_datos->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: ../views/calendario.php');    
	
?>
