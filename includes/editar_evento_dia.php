<?php

// Conexion a la base de datos
require_once('base_de_datos.php');

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	$consulta = "UPDATE eventos SET  start = '$start', end = '$end' WHERE id = $id ";

	
	$query = $base_de_datos->prepare( $consulta );
	if ($query == false) {
	 print_r($base_de_datos->errorInfo());
	 die ('Error');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error');
	}else{
		die ('OK');
	}

}
header('Location: ../views/calendario.php');

	
?>
