<?php
session_start();
error_reporting(0);
	$varsesion = $_SESSION['nombre'];

if (!isset($_GET["id"])) {
    echo "<script language='JavaScript'>
    alert('No has seleccionado el id del registro');
    location.assign('../views/ventas.php');
    </script>";
}
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT id, fecha, total, pago, cambio, nombre FROM ventas WHERE id = ?");
$sentencia->execute([$id]);
$venta = $sentencia->fetchObject();
if (!$venta) {
    echo "<script language='JavaScript'>
    alert('No se encontro el id de esa venta');
    location.assign('../views/ventas.php');
    </script>";
}

$sentenciaProductos = $base_de_datos->prepare("SELECT p.codigo, p.descripcion,p.precioVenta, pv.cantidad
FROM productos p
LEFT JOIN 
productos_vendidos pv
ON p.id = pv.id_producto
WHERE pv.id_venta = ?");
$sentenciaProductos->execute([$id]);
$productos = $sentenciaProductos->fetchAll();
if (!$productos) {
    echo "<script language='JavaScript'>
    alert('No se encontro los productos de esta venta');
    location.assign('../views/ventas.php');
    </script>";
}


// CONFIGURACIÓN PREVIA
require('../fpdf/fpdf.php');
define('EURO',chr(128)); // Constante con el símbolo Euro.
$pdf = new FPDF('P','mm',array(48,150)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();

require_once ("db.php");  
$consulta=mysqli_query($conexion,"SELECT * FROM datos ");

while ($fila=mysqli_fetch_array($consulta)) {
// CABECERA
$pdf->SetFont('Helvetica','B',9);
$pdf->setY(20);$pdf->setX(-55);
$pdf->Cell(60,4,'TICKET DE VENTA',0,1,'C');

$pdf->Ln(3);
$pdf->SetFont('Helvetica','',9);
$pdf->setX(-54);
$pdf->Cell(60,4,  utf8_decode($fila['negocio']),0,1,'C');
$pdf->Ln(1);
$pdf->setX(-54);
$pdf->Cell(60,4,'Dir: '.utf8_decode($fila['direccion']),0,1,'C');
$pdf->setX(-54);
$pdf->Cell(60,4, 'Tel: '. utf8_decode($fila['telefono']),0,1,'C');





// DATOS FACTURA        
$pdf->Ln(5);

$pdf->SetFont('Helvetica','',8);
$pdf->setX(-45);
$pdf->Cell(60,4,'Cajero: '. utf8_decode($venta->nombre),0,1,'');
$pdf->setX(-45);
$pdf->Cell(60,4,'Numero de Ticket: '. utf8_decode($venta->id),0,1,'');
$pdf->setX(-45);
$pdf->Cell(60,4,'Fecha: '. utf8_decode($venta->fecha),0,1,'');

// COLUMNAS
$pdf->Ln(3);
$pdf->SetFont('Helvetica', 'B', 6);
$pdf->setX(-45);
$pdf->Cell(12, 10, 'Productos', 0);
$pdf->Cell(11, 10, 'Cant.',0,0,'R');
$pdf->Cell(8, 10, 'Precio',0,0,'R');
$pdf->Cell(10, 10, 'SubTotal',0,0,'R');
$pdf->Ln(8);
$pdf->setX(-45);
$pdf->Cell(42,0,'','T');
$pdf->Ln(0);

$total = 0;
foreach ($productos as $producto) {
    $subtotal = $producto->precioVenta * $producto->cantidad;
    $total += $subtotal;

// PRODUCTOS
$pdf->SetFont('Helvetica', '', 6);
$pdf->Ln(1);
$pdf->setX(-45);
$pdf->MultiCell(20,4, utf8_decode($producto->descripcion),0,'L'); 
$pdf->Cell(15, -5, utf8_decode($producto->cantidad),0,0,'R');
$pdf->Cell(8, -5, number_format($producto->precioVenta, 2),0,0,'R');
$pdf->Cell(10, -5, number_format($producto->cantidad * $producto->precioVenta, 2),0,0,'R');


}
//SUMATORIO DE LOS PRODUCTOS 

$pdf->Ln(3); 
$pdf->SetFont('Helvetica', '', 7);  
$pdf->setX(-45);
$pdf->Cell(25, 10, 'TOTAL: ', 0); $pdf->Cell(20, 10, '', 0); 
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->setX(-20);
$pdf->Cell(15, 10, number_format($total, 2).' MXN',0,0,'R'); 


$pdf->Ln(3); 
$pdf->SetFont('Helvetica', '', 7);  
$pdf->setX(-45);
$pdf->Cell(25, 10, 'PAGO CON: ', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->SetFont('Helvetica', 'B', 7);  
$pdf->setX(-20);
$pdf->Cell(15, 10, number_format($venta->pago, 2).' MXN',0,0,'R');

$pdf->Ln(3); 
$pdf->SetFont('Helvetica', '', 7);
$pdf->setX(-45);
$pdf->Cell(25, 10, 'SU CAMBIO: ', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->setX(-20);
$pdf->Cell(15, 10,  number_format($venta->cambio, 2).' MXN',0,0,'R');

// PIE DE PAGINA $pdf->Ln(10); 
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Ln(20);

$pdf->setX(-54);
$pdf->Cell(60,0, utf8_decode($fila['mensaje']),0,1,'C');

$pdf->SetFont('Helvetica', '', 7);
$pdf->Ln(3);
$pdf->setX(-54);
$pdf->Cell(60,0,'WWW.MYSISTEMVENTA.COM',0,1,'C');
$pdf->Ln(5);
$pdf->Output (utf8_decode($venta->id).'ticket.pdf' ,'i' );
}
?>
