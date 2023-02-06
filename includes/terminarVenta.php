<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
session_start();
error_reporting(0);
	$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location: _sesion/login.php");

	}

if(!isset($_POST["total"])) exit;


session_start();


$total = $_POST["total"];
$pago = $_POST["pago"];
$cambio = $_POST["cambio"];
include_once "base_de_datos.php";

session_start();
error_reporting(0);
	$varsesion = $_SESSION['nombre'];


	require_once ("db.php");
$insert = ("INSERT INTO ventas( total,nombre,pago,cambio) VALUES ('$total', '$varsesion', '$pago', '$cambio');");
$resultado= mysqli_query($conexion, $insert);

$sentencia = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;
$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO productos_vendidos(id_producto, id_venta, cantidad) VALUES (?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE productos SET existencia = existencia - ? WHERE id = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$producto->id, $idVenta, $producto->cantidad]);
	$sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];

//Se consultan los datos y productos para el ticket 
$sentencia = $base_de_datos->prepare("SELECT id, fecha, total, pago, cambio, nombre FROM ventas WHERE id = ?");
$sentencia->execute([$id]);
$venta = $sentencia->fetchObject();

$sentenciaProductos = $base_de_datos->prepare("SELECT p.codigo, p.descripcion,p.precioVenta, pv.cantidad
FROM productos p
LEFT JOIN 
productos_vendidos pv
ON p.id = pv.id_producto
WHERE pv.id_venta = ?");
$sentenciaProductos->execute([$idVenta]);
$productos = $sentenciaProductos->fetchAll();

try {
	$printconnect = new WindowsPrintConnector("tickets_printer");
	$printer = new Printer($printconnect);
    $printer -> text("¡TICKET DE COMPRA!\n\n\n\n");
	$head = sprintf('%-10.40s %-4.40s %-1.40s %1.40s %-1.40s %2.40s', "Productos", "Cantidad", "","Precio", '',"Total");
	$printer -> text("$head \n");
	$printer -> text("--------------------------------");

	foreach ($productos as $producto) 
	{
		$realtotal = $producto->cantidad * $producto->precioVenta;
		$printer -> setTextSize(1, 1);
		$line = sprintf('%-10.40s %-4.40s %-1.40s %1.40s %-1.40s %2.40s', $producto->descripcion, $producto->cantidad, 'X',$producto->precioVenta, '=',$realtotal);
		$total = 0;
		$subtotal = $producto->precioVenta * $producto->cantidad;
		$total += $subtotal;
		$printer -> text("$line\n");
	}
	$printer -> text("--------------------------------");
	
    $printer -> cut();
    $printer -> close();
} catch(Exception $e) {
    $errorTicket = "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}





?>