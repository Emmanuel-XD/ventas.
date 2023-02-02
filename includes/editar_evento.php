<?php
// Conexion a la base de datos
require_once('base_de_datos.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$consulta = "DELETE FROM eventos WHERE id = $id";
	$query = $base_de_datos->prepare( $consulta );
	if ($query == false) {
	 print_r($base_de_datos->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
	
}elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	
	$consulta= "UPDATE eventos SET  title = '$title', color = '$color' WHERE id = $id ";

	
	$query = $base_de_datos->prepare( $consulta );
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
