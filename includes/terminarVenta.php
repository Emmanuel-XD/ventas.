<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
use Mike42\Escpos;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

session_start();
	$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location: _sesion/login.php");

	}

if(!isset($_POST["total"])) exit;


$total = $_POST["total"];
$pago = $_POST["pago"];
$cambio = $_POST["cambio"];
include_once "base_de_datos.php";
	$varsesion = $_SESSION['nombre'];


	require_once ("db.php");
try{
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
$sentencia->execute([$idVenta]);
$venta = $sentencia->fetchObject();


$cambio = $venta -> cambio;
$pago = $venta -> pago;
$vendedor  = $venta -> nombre;
$ticket = $venta -> id;
$tfecha = $venta -> fecha;




$sentenciaProductos = $base_de_datos->prepare("SELECT p.codigo, p.descripcion,p.precioVenta, pv.cantidad
FROM productos p
LEFT JOIN 
productos_vendidos pv
ON p.id = pv.id_producto
WHERE pv.id_venta = ?");
$sentenciaProductos->execute([$idVenta]);
$productos = $sentenciaProductos->fetchAll();
$Ticketmsg = "0";
}
catch(Exception $e) {
    $Ticketmsg = "1";
}


function addSpaces($string = '', $valid_string_length = 0) {
    if (strlen($string) < $valid_string_length) {
        $spaces = $valid_string_length - strlen($string);
        for ($index1 = 1; $index1 <= $spaces; $index1++) {
            $string = $string . ' ';
        }
    }

    return $string;
}
if(isset($vendedor) && isset($ticket) && isset($tfecha) && isset($productos)){
try {
$connector = new WindowsPrintConnector("POS58 Printer");
$printer = new Printer($connector);

include_once "db.php";
$consulta = "SELECT * FROM datos ";

$resultado = $conexion->query($consulta);
if ($resultado->num_rows > 0){
while ($filas = $resultado->fetch_array()){
    $negocio = $filas['negocio'];
    $telefono = $filas['telefono'];
    $direccion = $filas['direccion'];
    $mensaje = $filas['mensaje'];
}
}

$printer->feed();
$printer->setPrintLeftMargin(0);

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer ->text("TICKET DE COMPRA\n\n");
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer ->text("$negocio \n");
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer ->text("Dir: $direccion \n");
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Tel: $telefono \n\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Atiende: $vendedor  \n");
$printer->text("Ticket: $ticket \n");
$printer->text("Fecha: $tfecha \n");
$printer -> text("--------------------------------\n");
$printer->setEmphasis(true);
$printer -> setFont(Printer::FONT_B);
$printer -> setTextSize(1, 1);
$printer->text(addSpaces('Productos', 22) . addSpaces('Cant/Precio', 12) . addSpaces('Total', 7) . "\n");
$printer->setEmphasis(false);
$total = 0;

foreach ($productos as $producto)  {

	$subtotal = $producto->cantidad * $producto->precioVenta;
	$total += $subtotal; 
    //Current item ROW 1
    $name_lines = str_split($producto -> descripcion, 20);
    foreach ($name_lines as $k => $l) {
        $l = trim($l);
        $name_lines[$k] = addSpaces($l, 22);
    }
		$cantprice = $producto -> cantidad;
		$cantprice .= " X ";
		$cantprice .= $producto -> precioVenta;

    $qtyx_price = str_split($cantprice, 10);
    foreach ($qtyx_price as $k => $l) {
        $l = trim($l);
        $qtyx_price[$k] = addSpaces($l, 12);
    }

    $total_price = str_split($subtotal, 5);
    foreach ($total_price as $k => $l) {
        $l = trim($l);
        $total_price[$k] = addSpaces($l, 7);
    }

    $counter = 0;
    $temp = [];
    $temp[] = count($name_lines);
    $temp[] = count($qtyx_price);
    $temp[] = count($total_price);
    $counter = max($temp);

    for ($i = 0; $i < $counter; $i++) {
        $line = '';
        if (isset($name_lines[$i])) {
            $line .= ($name_lines[$i]);
        }
        if (isset($qtyx_price[$i])) {
            $line .= ($qtyx_price[$i]);
        }
        if (isset($total_price[$i])) {
            $line .= ($total_price[$i]);
        }
        $printer->text($line . "\n");
    }

    $printer->feed();
}
$printer -> setFont(Printer::FONT_A);
$printer -> setTextSize(1, 1);
$printer -> text("--------------------------------\n");
$printer->setEmphasis(true);
$lineTotal = sprintf('%-5.40s %-1.05s %13.40s','Total.  ',':', $total);
$printer -> text("$lineTotal$\n");
$lineTunai = sprintf('%-5.40s %-1.05s %13.40s','Pago con.',':', $pago);
$printer -> text("$lineTunai$\n");
$lineDisc = sprintf('%-5.40s %-1.05s %13.40s','Cambio.  ',':', $cambio);
$printer -> text("$lineDisc$\n\n\n");
$printer->setEmphasis(false);
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("$mensaje\n");
$printer->text("WWW.MYSISTEMVENTA.COM\n\n\n\n");
$printer->cut();
$printer->pulse();
$printer->close();
$Ticketmsg .= "Success";
}catch(Exception $e) {
    $Ticketmsg .= "Error";
}
}
else{
    $Ticketmsg .= "Datos";
}
echo json_encode($Ticketmsg);
?>