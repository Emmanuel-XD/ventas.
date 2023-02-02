
  
  <?php


	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['nombre'];

	if ($varsesion == null || $varsesion = '') {

		header("Location: _sesion/login.php");
	}

	/**
	 * Parte de registro de productos
	 */

	require_once("db.php");
	if (isset($_POST)) {
		extract($_POST);
		$total = $precioVenta * $existencia;

		session_start();
		error_reporting(0);


		$consulta = "INSERT INTO productos (codigo, descripcion, precioVenta, precioCompra, existencia, fecha, total, nombre)
	VALUES ('$codigo', '$descripcion ', '$precioVenta', '$precioCompra', '$existencia', '$fecha', '$total', '$nombre' )";
		$resultado = mysqli_query($conexion, $consulta);

		if ($resultado) {
			echo 'El registro fue guardado correctamente';
		} else {
			echo 'Error al guardar los datos';
		}
	} else {
		echo 'No data';
	}
