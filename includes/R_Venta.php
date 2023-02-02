<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){

	    header("Location: ./_sesion/login.php");
		die();
	}

require('../fpdf/fpdf.php');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->image('../img/logo.png', 150, 1, 60); // X, Y, Tamaño
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Movernos a la derecha
    $this->Cell(60);

    // Título
    $this->Cell(70,10,'Reporte de ventas',0,0,'C');
    // Salto de línea
    $this->Ln(30);

    $this->SetX(8);

    $this->Cell(15,10,'ID',1,0,'C',0);
    $this->Cell(34,10,'Fecha',1,0,'C',0);
    $this->Cell(17,10,'Total',1,0,'C',0);
    $this->Cell(130,10,'Productos/Cantidad',1,1,'C',0);
	

  
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
}
}

require_once ("db.php");
$consulta = "SELECT ventas.total, ventas.fecha, ventas.id,
GROUP_CONCAT( productos.descripcion, ' = ', productos_vendidos.cantidad 
SEPARATOR ' /') AS productos FROM ventas INNER JOIN productos_vendidos 
ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON
 productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id;";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while ($row=$resultado->fetch_assoc()) {

    $pdf->SetX(8);

    $pdf->Cell(15,10,$row['id'],1,0,'C',0);
    $pdf->Cell(34,10,$row['fecha'],1,0,'C',0);
	$pdf->Cell(17,10,'$'.$row['total'],1,0,'C',0);
    $pdf->Cell(130,10,$row['productos'],1,1,'C',0);
	


} 




	$pdf->Output();
?>
